<?php
/**
 * Functions for implementing options
 *
 * @package Visual
 * @since Visual 0.3
 */
 
/**
 * Gives user a notice to install the Options Framework plugin
 *
 * @since Visual 0.3
 */
 
if ( !function_exists( 'optionsframework_add_page' ) && current_user_can( 'edit_theme_options' )  && current_user_can( 'install_plugins' ) ) {

	global $pagenow;
	
	// Checks to see if plugin exists in plugins directory
	$optionsframework = file_exists( plugins_url( 'options-framework' ) );
	
	// Notice only display on themes page, if plugin is not installed
	if ( $pagenow == 'themes.php' && !$optionsframework )
		add_action( 'admin_notices', 'visual_options_framework_notice' );
}

function visual_options_framework_notice() { ?>
	<div class="updated fade">
	<p><?php printf( __( 'The Options Framework plugin enables customization options for this theme. <a href="%s">Install Now</a>', 'visual' ), admin_url( sprintf( 'update.php?action=install-plugin&plugin=options-framework&_wpnonce=%s', wp_create_nonce( 'install-plugin_options-framework' ) ) ) );  ?></p>
	</div>
<?php
}

/**
 * Calls options that are saved via the Options Framework plugin
 *
 * @since Visual 0.3
 */
 
if ( !function_exists( 'of_get_option' ) ) :
function of_get_option($name, $default = false) {

	$optionsframework_settings = get_option('optionsframework');

	// Gets the unique option id
	$option_name = $optionsframework_settings['id'];

	if ( get_option( $option_name ) ) {
		$options = get_option( $option_name );
	}

	if ( isset( $options[$name] ) ) {
		return $options[$name];
	} else {
		return $default;
	}
}
endif;

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