<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Visual
 * @since Visual 0.1
 */

get_header(); ?>

		<section id="primary" class="content-area">
			
			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'visual' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
				
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
			
		<?php visual_content_nav( 'nav-below' ); ?>
			
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>