<?php
$phone = defined( 'MVSAFETY_PHONE' ) ? trim( (string) MVSAFETY_PHONE ) : '';
$email = defined( 'MVSAFETY_PUBLIC_EMAIL' ) ? trim( (string) MVSAFETY_PUBLIC_EMAIL ) : '';
$logo  = mvsafety_site_asset( 'images/brand/logo-mv-safety-branco.png' );
?>
<footer class="mv-footer">
	<div class="mv-container mv-footer__grid">
		<div class="mv-footer__brand"><a href="<?php echo htmlspecialchars( mvsafety_site_url( 'home', $language ), ENT_QUOTES, 'UTF-8' ); ?>"><img src="<?php echo htmlspecialchars( $logo, ENT_QUOTES, 'UTF-8' ); ?>" alt="MV Safety" width="210" height="70"></a><p><?php echo $english ? 'Maritime safety, firefighting and lifesaving services since 2001.' : 'Segurança marítima, proteção contra incêndio e salvatagem desde 2001.'; ?></p></div>
		<div><h2><?php echo $english ? 'Navigation' : 'Navegação'; ?></h2><ul class="mv-footer-menu">
			<?php foreach ( $menu_items as $key => $label ) : ?><li><a href="<?php echo htmlspecialchars( mvsafety_site_url( $key, $language ), ENT_QUOTES, 'UTF-8' ); ?>"><?php echo $label; ?></a></li><?php endforeach; ?>
		</ul></div>
		<div><h2><?php echo $english ? 'Contact' : 'Contato'; ?></h2><ul class="mv-footer-contact">
			<?php if ( $phone ) : ?><li><a href="tel:<?php echo htmlspecialchars( preg_replace( '/[^0-9+]/', '', $phone ), ENT_QUOTES, 'UTF-8' ); ?>"><?php echo htmlspecialchars( $phone, ENT_QUOTES, 'UTF-8' ); ?></a></li><?php endif; ?>
			<?php if ( $email ) : ?><li><a href="mailto:<?php echo htmlspecialchars( $email, ENT_QUOTES, 'UTF-8' ); ?>"><?php echo htmlspecialchars( $email, ENT_QUOTES, 'UTF-8' ); ?></a></li><?php endif; ?>
			<li><?php echo $english ? 'Paranaguá, Paraná, Brazil' : 'Paranaguá (PR), Brasil'; ?></li><li><?php echo $english ? '24/7 Support' : 'Atendimento 24 horas'; ?></li>
		</ul></div>
		<div><h2><?php echo $english ? 'Need specialist support?' : 'Precisa de atendimento?'; ?></h2><a class="mv-button mv-button--light" href="<?php echo htmlspecialchars( mvsafety_site_url( 'contact', $language ), ENT_QUOTES, 'UTF-8' ); ?>"><?php echo $english ? 'Request a Quote' : 'Solicitar Orçamento'; ?></a></div>
	</div>
	<div class="mv-container mv-footer__bottom"><span><?php echo '© ' . gmdate( 'Y' ) . ' MV Safety. ' . ( $english ? 'All rights reserved.' : 'Todos os direitos reservados.' ); ?></span><a href="<?php echo htmlspecialchars( mvsafety_site_url( 'privacy', $language ), ENT_QUOTES, 'UTF-8' ); ?>"><?php echo $english ? 'Privacy Policy' : 'Política de Privacidade'; ?></a></div>
</footer>
</body>
</html>
