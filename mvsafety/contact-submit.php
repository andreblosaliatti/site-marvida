<?php
/**
 * Validates and sends contact form enquiries through the configured SMTP account.
 */

if ( 'POST' !== ( $_SERVER['REQUEST_METHOD'] ?? '' ) ) {
	http_response_code( 405 );
	header( 'Allow: POST' );
	exit;
}

if ( session_status() !== PHP_SESSION_ACTIVE ) {
	$session_path = str_replace( '\\', '/', dirname( $_SERVER['SCRIPT_NAME'] ?? '/' ) );
	$session_path = '/' === $session_path ? '/' : rtrim( $session_path, '/' );
	session_set_cookie_params(
		array(
			'lifetime' => 0,
			'path'     => $session_path,
			'secure'   => ! empty( $_SERVER['HTTPS'] ) && 'off' !== $_SERVER['HTTPS'],
			'httponly' => true,
			'samesite' => 'Lax',
		)
	);
	session_start();
}

$config_file = __DIR__ . '/config.php';
if ( file_exists( $config_file ) ) {
	require_once $config_file;
}

$base_path = str_replace( '\\', '/', dirname( $_SERVER['SCRIPT_NAME'] ?? '/' ) );
$base_path = '/' === $base_path ? '' : rtrim( $base_path, '/' );
$language  = isset( $_POST['language'] ) && 'en' === $_POST['language'] ? 'en' : 'pt';
$slug      = 'en' === $language ? 'contact' : 'contato';
$redirect  = static function ( string $status ) use ( $base_path, $language, $slug ): void {
	header( 'Location: ' . $base_path . '/' . $language . '/' . $slug . '/?form_status=' . rawurlencode( $status ) . '#contact-form-status', true, 303 );
	exit;
};

$posted_token = isset( $_POST['form_token'] ) ? (string) $_POST['form_token'] : '';
$session_token = isset( $_SESSION['mvsafety_form_token'] ) ? (string) $_SESSION['mvsafety_form_token'] : '';
unset( $_SESSION['mvsafety_form_token'] );

if ( ! $posted_token || ! $session_token || ! hash_equals( $session_token, $posted_token ) ) {
	$redirect( 'error' );
}
if ( ! empty( $_POST['website'] ) ) {
	$redirect( 'sent' );
}

$now = time();
if ( isset( $_SESSION['mvsafety_last_submission'] ) && $now - (int) $_SESSION['mvsafety_last_submission'] < 30 ) {
	$redirect( 'error' );
}

$name       = trim( strip_tags( (string) ( $_POST['name'] ?? '' ) ) );
$company    = trim( strip_tags( (string) ( $_POST['company'] ?? '' ) ) );
$email      = filter_var( trim( (string) ( $_POST['email'] ?? '' ) ), FILTER_SANITIZE_EMAIL );
$phone      = trim( strip_tags( (string) ( $_POST['phone'] ?? '' ) ) );
$service    = isset( $_POST['service'] ) ? (string) $_POST['service'] : '';
$vessel     = trim( strip_tags( (string) ( $_POST['vessel'] ?? '' ) ) );
$message    = trim( strip_tags( (string) ( $_POST['message'] ?? '' ) ) );
$consent    = isset( $_POST['consent'] ) && '1' === $_POST['consent'];
$valid_services = array( 'fire', 'raft', 'boat', 'other' );

if (
	'' === $name ||
	strlen( $name ) > 480 ||
	strlen( $company ) > 640 ||
	! $email ||
	! filter_var( $email, FILTER_VALIDATE_EMAIL ) ||
	strlen( $email ) > 190 ||
	strlen( $phone ) > 240 ||
	! in_array( $service, $valid_services, true ) ||
	strlen( $vessel ) > 640 ||
	'' === $message ||
	strlen( $message ) > 16000 ||
	! $consent
) {
	$redirect( 'error' );
}

$vendor = __DIR__ . '/vendor/phpmailer/src/';
foreach ( array( 'Exception.php', 'PHPMailer.php', 'SMTP.php' ) as $library_file ) {
	if ( ! is_file( $vendor . $library_file ) ) {
		error_log( 'MV Safety contact form: PHPMailer dependency is missing.' );
		$redirect( 'error' );
	}
	require_once $vendor . $library_file;
}

$required_settings = array( 'MVSAFETY_CONTACT_EMAIL', 'MVSAFETY_SMTP_HOST', 'MVSAFETY_SMTP_USERNAME', 'MVSAFETY_SMTP_PASSWORD', 'MVSAFETY_FROM_EMAIL' );
foreach ( $required_settings as $setting ) {
	if ( ! defined( $setting ) || '' === trim( (string) constant( $setting ) ) ) {
		error_log( 'MV Safety contact form: SMTP configuration is incomplete.' );
		$redirect( 'error' );
	}
}

$services = array(
	'fire'  => 'en' === $language ? 'Firefighting equipment' : 'Combate a incêndio',
	'raft'  => 'en' === $language ? 'Liferafts' : 'Balsas salva-vidas',
	'boat'  => 'en' === $language ? 'Rescue boats / lifeboats' : 'Botes de resgate / baleeiras',
	'other' => 'en' === $language ? 'Other maritime safety service' : 'Outro serviço de segurança marítima',
);
$body = implode(
	"\n",
	array(
		'Name: ' . $name,
		'Company: ' . $company,
		'Email: ' . $email,
		'Telephone: ' . $phone,
		'Service: ' . $services[ $service ],
		'Vessel: ' . $vessel,
		'Message:',
		$message,
	)
);

try {
	$mailer = new PHPMailer\PHPMailer\PHPMailer( true );
	$mailer->isSMTP();
	$mailer->Host       = (string) MVSAFETY_SMTP_HOST;
	$mailer->SMTPAuth   = true;
	$mailer->Username   = (string) MVSAFETY_SMTP_USERNAME;
	$mailer->Password   = (string) MVSAFETY_SMTP_PASSWORD;
	$mailer->Port       = defined( 'MVSAFETY_SMTP_PORT' ) ? (int) MVSAFETY_SMTP_PORT : 465;
	$mailer->SMTPSecure = 587 === $mailer->Port ? PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS : PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
	$mailer->CharSet    = PHPMailer\PHPMailer\PHPMailer::CHARSET_UTF8;
	$mailer->setFrom( (string) MVSAFETY_FROM_EMAIL, 'MV Safety Website');
	$mailer->addAddress( (string) MVSAFETY_CONTACT_EMAIL );
	$mailer->addReplyTo( $email, $name );
	$mailer->Subject = 'en' === $language ? 'New enquiry from the MV Safety website' : 'Nova solicitação pelo site da MV Safety';
	$mailer->Body    = $body;
	$mailer->send();
} catch ( Throwable $error ) {
	error_log( 'MV Safety contact form: authenticated email delivery failed.' );
	$redirect( 'error' );
}

$_SESSION['mvsafety_last_submission'] = $now;
$redirect( 'sent' );
