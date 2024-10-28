<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DHNow
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		$categories_list = get_the_category_list( esc_html__( ', ', 'dhnow' ) );
		if ( $categories_list ) {
			echo '<span class="cat-links">' . $categories_list . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
			<div class="entry-meta">
				<?php
				dhnow_posted_by();
				dhnow_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php else :
			the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
		endif;

		?>
	</header><!-- .entry-header -->

	<?php
	if ( is_singular() ) :
		dhnow_post_thumbnail();
		?>

		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dhnow' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dhnow' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	<?php else : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php if ( is_singular() ) : ?>
			<?php dhnow_entry_footer(); ?>
		<?php else : ?>
			<div class="entry-meta">
				<?php
				dhnow_posted_by();
				dhnow_posted_on();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
