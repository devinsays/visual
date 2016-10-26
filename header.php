<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Visual
 * @since Visual 0.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="section clearfix">
			<hgroup>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			</hgroup>

			<nav role="navigation" class="site-navigation main-navigation clearfix">
				<h3 class="menu-toggle"><a class="icon-menu" href="#menu-main"><?php _e( 'Menu', 'visual' ); ?></a></h3>
				<div class="visuallyhidden skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'visual' ); ?>"><?php _e( 'Skip to content', 'visual' ); ?></a></div>
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => '2' ) );
			} else {
				wp_page_menu();
			}
			?>
			</nav><!-- .site-navigation .main-navigation -->
		</div>
	</header><!-- #masthead .site-header -->

	<div id="main" class="site-main">
		<div class="section clearfix">