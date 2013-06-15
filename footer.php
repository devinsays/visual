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
		</div> <!-- .section -->
	</div><!-- #main .site-main -->
	<div id="push"></div>
</div><!-- #page .hfeed .site -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="section clearfix">
		<?php do_action( 'visual_footer_text' ); ?>
	</div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); ?>

</body>
</html>