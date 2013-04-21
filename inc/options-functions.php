<?php
/**
 * Functions for implementing options
 *
 * @package Visual
 * @since Visual 0.3
 */

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
    $footer_text = of_get_option( 'footer_text', visual_return_footer_text() );
    echo $footer_text;
}

add_action( 'visual_footer_text', 'visual_footer_text' );

/**
 * Stylesheet option
 *
 * @since Visual 0.3
 */

function visual_style()   {
	if ( of_get_option('visual_style') && of_get_option('visual_style') != 'minimal' ) {
		wp_enqueue_style( 'visual_style', of_get_option('visual_style'), array(), null );
	}
}

add_action( 'wp_enqueue_scripts', 'visual_style' );