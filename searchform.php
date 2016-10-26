<?php
/**
 * The template for displaying search forms in Visual
 *
 * @package Visual
 * @since Visual 0.1
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="visuallyhidden"><?php _e( 'Search', 'visual' ); ?></label>
		<input type="text" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'visual' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'visual' ); ?>" />
	</form>
