<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DHNow
 */

?>

<section class="no-results not-found">
	<header class="page-header wp-block-cover alignfull" style="min-height:350px;aspect-ratio:unset;">
		<span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(0,0,0) 0%,rgba(0,0,0,0.2) 100%)"></span>
		<img fetchpriority="high" decoding="async" width="1440" height="350" class="wp-block-cover__image-background wp-image-221327" alt="DHNow" src="/wp-content/uploads/2024/10/pages-cover.jpg" data-object-fit="cover" srcset="/wp-content/uploads/2024/10/pages-cover.jpg 1440w, /wp-content/uploads/2024/10/pages-cover-300x73.jpg 300w, /wp-content/uploads/2024/10/pages-cover-1024x249.jpg 1024w, /wp-content/uploads/2024/10/pages-cover-768x187.jpg 768w" sizes="(max-width: 1440px) 100vw, 1440px">
		<div class="wp-block-cover__inner-container is-layout-constrained wp-block-cover-is-layout-constrained">
			<div style="height:130px" aria-hidden="true" class="wp-block-spacer"></div>
			<h1 class="page-title wp-block-heading has-text-align-center"><?php esc_html_e( 'Nothing Found', 'dhnow' ); ?></h1>
		</div>
	</header><!-- .page-header -->

	<div class="container with-sidebar">

		<div class="grid-header">

		</div>

		<div class="grid-main">
			<div class="wp-block-group">
				<?php
				if ( is_home() && current_user_can( 'publish_posts' ) ) :

					printf(
						'<p>' . wp_kses(
							/* translators: 1: link to WP admin new post page. */
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'dhnow' ),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						) . '</p>',
						esc_url( admin_url( 'post-new.php' ) )
					);

				elseif ( is_search() ) :
					?>

					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'dhnow' ); ?></p>
					<?php
					get_search_form();

				else :
					?>

					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'dhnow' ); ?></p>
					<?php
					get_search_form();

				endif;
				?>
			</div>
		</div>

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="secondary" class="widget-area">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</aside>

		<?php endif; ?>

		<div class="grid-footer">

		</div>
	</div><!-- .page-content -->
</section><!-- .no-results -->
