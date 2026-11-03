<?php
$config_file = __DIR__ . '/config.php';
if ( file_exists( $config_file ) ) {
	require_once $config_file;
}
$phone    = defined( 'MVSAFETY_PHONE' ) ? trim( (string) MVSAFETY_PHONE ) : '';
$email    = defined( 'MVSAFETY_PUBLIC_EMAIL' ) ? trim( (string) MVSAFETY_PUBLIC_EMAIL ) : '';
$logo     = mvsafety_site_asset( 'images/brand/logo-mv-safety-original-transparente.png' );
$current_menu_key = in_array( $page_key, array( 'firefighting', 'liferafts', 'rescue_boats' ), true ) ? 'services' : $page_key;
?>
<!doctype html>
<html lang="<?php echo $english ? 'en-US' : 'pt-BR'; ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo htmlspecialchars( $page['description'], ENT_QUOTES, 'UTF-8' ); ?>">
	<meta name="robots" content="<?php echo $not_found ? 'noindex,follow' : 'index,follow'; ?>">
	<?php if ( ! $not_found ) : ?>
		<link rel="canonical" href="<?php echo htmlspecialchars( mvsafety_site_absolute_url( $canonical ), ENT_QUOTES, 'UTF-8' ); ?>">
		<link rel="alternate" hreflang="pt-BR" href="<?php echo htmlspecialchars( mvsafety_site_absolute_url( $alternate_pt ), ENT_QUOTES, 'UTF-8' ); ?>">
		<link rel="alternate" hreflang="en-US" href="<?php echo htmlspecialchars( mvsafety_site_absolute_url( $alternate_en ), ENT_QUOTES, 'UTF-8' ); ?>">
		<link rel="alternate" hreflang="x-default" href="<?php echo htmlspecialchars( mvsafety_site_absolute_url( $alternate_pt ), ENT_QUOTES, 'UTF-8' ); ?>">
	<?php endif; ?>
	<link rel="icon" href="<?php echo htmlspecialchars( mvsafety_site_asset( 'images/brand/favicon-mv-512.png' ), ENT_QUOTES, 'UTF-8' ); ?>" type="image/png">
	<link rel="stylesheet" href="<?php echo htmlspecialchars( mvsafety_site_asset( 'css/site.css' ), ENT_QUOTES, 'UTF-8' ); ?>">
	<script src="<?php echo htmlspecialchars( mvsafety_site_asset( 'js/navigation.js' ), ENT_QUOTES, 'UTF-8' ); ?>" defer></script>
	<script src="<?php echo htmlspecialchars( mvsafety_site_asset( 'js/site-config.js' ), ENT_QUOTES, 'UTF-8' ); ?>"></script>
	<script src="<?php echo htmlspecialchars( mvsafety_site_asset( 'js/contact-form.js' ), ENT_QUOTES, 'UTF-8' ); ?>" defer></script>
	<title><?php echo htmlspecialchars( $page['seo_title'], ENT_QUOTES, 'UTF-8' ); ?></title>
	<script type="application/ld+json"><?php echo json_encode( array( '@context' => 'https://schema.org', '@type' => 'Organization', 'name' => 'MV Safety', 'url' => mvsafety_site_absolute_url( $canonical ), 'logo' => mvsafety_site_absolute_url( mvsafety_site_asset( 'images/brand/logo-mv-safety-original-transparente.png' ) ), 'address' => array( '@type' => 'PostalAddress', 'addressLocality' => 'Paranaguá', 'addressRegion' => 'PR', 'addressCountry' => 'BR' ) ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?></script>
</head>
<body>
<a class="mv-skip-link" href="#main-content"><?php echo $english ? 'Skip to content' : 'Pular para o conteúdo'; ?></a>
<div class="mv-topbar">
	<div class="mv-container mv-topbar__inner">
		<div class="mv-topbar__contact">
			<?php if ( $phone ) : ?><a href="tel:<?php echo htmlspecialchars( preg_replace( '/[^0-9+]/', '', $phone ), ENT_QUOTES, 'UTF-8' ); ?>"><?php echo htmlspecialchars( $phone, ENT_QUOTES, 'UTF-8' ); ?></a><?php endif; ?>
			<?php if ( $email ) : ?><a href="mailto:<?php echo htmlspecialchars( $email, ENT_QUOTES, 'UTF-8' ); ?>"><?php echo htmlspecialchars( $email, ENT_QUOTES, 'UTF-8' ); ?></a><?php endif; ?>
			<span><?php echo $english ? 'Paranaguá, Paraná, Brazil' : 'Paranaguá (PR) — Brasil'; ?></span>
			<span><?php echo $english ? '24/7 Support' : 'Atendimento 24 horas'; ?></span>
		</div>
		<nav class="mv-language-switcher" aria-label="<?php echo $english ? 'Select language' : 'Selecionar idioma'; ?>">
			<a href="<?php echo htmlspecialchars( $alternate_pt, ENT_QUOTES, 'UTF-8' ); ?>"<?php echo $english ? '' : ' aria-current="true"'; ?>>PT</a>
			<a href="<?php echo htmlspecialchars( $alternate_en, ENT_QUOTES, 'UTF-8' ); ?>"<?php echo $english ? ' aria-current="true"' : ''; ?>>EN</a>
		</nav>
	</div>
</div>
<header class="mv-header">
	<div class="mv-container mv-header__inner">
		<a class="mv-brand" href="<?php echo htmlspecialchars( mvsafety_site_url( 'home', $language ), ENT_QUOTES, 'UTF-8' ); ?>" rel="home">
			<img src="<?php echo htmlspecialchars( $logo, ENT_QUOTES, 'UTF-8' ); ?>" alt="MV Safety" width="220" height="70">
		</a>
		<button class="mv-menu-toggle" type="button" aria-expanded="false" aria-controls="primary-navigation">
			<span class="screen-reader-text"><?php echo $english ? 'Open menu' : 'Abrir menu'; ?></span>
			<span></span><span></span><span></span>
		</button>
		<nav class="mv-primary-nav" id="primary-navigation" aria-label="<?php echo $english ? 'Main navigation' : 'Navegação principal'; ?>">
			<ul class="menu">
				<?php
				$menu_items = $english
					? array( 'home' => 'Home', 'company' => 'About Us', 'services' => 'Services', 'certifications' => 'Certifications', 'contact' => 'Contact' )
					: array( 'home' => 'Início', 'company' => 'A Empresa', 'services' => 'Serviços', 'certifications' => 'Certificações', 'contact' => 'Contato' );
				foreach ( $menu_items as $key => $label ) :
					?>
					<li<?php echo $current_menu_key === $key ? ' class="current-menu-item"' : ''; ?>><a href="<?php echo htmlspecialchars( mvsafety_site_url( $key, $language ), ENT_QUOTES, 'UTF-8' ); ?>"<?php echo $current_menu_key === $key ? ' aria-current="page"' : ''; ?>><?php echo $label; ?></a></li>
				<?php endforeach; ?>
			</ul>
			<a class="mv-button mv-header__quote" href="<?php echo htmlspecialchars( mvsafety_site_url( 'contact', $language ), ENT_QUOTES, 'UTF-8' ); ?>"><?php echo $english ? 'Request a Quote' : 'Solicitar Orçamento'; ?></a>
		</nav>
	</div>
</header>
