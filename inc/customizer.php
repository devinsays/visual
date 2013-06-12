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

	class Visual_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>>
	        	<?php echo esc_textarea( $this->value() ); ?>
	        </textarea>
	        </label>
	        <?php
	    }
	}
	
	// These style options will be removed in the next version of the theme
	// Unless an alternate color palette is in use, these options will not display
	
	$path = get_template_directory_uri();
	$default_style =  $path . '/css/dark.css';
	$style = visual_get_option( 'visual_style' );
	
	if ( $style != $default_style ) {
	
		// Style Section
		$wp_customize->add_section( 'visual_style', array(
			'title' => __( 'Style', 'visual' ),
	        'priority' => 100
	    ) );
	
	    $wp_customize->add_setting( 'visual-theme[visual_style]', array(
	    	'default' => get_template_directory_uri() . '/css/dark.css',
	    	'type' => 'option'
	    ) );
	
	    $wp_customize->add_control( 'visual_style', array(
	    	'label' => __( 'Visual Style', 'visual' ),
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
    
	// Excerpts
	$wp_customize->add_section( 'visual_excerpts', array(
		'title' => __( 'Excerpts', 'visual' ),
        'priority' => 200
    ) );
    
	$wp_customize->add_setting( 'visual-theme[display_excerpts]', array(
    	'default' => false,
    	'type' => 'option'
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
		esc_url( 'http://wptheming.com' ),
		__( 'Theme: Visual', 'visual' )
    );
    
    $wp_customize->add_setting( 'visual-theme[footer_text]', array(
    	'default' => $footer_text,
    	'type' => 'option'
	) );

    $wp_customize->add_control( new Visual_Textarea_Control (
    	$wp_customize, 'visual_footer',
    		array(
		    	'label'   => __( 'Footer Text', 'visual' ),
		    	'section' => 'visual_footer',
		    	'settings' => 'visual-theme[footer_text]'
			)
		)
	);
    
}

add_action( 'customize_register', 'visual_customizer_register' );

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
	wp_enqueue_script( 'visual_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'visual_customize_preview_js' );
