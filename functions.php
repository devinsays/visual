<?php
/**
 * Visual functions and definitions
 *
 * @package Visual
 * @since Visual 0.1
 */
	 
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Visual 0.1
 */
if ( ! isset( $content_width ) )
	$content_width = 670; /* pixels */

function visual_content_width() {
	global $content_width;

	if ( is_home() || is_search() || is_archive() )
		$content_width = 326;

	if ( is_page_template( 'page-fullwidth.php' ) )
		$content_width = 990;
}
add_action( 'template_redirect', 'visual_content_width' );

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

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
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );
	
	/**
	 * Functions to enable the options
	 */
	require( get_template_directory() . '/inc/options-functions.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Visual, use a find and replace
	 * to change 'visual' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'visual', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'visual-thumbnail', 326, 999 );
	add_image_size( 'visual-post', 700, 9999 );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'visual' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'image', 'gallery' ) );
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

	wp_enqueue_style( 'style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130220' );
	}
	
	if ( !is_singular() && !is_404() && !is_author() ) {
		wp_enqueue_script( 'visual-masonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', array( 'jquery' ), '20130220', true );
	}
	
	wp_enqueue_script( 'visual-scripts', get_template_directory_uri() . '/js/visual-scripts.js', array( 'jquery' ), '20130220', true );
	
}

add_action( 'wp_enqueue_scripts', 'visual_scripts' );

/**
 * Enqueue fonts
 *
 * @since Visual 0.1
 */

function visual_fonts() {
		$font_families = array();
		$font_families[] = 'Raleway:400,700';
		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => 'latin,latin-ext',
		);
		wp_enqueue_style( 'visual-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
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
