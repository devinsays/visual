<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Visual
 * @since Visual 0.1
 */
?>
		<div class="section clearfix">
	</div><!-- #main .site-main -->
	
</div><!-- #page .hfeed .site -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="section clearfix">
		<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'visual' ); ?>" rel="generator">WordPress</a>
		<a href="http://wptheming.com"><?php _e( 'Theme: ', 'visual' ); ?> Visual</a>
	</div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>

</body>
</html>