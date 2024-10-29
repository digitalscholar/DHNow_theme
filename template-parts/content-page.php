<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package DHNow
 */


$content = get_the_content();
$blocks  = parse_blocks( $content );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		if ( ! empty( $blocks ) && $blocks[0]['blockName'] === 'core/cover' ) {
			echo render_block( $blocks[0] );
		}
		?>

		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

		<?php
		foreach ( $blocks as $index => $block ) {
			if ( $index === 0 ) continue;
			echo render_block( $block );
		}
		?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dhnow' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
