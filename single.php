<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package DHNow
 */

get_header();

$categories = get_the_category();
$parent_category_names = array();

if ( ! empty( $categories ) ) {
	foreach ( $categories as $category ) {
		// Check if the category has a parent
		if ( $category->parent == 0 ) {
			$parent_category_names[] = $category->name;
		} else {
			// If it's a child category, get the parent category
			$parent_category = get_category( $category->parent );
			if ( $parent_category ) {
				$parent_category_names[] = $parent_category->name;
			}
		}
	}
}

$unique_parent_names = array_unique( $parent_category_names );
?>

	<main id="primary" class="site-main">

		<header class="page-header wp-block-cover alignfull" style="min-height:350px;aspect-ratio:unset;">
			<span aria-hidden="true" class="wp-block-cover__background has-background-dim-100 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgb(0,0,0) 0%,rgba(0,0,0,0.2) 100%)"></span>
			<img fetchpriority="high" decoding="async" width="1440" height="350" class="wp-block-cover__image-background wp-image-221327" alt="DHNow" src="/wp-content/uploads/2024/10/pages-cover.jpg" data-object-fit="cover" srcset="/wp-content/uploads/2024/10/pages-cover.jpg 1440w, /wp-content/uploads/2024/10/pages-cover-300x73.jpg 300w, /wp-content/uploads/2024/10/pages-cover-1024x249.jpg 1024w, /wp-content/uploads/2024/10/pages-cover-768x187.jpg 768w" sizes="(max-width: 1440px) 100vw, 1440px">
			<div class="wp-block-cover__inner-container is-layout-constrained wp-block-cover-is-layout-constrained">
				<div style="height:130px" aria-hidden="true" class="wp-block-spacer"></div>
				<?php
				if ( ! empty( $unique_parent_names ) ) {
					echo '<h2 class="page-title cat-links wp-block-heading has-text-align-center">' . implode( ', ', $unique_parent_names ) . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</div>
		</header><!-- .page-header -->

		<div class="container with-sidebar">

			<div class="grid-header">

			</div>

			<div class="grid-main">
				<div class="wp-block-group">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', get_post_type() );

						the_post_navigation(
							array(
								'prev_text' => '<h6 class="nav-subtitle">' . esc_html__( 'Previous post', 'dhnow' ) . '</h6> <span class="nav-title">%title</span>',
								'next_text' => '<h6 class="nav-subtitle">' . esc_html__( 'Next post', 'dhnow' ) . '</h6> <span class="nav-title">%title</span>',
							)
						);

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
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

		</div>

	</main><!-- #main -->

<?php
get_footer();
