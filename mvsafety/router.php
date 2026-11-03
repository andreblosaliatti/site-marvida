<?php
/**
 * Router for PHP's built-in local preview server.
 */

$request_path = rawurldecode( parse_url( $_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH ) ?: '/' );

if ( '/robots.txt' === $request_path || '/sitemap.xml' === $request_path ) {
	$endpoint = '/robots.txt' === $request_path ? '/robots.php' : '/sitemap.php';
	$_SERVER['SCRIPT_NAME'] = $endpoint;
	require __DIR__ . $endpoint;
	return true;
}

$private_paths = array( '/config.php', '/config.php.example', '/README.md', '/inc', '/vendor' );
foreach ( $private_paths as $private_path ) {
	if ( $request_path === $private_path || str_starts_with( $request_path, $private_path . '/' ) ) {
		http_response_code( 404 );
		return true;
	}
}

$static_file = realpath( __DIR__ . $request_path );
$document_root = realpath( __DIR__ );
if (
	$static_file &&
	$document_root &&
	str_starts_with( $static_file, $document_root . DIRECTORY_SEPARATOR ) &&
	is_file( $static_file )
) {
	return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/index.php';
return true;
