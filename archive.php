<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DHNow
 */

get_header();

$pagination_args = array(
	'total'   => $wp_query->max_num_pages,
	'current' => max( 1, get_query_var( 'paged' ) ),
	'format'  => '?paged=%#%',
	'prev_next' => true,
	'prev_text' => __( 'prev' ),
	'next_text' => __( 'next' ),
	'end_size' => 1,
	'mid_size' => 6,
);
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header wp-block-cover alignfull" style="min-height:350px;aspect-ratio:unset;">
				<span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(0,0,0) 0%,rgba(0,0,0,0.2) 100%)"></span>
				<img fetchpriority="high" decoding="async" width="1440" height="350" class="wp-block-cover__image-background wp-image-221327" alt="DHNow" src="/wp-content/uploads/2024/10/pages-cover.jpg" data-object-fit="cover" srcset="/wp-content/uploads/2024/10/pages-cover.jpg 1440w, /wp-content/uploads/2024/10/pages-cover-300x73.jpg 300w, /wp-content/uploads/2024/10/pages-cover-1024x249.jpg 1024w, /wp-content/uploads/2024/10/pages-cover-768x187.jpg 768w" sizes="(max-width: 1440px) 100vw, 1440px">
				<div class="wp-block-cover__inner-container is-layout-constrained wp-block-cover-is-layout-constrained">
					<div style="height:130px" aria-hidden="true" class="wp-block-spacer"></div>
					<?php
					the_archive_title( '<h1 class="page-title wp-block-heading has-text-align-center">', '</h1>' );
					the_archive_description( '<div class="archive-description has-text-align-center">', '</div>' );
					?>
				</div>
			</header><!-- .page-header -->

			<div class="container">
				<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
			</div>

			<div class="container with-sidebar">

				<div class="grid-header">

				</div>

				<div class="grid-main">
					<div class="wp-block-group archive-articles-container">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', get_post_type() );
						endwhile;
						?>
					</div>

					<div class="pagination">
						<?php echo paginate_links($pagination_args); ?>
					</div>
				</div>

				<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

					<aside id="secondary" class="widget-area">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</aside>

				<?php endif; ?>

				<div class="grid-footer">

				</div>

			</div>

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
