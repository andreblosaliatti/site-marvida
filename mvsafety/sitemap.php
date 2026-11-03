<?php
define( 'MVSAFETY_SITE', true );
require_once __DIR__ . '/inc/content.php';
$config_file = __DIR__ . '/config.php';
if ( file_exists( $config_file ) ) {
	require_once $config_file;
}
$base_path = str_replace( '\\', '/', dirname( $_SERVER['SCRIPT_NAME'] ?? '/' ) );
$base_path = '/' === $base_path ? '' : rtrim( $base_path, '/' );
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
if ( ! preg_match( '/\A[a-z0-9.-]+(?::[0-9]{1,5})?\z/i', $host ) ) {
	$host = 'localhost';
}
$site_url = defined( 'MVSAFETY_SITE_URL' ) ? rtrim( (string) MVSAFETY_SITE_URL, '/' ) : 'https://' . $host;
$definitions = mvsafety_page_definitions();
header( 'Content-Type: application/xml; charset=utf-8' );
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
foreach ( $definitions as $translations ) {
	$pt = $site_url . $base_path . '/pt/' . rawurlencode( $translations['pt']['slug'] ) . '/';
	$en = $site_url . $base_path . '/en/' . rawurlencode( $translations['en']['slug'] ) . '/';
	foreach ( array( $pt, $en ) as $url ) {
		echo "  <url>\n";
		echo '    <loc>' . htmlspecialchars( $url, ENT_XML1, 'UTF-8' ) . "</loc>\n";
		echo '    <xhtml:link rel="alternate" hreflang="pt-BR" href="' . htmlspecialchars( $pt, ENT_QUOTES | ENT_XML1, 'UTF-8' ) . "\" />\n";
		echo '    <xhtml:link rel="alternate" hreflang="en-US" href="' . htmlspecialchars( $en, ENT_QUOTES | ENT_XML1, 'UTF-8' ) . "\" />\n";
		echo "  </url>\n";
	}
}
echo "</urlset>\n";
