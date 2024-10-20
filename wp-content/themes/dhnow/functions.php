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

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dhnow_scripts' );

/**
 * Enqueue editor styles.
 */
function dhnow_enqueue_editor_styles() {
	// Check if we are using the block editor
	if ( function_exists( 'is_block_editor' ) && is_block_editor() ) {
		// Enqueue the style for the block editor
		wp_enqueue_style( 'dhnow-block-editor-styles', get_template_directory_uri() . '/style-editor.css', array(), '1.0', 'all' );
	} else {
		// Enqueue the style for the classic editor
		add_editor_style( 'style-editor.css' );
	}
}
add_action( 'admin_init', 'dhnow_enqueue_editor_styles' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom Blocks functions.
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
