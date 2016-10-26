<?php
/**
 * Visual functions and definitions
 *
 * @package Visual
 * @since Visual 0.1
 */

/**
 * Set constant for version
 */
define( 'VISUAL_VERSION', '1.3.2' );

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Visual 0.1
 */

if ( ! isset( $content_width ) )
	$content_width = 670; /* pixels */

/**
 * Set different $content_width depending on template
 *
 * @since Visual 0.1
 */
function visual_content_width() {
	global $content_width;

	if ( is_page_template( 'page-fullwidth.php' ) )
		$content_width = 990;
}
add_action( 'template_redirect', 'visual_content_width' );


if ( ! function_exists( 'visual_setup' ) ) :

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Visual 0.1
 */
function visual_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Visual, use a find and replace
	 * to change 'visual' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'visual', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'visual-thumbnail', 326, 999 );
	add_image_size( 'visual-post', 700, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'visual' ),
	) );

	// Enable support for Post Formats
	add_theme_support( 'post-formats', array( 'image', 'gallery' ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );

}
endif; // visual_setup

add_action( 'after_setup_theme', 'visual_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Visual 0.1
 */

function visual_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'visual' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title"><span>',
		'after_title' => '</span></h1>',
	) );
}

add_action( 'widgets_init', 'visual_widgets_init' );

/**
 * Enqueue scripts and styles
 *
 * @since Visual 0.1
 */

function visual_scripts() {

	wp_enqueue_style( 'visual-style', get_stylesheet_uri(), array(), VISUAL_VERSION );

	// Use style-rtl.css for RTL layouts
	wp_style_add_data( 'visual-style', 'rtl', 'replace' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script(
			'keyboard-image-navigation',
			get_template_directory_uri() . '/js/keyboard-image-navigation.js',
			array( 'jquery' ),
			VISUAL_VERSION
		);
	}

	wp_enqueue_script(
		'visual-scripts',
		get_template_directory_uri() . '/js/theme.js',
		array( 'jquery', 'masonry' ),
		VISUAL_VERSION,
		true
	);

}
add_action( 'wp_enqueue_scripts', 'visual_scripts' );

/**
 * Enqueue fonts
 *
 * @since Visual 0.1
 */

function visual_fonts() {
		// Raleway
		wp_enqueue_style(
			'visual-fonts',
			'//fonts.googleapis.com/css?family=Raleway:400,700',
			array(),
			null,
			'screen'
		);
}
add_action( 'wp_enqueue_scripts', 'visual_fonts' );

/**
 * Adds a body class for masonry layouts
 *
 * @since Visual 0.1
 */

function visual_body_class( $classes ) {
	if ( !is_singular() && !is_404() && !is_author() )
		$classes[] = 'masonry';
	return $classes;
}
add_filter('body_class','visual_body_class');

/**
 * Custom template tags for this theme.
 */
require( get_template_directory() . '/inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require( get_template_directory() . '/inc/extras.php' );

/**
 * Functions to enable the options.
 */
require( get_template_directory() . '/inc/options-functions.php' );

/**
 * Customizer additions.
 */
require( get_template_directory() . '/inc/customizer.php' );

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );