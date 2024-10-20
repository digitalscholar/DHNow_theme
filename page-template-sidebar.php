<?php
/*
Template Name: Page With Sidebar
*/

get_header();

$content = get_the_content();
$blocks  = parse_blocks( $content );
?>

	<main id="primary" class="site-main">
        <?php
        if ( ! empty( $blocks ) && $blocks[0]['blockName'] === 'core/cover' ) {
            echo render_block( $blocks[0] );
        }
        ?>

		<div class="container with-sidebar">
            <div class="grid-header">

            </div>
            <div class="grid-main">
                <?php
                foreach ( $blocks as $index => $block ) {
                    if ( $index === 0 ) continue;
                    echo render_block( $block );
                }
                ?>
            </div>
            <?php if ( is_active_sidebar( 'editors-corner-sidebar' ) ) : ?>

				<aside id="secondary" class="widget-area">
                    <?php dynamic_sidebar( 'editors-corner-sidebar' ); ?>
				</aside>

            <?php endif; ?>

            <div class="grid-footer">

            </div>
        </div>

	</main><!-- #main -->

<?php
get_footer();

