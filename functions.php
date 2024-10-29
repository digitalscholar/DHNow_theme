<?php
/**
 * DHNow functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DHNow
 */

if ( ! defined( 'DHNOW_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'DHNOW_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dhnow_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on DHNow, use a find and replace
		* to change 'dhnow' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'dhnow', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'dhnow' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'dhnow_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/**
	 * Add Gutenberg alignment support.
	 */
	add_theme_support( 'align-wide' );

	/**
	 * Add Gutenberg Editor Styles support.
	 */
	add_theme_support( 'editor-styles' );

	/**
	 * Add Gutenberg Block Styles support.
	 */
	add_theme_support( 'wp-block-styles' );

	/**
	 * Add responsive-embeds feature support.
	 */
	add_theme_support( 'responsive-embeds' );

	/**
	 * Add custom spacing support.
	 */
	add_theme_support( 'custom-spacing' );

	/**
	 * Add Appearance Tools support.
	 */
	add_theme_support( 'appearance-tools' );

	/**
	 * Add Border Setiings support.
	 */
	add_theme_support( 'border' );
}
add_action( 'after_setup_theme', 'dhnow_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dhnow_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dhnow_content_width', 640 );
}
add_action( 'after_setup_theme', 'dhnow_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dhnow_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'dhnow' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'dhnow' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'dhnow_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dhnow_scripts() {
	wp_enqueue_style( 'dhnow-style', get_stylesheet_uri(), array(), DHNOW_VERSION );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Encode+Sans+Condensed:wght@100;200;300;400;500;600;700;800;900&display=swap', array(), null );
	wp_style_add_data( 'dhnow-style', 'rtl', 'replace' );

	wp_enqueue_script( 'dhnow-navigation', get_template_directory_uri() . '/js/navigation.js', array(), DHNOW_VERSION, true );
	wp_enqueue_script( 'dhnow-vertical-tabs', get_template_directory_uri() . '/js/vertical-tabs.js', array(), DHNOW_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_page_template( 'page-template-sidebar.php' ) ) {
		wp_enqueue_script( 'dhnow-editors-corner', get_template_directory_uri() . '/js/editors-corner.js', array(), DHNOW_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'dhnow_scripts' );

/**
 * Enqueue editor styles.
 */
function dhnow_enqueue_editor_styles() {
	$current_screen = get_current_screen();
	if ( $current_screen->id !== 'widgets' ) {
		// Check if we are using the block editor
		if ( function_exists('is_block_editor' ) && is_block_editor()) {
			// Enqueue the style for the block editor
			wp_enqueue_style( 'dhnow-block-editor-styles', get_template_directory_uri() . '/style-editor.css', array(), '1.0', 'all' );
		} else {
			// Enqueue the style for the classic editor
			add_editor_style( 'style-editor.css' );
		}
	}
}
add_action( 'enqueue_block_editor_assets', 'dhnow_enqueue_editor_styles' );

/**
 * Load Page Sidebar choices dynamically.
 *
 * @param array $field The field options.
 *
 * @return array
 */
function dhn_acf_load_sidebar_choices( $field ) {
	global $wp_registered_sidebars;

	$field['choices'] = array();

	foreach ( $wp_registered_sidebars as $sidebar ) {
		$field['choices'][ $sidebar['id'] ] = $sidebar['name'];
	}

	return $field;
}
add_filter( 'acf/load_field/name=sidebar', 'dhn_acf_load_sidebar_choices' );

/**
 * Register custom shortcodes.
 */
function register_shortcodes() {
	add_shortcode( 'feeds', 'active_feeds_function' );
}
add_action( 'init', 'register_shortcodes' );

/**
 * Feeds Shortcode function.
 *
 * @param array $atts The shortcode attributes.
 *
 * @return string
 */
function active_feeds_function($atts) {
	extract(shortcode_atts(array(
		'status' => 'publish',
	), $atts));

	$return_string = '<ul class="feedlist">';
	$the_query = new WP_Query( array( 'post_type' => 'pf_feed', 'post_status' =>
		$status, 'nopaging' => true, 'orderby' => 'title', 'order' => 'ASC', 'no_found_rows' => true ) );

	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() )  : $the_query->the_post();
			$return_string .= '<li class="feeditem"><a href="' . get_post_meta( get_the_ID(), 'feedUrl', true ) . '" target="_blank">' . get_the_title() . '</a></li>';
		endwhile;
	endif;

	$return_string .= '</ul>';

	wp_reset_query();
	wp_reset_postdata();

	return $return_string;
}

/**
 * Customize Yoast SEO Breadcrumbs.
 *
 * @param array $links The breadcrumbs links.
 *
 * @return array
 */
function yoast_seo_breadcrumb_append_link( $links ) {
	global $post;

	if ( is_single() ) {
		$breadcrumb[] = array(
			'url' => site_url( '/blog/' ),
			'text' => 'Blog',
		);

		$categories = get_the_category();
		if ( $categories ) {
			// Assuming you want the first category
			$first_category  = $categories[0];

			if ( $first_category->parent ) {
				$parent_category = get_category( $first_category->parent );
				$breadcrumb[] = array(
					'url' => get_category_link( $parent_category->term_id ),
					'text' => esc_html( $parent_category->name ),
				);
			}

			if ( $first_category ) {
				$breadcrumb[] = array(
					'url' => get_category_link( $first_category->term_id ),
					'text' => esc_html( $first_category->name ),
				);
			}
		}

		array_splice( $links, 1, -2, $breadcrumb );
	} elseif ( is_archive() ) {
		$breadcrumb[] = array(
			'url' => site_url( '/blog/' ),
			'text' => 'Blog',
		);

		array_splice( $links, 1, -2, $breadcrumb );
	}

	return $links;
}
add_filter( 'wpseo_breadcrumb_links', 'yoast_seo_breadcrumb_append_link' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom blocks.
 */
require get_template_directory() . '/inc/custom-blocks.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
