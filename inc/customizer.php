<?php
/**
 * Visual Theme Customizer
 *
 * @package Visual
 * @since Visual 0.1
 */


/**
 * Enable options in the theme customizer
 *
 * @since Visual 0.6
 */
function visual_customizer_register( $wp_customize ) {

	// Excerpts
	$wp_customize->add_section( 'visual_excerpts', array(
		'title' => __( 'Excerpts', 'visual' ),
        'priority' => 200
    ) );

	$wp_customize->add_setting( 'visual-theme[display_excerpts]', array(
    	'default' => false,
    	'type' => 'option',
    	'sanitize_callback' => 'visual_sanitize_checkbox'
	) );

    $wp_customize->add_control( 'display_excerpts', array(
        'label' => __( 'Display excerpts on archives', 'visual' ),
        'section' => 'visual_excerpts',
		'settings' => 'visual-theme[display_excerpts]',
		'type' => 'checkbox'
    ) );


	// Footer
	$wp_customize->add_section( 'visual_footer', array(
		'title' => __( 'Footer Text', 'visual' ),
        'priority' => 200
    ) );

	$footer_text = sprintf(
		'<a href="%1$s" title="%2$s" rel="generator">WordPress</a> <a href="%3$s">%4$s</a>',
		esc_url( 'http://wordpress.org' ),
		__( 'A Semantic Personal Publishing Platform', 'visual' ),
		esc_url( 'http://wptheming.com/visual-theme/' ),
		__( 'Theme: Visual', 'visual' )
    );

    $wp_customize->add_setting( 'visual-theme[footer_text]', array(
    	'default' => $footer_text,
    	'type' => 'option',
    	'sanitize_callback' => 'visual_sanitize_text'
	) );

	$wp_customize->add_control( 'visual_footer', array(
		'label' => __( 'Footer Text', 'visual' ),
		'type' => 'textarea',
		'section' => 'visual_footer',
		'settings' => 'visual-theme[footer_text]'
	) );

}
add_action( 'customize_register', 'visual_customizer_register' );

if ( ! function_exists( 'visual_sanitize_text' ) ) :
/**
 * Sanitize a string to allow only tags in the allowedtags array.
 *
 * @since  1.0.0.
 *
 * @param  string    $string    The unsanitized string.
 * @return string               The sanitized string.
 */
function visual_sanitize_text( $string ) {
	global $allowedtags;
	return wp_kses( $string , $allowedtags );
}
endif;

if ( ! function_exists( 'visual_sanitize_checkbox' ) ) :
/**
 * Sanitize a checkbox to only allow 0 or 1
 *
 * @since  1.0.0.
 *
 * @param  boolean    $value    The unsanitized value.
 * @return boolean				The sanitized boolean.
 */
function visual_sanitize_checkbox( $value ) {
	if ( 1 == $value ) {
		return 1;
    } else {
		return 0;
    }
}
endif;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since Visual 0.1
 */
function visual_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'visual_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Visual 0.1
 */
function visual_customize_preview_js() {
	wp_enqueue_script(
		'visual_customizer',
		get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ),
		'20120827',
		true
	);
}
add_action( 'customize_preview_init', 'visual_customize_preview_js' );