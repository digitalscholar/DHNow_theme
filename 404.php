<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package DHNow
 */

get_header();
?>

	<main id="primary" class="site-main">

		<header class="page-header wp-block-cover alignfull" style="min-height:350px;aspect-ratio:unset;">
			<span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(0,0,0) 0%,rgba(0,0,0,0.2) 100%)"></span>
			<img fetchpriority="high" decoding="async" width="1440" height="350" class="wp-block-cover__image-background wp-image-221327" alt="DHNow" src="/wp-content/uploads/2024/10/pages-cover.jpg" data-object-fit="cover" srcset="/wp-content/uploads/2024/10/pages-cover.jpg 1440w, /wp-content/uploads/2024/10/pages-cover-300x73.jpg 300w, /wp-content/uploads/2024/10/pages-cover-1024x249.jpg 1024w, /wp-content/uploads/2024/10/pages-cover-768x187.jpg 768w" sizes="(max-width: 1440px) 100vw, 1440px">
			<div class="wp-block-cover__inner-container is-layout-constrained wp-block-cover-is-layout-constrained">
				<div style="height:130px" aria-hidden="true" class="wp-block-spacer"></div>
				<h1 class="page-title wp-block-heading has-text-align-center">
					<?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'dhnow' ); ?>
				</h1>
			</div>
		</header><!-- .page-header -->

		<section class="error-404 not-found container__small">

			<div class="wp-block-group">

				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'dhnow' ); ?></p>

				<p><?php get_search_form(); ?></p>

				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				<?php endif; ?>

			</div>

		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
