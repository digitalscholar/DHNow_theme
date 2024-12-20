<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package DHNow
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dhnow_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'dhnow_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function dhnow_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'dhnow_pingback_header' );

function dhnow_sidebars() {
	register_sidebar( array(
		'name'          => 'Editors\' Corner Sidebar',
		'id'            => 'editors-corner-sidebar',
		'before_widget' => '<section class="widget widget_editors-corner">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'dhnow_sidebars' );

function dhn_dynamic_sidebar_params( $params ) {
	$icon_path = get_theme_file_path( '/images/' . $params[0]['id'] . '-icon.svg' );
	$icon_url  = get_theme_file_uri( '/images/' . $params[0]['id'] . '-icon.svg' );

	if ( file_exists( $icon_path ) ) {
		$params[0]['before_widget'] .= '<div class="widget-header">';
		$params[0]['before_widget'] .= '<img src="' . esc_url( $icon_url ) . '" alt="' . $params[0]['name'] . ' icon">';
		$params[0]['after_title'] .= '</div>';
	}

	return $params;
}
add_filter( 'dynamic_sidebar_params', 'dhn_dynamic_sidebar_params' );
