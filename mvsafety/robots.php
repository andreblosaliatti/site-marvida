<?php
header( 'Content-Type: text/plain; charset=utf-8' );
$config_file = __DIR__ . '/config.php';
if ( file_exists( $config_file ) ) {
	require_once $config_file;
}
$host = $_SERVER['HTTP_HOST'] ?? '';
if ( ! preg_match( '/\A[a-z0-9.-]+(?::[0-9]{1,5})?\z/i', $host ) ) {
	$host = 'localhost';
}
$site_url = defined( 'MVSAFETY_SITE_URL' ) ? rtrim( (string) MVSAFETY_SITE_URL, '/' ) : 'https://' . $host;
$base_path = str_replace( '\\', '/', dirname( $_SERVER['SCRIPT_NAME'] ?? '/' ) );
$base_path = '/' === $base_path ? '' : rtrim( $base_path, '/' );
echo "User-agent: *\nAllow: /\nSitemap: " . $site_url . $base_path . "/sitemap.xml\n";
