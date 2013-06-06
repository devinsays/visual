<?php
/**
 * Sets up the options panel for Visual
 * Requires the Options Framework Plugin
 * http://wordpress.org/extend/plugins/options-framework/
 *
 * @package Visual
 * @since Visual 0.3
 */

/**
 * Theme options are saved under the "visual-theme" option name
 *
 * @since Visual 0.3
 */

function optionsframework_option_name() {
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = 'visual-theme';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Theme options array
 *
 * @since Visual 0.5
 */

function optionsframework_options() {

	$path =  get_template_directory_uri();
	
	$options = array();

	$options[] = array(
		'name' => __( 'Visual Options', 'visual' ),
		'type' => 'heading'
	);
	
	$options['visual_style'] = array(
		'name' => __( 'Visual Style', 'visual' ),
		'id' => 'visual_style',
		'std' => $path . '/css/dark.css',
		'type' => 'images',
		'options' => array(
			'minimal' => $path . '/img/minimal.jpg',
			$path . '/css/light.css' => $path . '/img/light.jpg',
			$path . '/css/dark.css' => $path . '/img/dark.jpg')
	);
	
	$footer_text = sprintf(
		'<a href="%1$s" title="%2$s" rel="generator">WordPress</a> <a href="%3$s">%4$s</a>',
		esc_url( 'http://wordpress.org' ),
		__( 'A Semantic Personal Publishing Platform', 'visual' ),
		esc_url( 'http://wptheming.com' ),
		__( 'Theme: Visual', 'visual' )
    );

	$options['footer_text'] = array(
		'name' => __( 'Footer Text', 'visual' ),
		'desc' => __( 'This text will go in the footer of the theme.  If you leave it completely blank, no footer will be displayed.  HTML is fine to use.', 'visual' ),
		'id' => 'footer_text',
		'std' => visual_return_footer_text(),
		'type' => 'textarea'
	);

	return $options;
}

/**
 * Enable options in the theme customizer
 *
 * @since Visual 0.3
 */

function visual_customizer_register( $wp_customize ) {

	$options = optionsframework_options();
	$path =  get_template_directory_uri();
	
	// Style header
	$wp_customize->add_section( 'visual_style', array(
		'title' => __( 'Style', 'visual' ),
        'priority' => 100
    ) );

    $wp_customize->add_setting( 'visual-theme[visual_style]', array(
    	'default' => $options['visual_style']['std'],
    	'type' => 'option'
    ) );

    $wp_customize->add_control( 'visual_style', array(
    	'label' => $options['visual_style']['name'],
    	'section' => 'visual_style',
    	'settings' => 'visual-theme[visual_style]',
    	'type' => 'select',
    	'choices' => array(
			'minimal' => __( 'Minimal', 'visual'),
			$path . '/css/light.css' => __( 'Light', 'visual'),
			$path . '/css/dark.css' => __( 'Dark', 'visual')
			)
    ) );
}

add_action( 'customize_register', 'visual_customizer_register' );