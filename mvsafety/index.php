<?php
/**
 * Direct-hosting entry point. Pages are rendered from local PHP copy and assets.
 */

define( 'MVSAFETY_SITE', true );
require_once __DIR__ . '/inc/content.php';

if ( PHP_SAPI === 'cli' && in_array( $argv[1] ?? '', array( '--render', '--render-404' ), true ) ) {
	$render_mode = $argv[1];
	$render_lang = 'en' === ( $argv[2] ?? '' ) ? 'en' : 'pt';
	$base_prefix = trim( (string) getenv( 'MVSAFETY_BASE_PATH' ), '/' );
	$base_prefix = $base_prefix ? '/' . $base_prefix : '';
	$site_url    = rtrim( (string) getenv( 'MVSAFETY_SITE_URL' ), '/' );
	if ( ! $site_url ) {
		$site_url = 'https://example.invalid' . $base_prefix;
	}

	if ( ! defined( 'MVSAFETY_STATIC_BUILD' ) ) {
		define( 'MVSAFETY_STATIC_BUILD', true );
	}
	if ( ! defined( 'MVSAFETY_SITE_URL' ) ) {
		define( 'MVSAFETY_SITE_URL', $site_url );
	}

	$_SERVER['SCRIPT_NAME'] = $base_prefix . '/index.php';
	$site_host = parse_url( $site_url, PHP_URL_HOST );
	$_SERVER['HTTP_HOST'] = $site_host ?: 'example.invalid';

	if ( '--render-404' === $render_mode ) {
		$_SERVER['REQUEST_URI'] = $base_prefix . '/' . $render_lang . '/not-found/';
	} else {
		$render_key = (string) ( $argv[3] ?? '' );
		$definitions_for_render = mvsafety_page_definitions();
		if ( ! isset( $definitions_for_render[ $render_key ][ $render_lang ] ) ) {
			fwrite( STDERR, "Invalid static page requested.\n" );
			exit( 2 );
		}
		$_SERVER['REQUEST_URI'] = $base_prefix . '/' . $render_lang . '/' . rawurlencode( $definitions_for_render[ $render_key ][ $render_lang ]['slug'] ) . '/';
	}
}

$base_path = str_replace( '\\', '/', dirname( $_SERVER['SCRIPT_NAME'] ?? '/' ) );
$base_path = '/' === $base_path ? '' : rtrim( $base_path, '/' );

function mvsafety_site_url( string $key, string $language ): string {
	global $base_path;
	$definitions = mvsafety_page_definitions();
	$slug        = $definitions[ $key ][ $language ]['slug'] ?? $definitions['home'][ $language ]['slug'];
	return $base_path . '/' . rawurlencode( $language ) . '/' . rawurlencode( $slug ) . '/';
}

function mvsafety_site_asset( string $path ): string {
	global $base_path;
	return $base_path . '/assets/' . ltrim( $path, '/' );
}

function mvsafety_site_absolute_url( string $path ): string {
	$configured_url = defined( 'MVSAFETY_SITE_URL' ) ? rtrim( (string) MVSAFETY_SITE_URL, '/' ) : '';
	if ( $configured_url ) {
		return $configured_url . '/' . ltrim( $path, '/' );
	}

	$host = $_SERVER['HTTP_HOST'] ?? '';
	if ( ! preg_match( '/\A[a-z0-9.-]+(?::[0-9]{1,5})?\z/i', $host ) ) {
		$host = 'localhost';
	}
	return 'https://' . $host . '/' . ltrim( $path, '/' );
}

function mvsafety_site_content( string $key, string $language ): string {
	$html        = mvsafety_page_content( $key, $language );
	$definitions = mvsafety_page_definitions();

	foreach ( $definitions as $page_key => $translations ) {
		$html = str_replace( '{{page:' . $page_key . '}}', htmlspecialchars( mvsafety_site_url( $page_key, $language ), ENT_QUOTES, 'UTF-8' ), $html );
	}

	$html = preg_replace_callback(
		'/\{\{asset:([a-zA-Z0-9_\/.-]+)\}\}/',
		static function ( array $matches ): string {
			return htmlspecialchars( mvsafety_site_asset( $matches[1] ), ENT_QUOTES, 'UTF-8' );
		},
		$html
	);

	if ( str_contains( $html, '[mvsafety_contact_form]' ) ) {
		$html = str_replace( '[mvsafety_contact_form]', mvsafety_site_contact_form( $language ), $html );
	}

	return $html;
}

function mvsafety_site_contact_form( string $language ): string {
	$english = 'en' === $language;
	$labels  = $english
		? array(
			'name' => 'Full name', 'company' => 'Company', 'email' => 'Email address', 'phone' => 'Telephone / WhatsApp',
			'service' => 'Service of interest', 'service_choose' => 'Select a service', 'fire' => 'Firefighting equipment',
			'raft' => 'Liferafts', 'boat' => 'Rescue boats / lifeboats', 'other' => 'Other maritime safety service',
			'vessel' => 'Vessel name (optional)', 'message' => 'Message', 'consent' => 'I agree that MV Safety may use these details to respond to my enquiry.',
			'send' => 'Send enquiry', 'sent' => 'Your enquiry has been sent. Thank you.', 'error' => 'We could not send your enquiry. Please check the fields or contact us directly.',
			'required' => 'Please complete all required fields and accept the privacy notice.',
		)
		: array(
			'name' => 'Nome completo', 'company' => 'Empresa', 'email' => 'E-mail', 'phone' => 'Telefone/WhatsApp',
			'service' => 'Serviço de interesse', 'service_choose' => 'Selecione um serviço', 'fire' => 'Combate a incêndio',
			'raft' => 'Balsas salva-vidas', 'boat' => 'Botes de resgate / baleeiras', 'other' => 'Outro serviço de segurança marítima',
			'vessel' => 'Nome da embarcação (opcional)', 'message' => 'Mensagem', 'consent' => 'Autorizo o uso destes dados pela MV Safety para responder à minha solicitação.',
			'send' => 'Enviar solicitação', 'sent' => 'Sua solicitação foi enviada. Obrigado.', 'error' => 'Não foi possível enviar sua solicitação. Verifique os campos ou entre em contato diretamente.',
			'required' => 'Preencha os campos obrigatórios e aceite o aviso de privacidade.',
		);

	if ( defined( 'MVSAFETY_STATIC_BUILD' ) && MVSAFETY_STATIC_BUILD ) {
		$privacy_url = htmlspecialchars( mvsafety_site_url( 'privacy', $language ), ENT_QUOTES, 'UTF-8' );
		$output = '<span id="contact-form-status" aria-live="polite"></span>';
		$output .= '<form class="mv-contact-form" data-static-contact-form method="post">';
		$output .= '<input type="hidden" name="language" value="' . $language . '">';
		$output .= '<div class="mv-form-honeypot" aria-hidden="true"><label for="mv-website">Website</label><input id="mv-website" type="text" name="website" tabindex="-1" autocomplete="off"></div>';
		$output .= '<label>' . htmlspecialchars( $labels['name'], ENT_QUOTES, 'UTF-8' ) . ' <span aria-hidden="true">*</span><input name="name" type="text" autocomplete="name" required maxlength="120"></label>';
		$output .= '<label>' . htmlspecialchars( $labels['company'], ENT_QUOTES, 'UTF-8' ) . '<input name="company" type="text" autocomplete="organization" maxlength="160"></label>';
		$output .= '<label>' . htmlspecialchars( $labels['email'], ENT_QUOTES, 'UTF-8' ) . ' <span aria-hidden="true">*</span><input name="email" type="email" autocomplete="email" required maxlength="190"></label>';
		$output .= '<label>' . htmlspecialchars( $labels['phone'], ENT_QUOTES, 'UTF-8' ) . '<input name="phone" type="tel" autocomplete="tel" maxlength="60"></label>';
		$output .= '<label>' . htmlspecialchars( $labels['service'], ENT_QUOTES, 'UTF-8' ) . ' <span aria-hidden="true">*</span><select name="service" required><option value="">' . htmlspecialchars( $labels['service_choose'], ENT_QUOTES, 'UTF-8' ) . '</option>';
		foreach ( array( 'fire', 'raft', 'boat', 'other' ) as $service ) {
			$output .= '<option value="' . $service . '">' . htmlspecialchars( $labels[ $service ], ENT_QUOTES, 'UTF-8' ) . '</option>';
		}
		$output .= '</select></label>';
		$output .= '<label>' . htmlspecialchars( $labels['vessel'], ENT_QUOTES, 'UTF-8' ) . '<input name="vessel" type="text" maxlength="160"></label>';
		$output .= '<label class="mv-form-wide">' . htmlspecialchars( $labels['message'], ENT_QUOTES, 'UTF-8' ) . ' <span aria-hidden="true">*</span><textarea name="message" rows="5" required maxlength="4000"></textarea></label>';
		$output .= '<label class="mv-form-consent mv-form-wide"><input name="consent" type="checkbox" value="1" required><span>' . htmlspecialchars( $labels['consent'], ENT_QUOTES, 'UTF-8' ) . ' <a href="' . $privacy_url . '">' . ( $english ? 'Privacy Policy' : 'Política de Privacidade' ) . '</a></span></label>';
		$output .= '<p class="mv-form-wide mv-form-required">' . htmlspecialchars( $labels['required'], ENT_QUOTES, 'UTF-8' ) . '</p>';
		$output .= '<button class="mv-button mv-form-wide" type="submit">' . htmlspecialchars( $labels['send'], ENT_QUOTES, 'UTF-8' ) . '</button></form>';
		return $output;
	}

	$token  = bin2hex( random_bytes( 32 ) );
	$action = $base_path . '/contact-submit.php';
	$privacy_url = htmlspecialchars( mvsafety_site_url( 'privacy', $language ), ENT_QUOTES, 'UTF-8' );
	$status = filter_input( INPUT_GET, 'form_status', FILTER_SANITIZE_SPECIAL_CHARS );
	$output = '';

	if ( session_status() !== PHP_SESSION_ACTIVE ) {
		header( 'Cache-Control: no-store, private, max-age=0' );
		header( 'Pragma: no-cache' );
		session_set_cookie_params(
			array(
				'lifetime' => 0,
				'path'     => $base_path ?: '/',
				'secure'   => ! empty( $_SERVER['HTTPS'] ) && 'off' !== $_SERVER['HTTPS'],
				'httponly' => true,
				'samesite' => 'Lax',
			)
		);
		session_start();
	}
	$_SESSION['mvsafety_form_token'] = $token;

	if ( 'sent' === $status ) {
		$output .= '<p id="contact-form-status" class="mv-form-message mv-form-message--success" role="status">' . htmlspecialchars( $labels['sent'], ENT_QUOTES, 'UTF-8' ) . '</p>';
	} elseif ( 'error' === $status ) {
		$output .= '<p id="contact-form-status" class="mv-form-message mv-form-message--error" role="alert">' . htmlspecialchars( $labels['error'], ENT_QUOTES, 'UTF-8' ) . '</p>';
	} else {
		$output .= '<span id="contact-form-status"></span>';
	}

	$output .= '<form class="mv-contact-form" action="' . htmlspecialchars( $action, ENT_QUOTES, 'UTF-8' ) . '" method="post">';
	$output .= '<input type="hidden" name="language" value="' . $language . '"><input type="hidden" name="page_slug" value="' . htmlspecialchars( mvsafety_page_definitions()['contact'][ $language ]['slug'], ENT_QUOTES, 'UTF-8' ) . '">';
	$output .= '<input type="hidden" name="form_token" value="' . $token . '">';
	$output .= '<div class="mv-form-honeypot" aria-hidden="true"><label for="mv-website">Website</label><input id="mv-website" type="text" name="website" tabindex="-1" autocomplete="off"></div>';
	$output .= '<label>' . htmlspecialchars( $labels['name'], ENT_QUOTES, 'UTF-8' ) . ' <span aria-hidden="true">*</span><input name="name" type="text" autocomplete="name" required maxlength="120"></label>';
	$output .= '<label>' . htmlspecialchars( $labels['company'], ENT_QUOTES, 'UTF-8' ) . '<input name="company" type="text" autocomplete="organization" maxlength="160"></label>';
	$output .= '<label>' . htmlspecialchars( $labels['email'], ENT_QUOTES, 'UTF-8' ) . ' <span aria-hidden="true">*</span><input name="email" type="email" autocomplete="email" required maxlength="190"></label>';
	$output .= '<label>' . htmlspecialchars( $labels['phone'], ENT_QUOTES, 'UTF-8' ) . '<input name="phone" type="tel" autocomplete="tel" maxlength="60"></label>';
	$output .= '<label>' . htmlspecialchars( $labels['service'], ENT_QUOTES, 'UTF-8' ) . ' <span aria-hidden="true">*</span><select name="service" required><option value="">' . htmlspecialchars( $labels['service_choose'], ENT_QUOTES, 'UTF-8' ) . '</option>';
	foreach ( array( 'fire', 'raft', 'boat', 'other' ) as $service ) {
		$output .= '<option value="' . $service . '">' . htmlspecialchars( $labels[ $service ], ENT_QUOTES, 'UTF-8' ) . '</option>';
	}
	$output .= '</select></label>';
	$output .= '<label>' . htmlspecialchars( $labels['vessel'], ENT_QUOTES, 'UTF-8' ) . '<input name="vessel" type="text" maxlength="160"></label>';
	$output .= '<label class="mv-form-wide">' . htmlspecialchars( $labels['message'], ENT_QUOTES, 'UTF-8' ) . ' <span aria-hidden="true">*</span><textarea name="message" rows="5" required maxlength="4000"></textarea></label>';
	$output .= '<label class="mv-form-consent mv-form-wide"><input name="consent" type="checkbox" value="1" required><span>' . htmlspecialchars( $labels['consent'], ENT_QUOTES, 'UTF-8' ) . ' <a href="' . $privacy_url . '">' . ( $english ? 'Privacy Policy' : 'Política de Privacidade' ) . '</a></span></label>';
	$output .= '<p class="mv-form-wide mv-form-required">' . htmlspecialchars( $labels['required'], ENT_QUOTES, 'UTF-8' ) . '</p>';
	$output .= '<button class="mv-button mv-form-wide" type="submit">' . htmlspecialchars( $labels['send'], ENT_QUOTES, 'UTF-8' ) . '</button></form>';

	return $output;
}

$definitions = mvsafety_page_definitions();
$request_uri = parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ) ?: '/';
$request_uri = rawurldecode( $request_uri );
if ( $base_path && str_starts_with( $request_uri, $base_path ) ) {
	$request_uri = substr( $request_uri, strlen( $base_path ) );
}
$request_uri = trim( $request_uri, '/' );

if ( '' === $request_uri ) {
	header( 'Location: ' . mvsafety_site_url( 'home', 'pt' ), true, 302 );
	exit;
}

$segments = explode( '/', $request_uri );
$language = $segments[0] ?? '';
$slug     = $segments[1] ?? '';
$page_key = '';
if ( in_array( $language, array( 'pt', 'en' ), true ) ) {
	foreach ( $definitions as $key => $translation ) {
		if ( $slug === $translation[ $language ]['slug'] ) {
			$page_key = $key;
			break;
		}
	}
}

$not_found = ! $page_key;
if ( $not_found ) {
	http_response_code( 404 );
	$language = 'en' === $language ? 'en' : 'pt';
	$page_key = 'home';
	$definitions['home'][ $language ]['title'] = 'en' === $language ? 'Page not found' : 'Página não encontrada';
	$definitions['home'][ $language ]['seo_title'] = $definitions['home'][ $language ]['title'] . ' | MV Safety';
}

if ( ! isset( $definitions[ $page_key ][ $language ] ) ) {
	http_response_code( 404 );
	$page_key = 'home';
}

$page       = $definitions[ $page_key ][ $language ];
$english    = 'en' === $language;
$canonical  = mvsafety_site_url( $page_key, $language );
$alternate_pt = mvsafety_site_url( $page_key, 'pt' );
$alternate_en = mvsafety_site_url( $page_key, 'en' );
$content    = $not_found
	? '<section class="mv-section"><div class="mv-container mv-prose"><h1>' . ( $english ? 'Page not found' : 'Página não encontrada' ) . '</h1><p>' . ( $english ? 'The page may have moved or the address may be incorrect.' : 'A página pode ter mudado de endereço ou o link pode estar incorreto.' ) . '</p><a class="mv-button" href="' . htmlspecialchars( mvsafety_site_url( 'home', $language ), ENT_QUOTES, 'UTF-8' ) . '">' . ( $english ? 'Go to home' : 'Ir para o início' ) . '</a></div></section>'
	: mvsafety_site_content( $page_key, $language );

if ( PHP_SAPI === 'cli' && in_array( $argv[1] ?? '', array( '--render', '--render-404' ), true ) ) {
	ob_start();
	require __DIR__ . '/header.php';
	echo '<main id="main-content" class="mv-main">' . $content . '</main>';
	require __DIR__ . '/footer.php';
	echo ob_get_clean();
	exit;
}

require __DIR__ . '/header.php';
?>
<main id="main-content" class="mv-main">
	<?php echo $content; ?>
</main>
<?php require __DIR__ . '/footer.php'; ?>
