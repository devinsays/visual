<?php
/**
 * Functions for implementing options
 *
 * @package Visual
 * @since Visual 0.3
 */


/**
 * Returns individual array items from the "visual-theme" option
 *
 * @since Visual 0.5
 */
 
function visual_get_option( $name, $default = false ) {

	if ( get_option('visual-theme') ) {
		$options = get_option('visual-theme');
	}

	if ( isset( $options[$name] ) ) {
		return $options[$name];
	} else {
		return $default;
	}
}

/**
 * Option to update footer text
 *
 * The visual_footer_text filter is also available for child themes
 *
 * @since Visual 0.3
 */

function visual_return_footer_text() {
	$footer_text = sprintf(
		'<a href="%1$s" title="%2$s" rel="generator">WordPress</a> <a href="%3$s">%4$s</a>',
		esc_url( 'http://wordpress.org' ),
		__( 'A Semantic Personal Publishing Platform', 'visual' ),
		esc_url( 'http://wptheming.com' ),
		__( 'Theme: Visual', 'visual' )
    );
    return $footer_text;
}

function visual_footer_text() {
    $footer_text = visual_get_option( 'footer_text', visual_return_footer_text() );
    echo $footer_text;
}

add_action( 'visual_footer_text', 'visual_footer_text' );

/**
 * Stylesheet option
 *
 * @since Visual 0.3
 */

function visual_style()   {
	if ( visual_get_option('visual_style') && visual_get_option('visual_style') != 'minimal' ) {
		wp_enqueue_style( 'visual_style', visual_get_option('visual_style'), array(), null );
	}
}

add_action( 'wp_enqueue_scripts', 'visual_style' );

/**
 * Note about theme changes
 *
 * @since Visual 0.6
 */
 
function visual_theme_notice() {
	global $pagenow;
	$default =  get_template_directory_uri() . '/css/dark.css';
	$style = visual_get_option( 'visual_style' );
	$msg = sprintf(
		'Visual will only have the "Dark" color palette in the next release.  To keep your current color scheme, consider <a href="%1$s">purchasing Visual+</a> or <a href="%2$s">contact me</a> for a free upgrade.',
		esc_url( 'http://wptheming.com/visual/' ),
		esc_url( 'http://wptheming.com/contact/' )
	);
	if ( $pagenow == 'themes.php' ) {
		if ( $style != $default ) {
			echo '<div class="updated"><p>' . $msg . '</p></div>';
		}
    }
}

add_action( 'admin_notices', 'visual_theme_notice' );