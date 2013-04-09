<?php
/**
 * Sets up the options panel for Visual
 * Requires the Options Framework Plugin
 * http://wordpress.org/extend/plugins/options-framework/
 *
 * @package Visual
 * @since Visual 0.3
 */

/* Save options under "visual-theme" option name */

function optionsframework_option_name() {
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = 'visual-theme';
	update_option('optionsframework', $optionsframework_settings);
}

/* Theme Options Array */

function optionsframework_options() {

	$path =  get_template_directory_uri();
	
	$options = array();

	$options[] = array(
		'name' => __( 'Visual Options', 'visual' ),
		'type' => 'heading'
	);
	
	$options['visual_styles'] = array(
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

/* 
 * This function adds the html that will appear in the sidebar module of the
 * options panel.  Feel free to alter this how you see fit.
 */

add_action( 'optionsframework_after','visual_options_panel_markup' );

function visual_options_panel_markup() {
	
	$text[0] = sprintf( __( 'Read the <a href="%1$s">documentation</a>.', 'visual' ),
	esc_url( 'http://wptheming.com/2013/03/visual-theme/' )
	);
	
	$text[1] = sprintf( __( 'General questions can be asked in the WordPress <a href="%1$s">forums</a>.', 'visual' ),
		esc_url( 'http://wordpress.org/support/' )
	);
	
	$text[2] = sprintf( __( 'Specific questions about the Visual theme can be asked in the <a href="%1$s">Visual</a> forum.', 'visual' ),
		esc_url( 'http://wordpress.org/support/theme/visual' )
	);
	
	$text[3] = sprintf( __( 'Hope you enjoy this theme!  <a href="%1$s">Ratings</a> are always appreciated.', 'visual' ),
		esc_url( 'http://wordpress.org/support/view/theme-reviews/visual' )
	);
	?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
			<div class="postbox">
				<h3><?php _e('About Visual', 'visual'); ?></h3>
					<div class="inside">
						<p><?php echo $text[0]; ?></p>
						<p><?php echo $text[1]; ?></p>
						<p><?php echo $text[2]; ?></p>
						<p><?php echo $text[3]; ?></p>
					</div>
			</div>
		</div>
	</div>
<?php }

/* 
 * This function loads an additional CSS file for the options panel
 * which allows us to style the sidebar
 */
 
 if ( is_admin() ) {
    $of_page= 'appearance_page_options-framework';
    add_action( "admin_print_styles-$of_page", 'visual_options_panel_styles', 100);
}
 
function visual_options_panel_styles () {
	wp_register_style( 'visual_options_panel_styles', get_stylesheet_directory_uri() .'/inc/options-panel-styles.css' );
	wp_enqueue_style( 'visual_options_panel_styles' );
}