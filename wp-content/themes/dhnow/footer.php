<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DHNow
 */

$footer             = get_field( 'footer_options', 'option' );
$footer_logo        = $footer['logo'];
$footer_description = $footer['description'];

?>

	<footer id="colophon" class="site-footer">

        <div class="footer-top">
            <div class="container">
                <div class="footer-column">
                    <div class="footer-logo">
                        <a
                            href="<?php echo esc_url( home_url() ); ?>"
                            target="_blank">
                            <img src="<?php echo esc_url( $footer_logo['url'] ); ?>" alt="<?php echo esc_attr( $footer_logo['alt'] ); ?>" />
                        </a>

                    </div><!-- .footer-logo -->

					<?php if ( $footer_description ) : ?>
                        <div class="footer-description">
                            <p><?php echo wp_kses_post( $footer_description ); ?></p>
                        </div><!-- footer-description -->
					<?php endif; ?>
                </div>

                <div class="footer-column">
					<?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_class'     => 'footer-menu',
							'depth'          => 2,
                        ));
					?>
                </div>
            </div>
        </div> <!-- .footer-top -->

        <div class="footer-bottom">
            <div class="container">
                <div class="site-info">
                    <div class="site-info-left">
                        <p>© <?php echo date('Y'); ?> Digital Humanities Now. All Rights Reserved</p>
                    </div><!-- .site-info-left -->

                    <div class="site-info-right">
						<?php get_template_part( 'template-parts/external-links' ); ?>
                    </div><!-- .site-info-right -->
                </div><!-- .site-info -->
            </div>
        </div><!-- .footer-bottom -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
