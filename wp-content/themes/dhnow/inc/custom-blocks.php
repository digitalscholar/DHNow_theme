<?php
function dhnow_enqueue_block_editor_assets() {
	wp_enqueue_script(
		'latest-posts-sticky-control',
		get_template_directory_uri() . '/js/blocks/latest-posts-sticky-control.js',
		array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
		filemtime( get_template_directory() . '/js/blocks/latest-posts-sticky-control.js' ),
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'dhnow_enqueue_block_editor_assets' );

function dhnow_modify_latest_posts_query( $args, $attributes ) {
	if ( isset( $attributes['includeSticky'] ) && !$attributes['includeSticky'] ) {
		$args['ignore_sticky_posts'] = 1;
	}
	return $args;
}
add_filter( 'block_core_latest_posts_query', 'dhnow_modify_latest_posts_query', 10, 2 );
