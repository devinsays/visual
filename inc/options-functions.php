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