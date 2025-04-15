<?php
$external_links = get_field( 'external_links', 'option' );
?>

<div class="external-links">
	<?php foreach ( $external_links as $external_link ) : ?>
    	<a class="external-link" target="_blank" title="<?php echo esc_attr( $external_link['title'] ); ?>" href="<?php echo esc_url( $external_link['url'] ); ?>">
			<?php echo wp_get_attachment_image( $external_link['icon'], array( 24, 20 ) ); ?>
		</a>
	<?php endforeach; ?>

	<?php if ( is_user_logged_in() ) : ?>
		<a class="external-links-editors-login" href="/wp-admin/profile.php"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/editors-login-icon.svg" alt="My Profile" title="My Profile"><span>My Profile</span></a>
	<?php else : ?>
		<a class="external-links-editors-login" href="/wp-login.php"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/editors-login-icon.svg" alt="Editors login" title="Editors login"><span>Editors login</span></a>
	<?php endif; ?>
</div>
