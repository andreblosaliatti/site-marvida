<?php
/**
 * Renders every localized route to a deployable GitHub Pages directory.
 */

define( 'MVSAFETY_SITE', true );
require_once __DIR__ . '/../inc/content.php';

$repository = getenv( 'GITHUB_REPOSITORY' ) ?: '';
$repository_parts = explode( '/', $repository );
$owner = $repository_parts[0] ?? '';
$repository_name = $repository_parts[1] ?? '';

$site_url = rtrim( (string) getenv( 'MVSAFETY_SITE_URL' ), '/' );
if ( ! $site_url ) {
	if ( ! $owner ) {
		fwrite( STDERR, "Set MVSAFETY_SITE_URL or GITHUB_REPOSITORY before building.\n" );
		exit( 1 );
	}
	$site_url = 'https://' . strtolower( $owner ) . '.github.io';
}

$base_path_env = getenv( 'MVSAFETY_BASE_PATH' );
if ( false !== $base_path_env ) {
	$base_segments = trim( $base_path_env, '/' );
	if ( $base_segments && ( ! preg_match( '/\A[A-Za-z0-9._~-]+(?:\/[A-Za-z0-9._~-]+)*\z/', $base_segments ) || preg_match( '~(?:^|/)\.{1,2}(?:/|$)~', $base_segments ) ) ) {
		fwrite( STDERR, "MVSAFETY_BASE_PATH contains invalid path segments.\n" );
		exit( 1 );
	}
	$base_path = $base_segments ? '/' . $base_segments : '';
} elseif ( $repository_name && strtolower( $repository_name ) !== strtolower( $owner . '.github.io' ) ) {
	$base_path = '/' . rawurlencode( $repository_name );
} else {
	$base_path = '';
}

$site_host = parse_url( $site_url, PHP_URL_HOST );
$site_url_path = parse_url( $site_url, PHP_URL_PATH );
if ( ! $site_host || 'https' !== parse_url( $site_url, PHP_URL_SCHEME ) || ( $site_url_path && '/' !== $site_url_path ) || parse_url( $site_url, PHP_URL_QUERY ) || parse_url( $site_url, PHP_URL_FRAGMENT ) ) {
	fwrite( STDERR, "MVSAFETY_SITE_URL must be an HTTPS origin without a path, query or fragment.\n" );
	exit( 1 );
}

$form_endpoint = trim( (string) getenv( 'MVSAFETY_FORM_ENDPOINT' ) );
if ( $form_endpoint && ( ! filter_var( $form_endpoint, FILTER_VALIDATE_URL ) || 'https' !== parse_url( $form_endpoint, PHP_URL_SCHEME ) ) ) {
	fwrite( STDERR, "MVSAFETY_FORM_ENDPOINT must be an absolute HTTPS URL.\n" );
	exit( 1 );
}

$root = realpath( __DIR__ . '/..' );
if ( false === $root ) {
	fwrite( STDERR, "Could not resolve the site source directory.\n" );
	exit( 1 );
}
$output_dir = $root . DIRECTORY_SEPARATOR . 'dist';
if ( is_dir( $output_dir ) ) {
	$iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $output_dir, FilesystemIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::CHILD_FIRST
	);
	foreach ( $iterator as $item ) {
		$item->isDir() ? rmdir( $item->getPathname() ) : unlink( $item->getPathname() );
	}
	rmdir( $output_dir );
}
if ( ! mkdir( $output_dir, 0755, true ) && ! is_dir( $output_dir ) ) {
	fwrite( STDERR, "Could not create the static output directory.\n" );
	exit( 1 );
}

$definitions = mvsafety_page_definitions();
$environment = getenv();
$environment['MVSAFETY_STATIC_BUILD'] = '1';
$environment['MVSAFETY_BASE_PATH'] = $base_path;
$environment['MVSAFETY_SITE_URL'] = $site_url;
$environment['MVSAFETY_FORM_ENDPOINT'] = $form_endpoint;
$renderer = $root . DIRECTORY_SEPARATOR . 'index.php';
$php = PHP_BINARY;

$render = static function ( array $arguments ) use ( $php, $renderer, $root, $environment ): string {
	$command = array_merge( array( $php, $renderer ), $arguments );
	$descriptors = array(
		0 => array( 'pipe', 'r' ),
		1 => array( 'pipe', 'w' ),
		2 => array( 'pipe', 'w' ),
	);
	$process = proc_open( $command, $descriptors, $pipes, $root, $environment );
	if ( ! is_resource( $process ) ) {
		throw new RuntimeException( 'Could not start the page renderer.' );
	}
	fclose( $pipes[0] );
	$html = stream_get_contents( $pipes[1] );
	fclose( $pipes[1] );
	$error = stream_get_contents( $pipes[2] );
	fclose( $pipes[2] );
	$status = proc_close( $process );
	if ( 0 !== $status ) {
		throw new RuntimeException( 'Page render failed: ' . trim( $error ) );
	}
	return $html;
};

try {
	foreach ( $definitions as $key => $translations ) {
		foreach ( array( 'pt', 'en' ) as $language ) {
			$slug = $translations[ $language ]['slug'];
			$directory = $output_dir . '/' . $language . '/' . $slug;
			if ( ! mkdir( $directory, 0755, true ) && ! is_dir( $directory ) ) {
				throw new RuntimeException( 'Could not create route directory: ' . $language . '/' . $slug );
			}
			$html = $render( array( '--render', $language, $key ) );
			if ( false === file_put_contents( $directory . '/index.html', $html ) ) {
				throw new RuntimeException( 'Could not write route: ' . $language . '/' . $slug );
			}
		}
	}

	file_put_contents( $output_dir . '/404.html', $render( array( '--render-404', 'en' ) ) );

	$home = $base_path . '/pt/inicio/';
	$root_html = '<!doctype html><html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="refresh" content="0;url=' . htmlspecialchars( $home, ENT_QUOTES, 'UTF-8' ) . '"><link rel="canonical" href="' . htmlspecialchars( $site_url . $home, ENT_QUOTES, 'UTF-8' ) . '"><title>MV Safety</title></head><body><p><a href="' . htmlspecialchars( $home, ENT_QUOTES, 'UTF-8' ) . '">MV Safety — Início</a></p><script>window.location.replace(' . json_encode( $home, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . ');</script></body></html>';
	file_put_contents( $output_dir . '/index.html', $root_html );

	$assets_source = $root . DIRECTORY_SEPARATOR . 'assets';
	$assets_target = $output_dir . DIRECTORY_SEPARATOR . 'assets';
	$directory_iterator = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator( $assets_source, FilesystemIterator::SKIP_DOTS ),
		RecursiveIteratorIterator::SELF_FIRST
	);
	foreach ( $directory_iterator as $item ) {
		$relative = substr( $item->getPathname(), strlen( $assets_source ) + 1 );
		$target = $assets_target . DIRECTORY_SEPARATOR . $relative;
		if ( $item->isDir() ) {
			if ( ! is_dir( $target ) && ! mkdir( $target, 0755, true ) ) {
				throw new RuntimeException( 'Could not create static asset directory.' );
			}
		} elseif ( ! copy( $item->getPathname(), $target ) ) {
			throw new RuntimeException( 'Could not copy static asset: ' . $relative );
		}
	}

	file_put_contents( $assets_target . '/js/site-config.js', 'window.MVSAFETY_CONFIG = ' . json_encode( array( 'formEndpoint' => $form_endpoint ), JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ) . ';' . PHP_EOL );
	file_put_contents( $output_dir . '/.nojekyll', '' );

	$xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
	foreach ( $definitions as $translations ) {
		$pt = $site_url . $base_path . '/pt/' . rawurlencode( $translations['pt']['slug'] ) . '/';
		$en = $site_url . $base_path . '/en/' . rawurlencode( $translations['en']['slug'] ) . '/';
		foreach ( array( $pt, $en ) as $url ) {
			$xml .= "  <url>\n    <loc>" . htmlspecialchars( $url, ENT_XML1, 'UTF-8' ) . "</loc>\n";
			$xml .= '    <xhtml:link rel="alternate" hreflang="pt-BR" href="' . htmlspecialchars( $pt, ENT_QUOTES | ENT_XML1, 'UTF-8' ) . "\" />\n";
			$xml .= '    <xhtml:link rel="alternate" hreflang="en-US" href="' . htmlspecialchars( $en, ENT_QUOTES | ENT_XML1, 'UTF-8' ) . "\" />\n";
			$xml .= "  </url>\n";
		}
	}
	$xml .= "</urlset>\n";
	file_put_contents( $output_dir . '/sitemap.xml', $xml );

	file_put_contents( $output_dir . '/robots.txt', "User-agent: *\nAllow: /\nSitemap: " . $site_url . $base_path . "/sitemap.xml\n" );
	echo 'Generated ' . ( count( $definitions ) * 2 ) . ' bilingual routes in ' . $output_dir . PHP_EOL;
} catch ( Throwable $error ) {
	fwrite( STDERR, $error->getMessage() . PHP_EOL );
	exit( 1 );
}
