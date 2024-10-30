<?php
$external_links = get_field( 'external_links', 'option' );
?>

<div class="external-links">
    <a class="external-links-rss" target="_blank" href="<?php echo esc_url( $external_links['rss'] ); ?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/rss-icon.svg" alt="RSS" title="RSS"></a>
    <a class="external-links-x-twitter" target="_blank" href="<?php echo esc_url( $external_links['x-twitter'] ); ?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/twitter-icon.svg" alt="Twitter" title="Twitter"></a>
    <a class="external-links-pressforward" target="_blank" href="<?php echo esc_url( $external_links['pressforward'] ); ?>"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/pressforward-icon.svg" alt="PressForward" title="PressForward"></a>
	<?php if ( is_user_logged_in() ) : ?>
		<a class="external-links-editors-login" href="/wp-admin/profile.php"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/editors-login-icon.svg" alt="My Profile" title="My Profile"><span>My Profile</span></a>
	<?php else : ?>
		<a class="external-links-editors-login" href="/wp-login.php"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/editors-login-icon.svg" alt="Editors login" title="Editors login"><span>Editors login</span></a>
	<?php endif; ?>
</div>
