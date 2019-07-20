<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class("position-relative"); ?> data-spy="scroll" data-target="#main-navbar">
<?php do_action( 'wp_body_open' ); ?>
<div class="site min-vh-100 d-flex flex-column" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div class="fixed-top opacity-95" id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow" id="main-navbar">

		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>

					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>

						<?php if ( is_front_page() && is_home() ) : ?>

							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

						<?php else : ?>

							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

						<?php endif; ?>

					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->

				<button class="navbar-toggler border-0 outline-none collapsed" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
					<!-- <span class="navbar-toggler-icon"></span> -->
					<span class="icon-bar top-bar"></span>
					<span class="icon-bar middle-bar"></span>
					<span class="icon-bar bottom-bar"></span>
				</button>

				<!-- The WordPress Menu goes here -->
				<!-- <?php wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container_class' => 'collapse navbar-collapse',
						'container_id'    => 'navbarNavDropdown',
						'menu_class'      => 'navbar-nav ml-auto',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				); ?> -->
				<div id="navbarNavDropdown" class="collapse navbar-collapse">
					<ul id="main-menu" class="navbar-nav ml-auto">
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-about" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-about nav-item"><a title="<?php echo get_theme_mod('about_heading', 'About'); ?>" href="<?php echo (is_front_page() && is_home()) ? '#about' : esc_url(get_home_url( NULL, '#about' )); ?>" class="nav-link"><?php echo get_theme_mod('about_heading', 'About'); ?></a></li>
						<?php if (get_theme_mod('testimonials_enabled', 'yes') === 'yes') { ?><li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-testimonials" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-testimonials nav-item"><a title="<?php echo get_theme_mod('testimonials_heading', 'Testimonials'); ?>" href="<?php echo (is_front_page() && is_home()) ? '#testimonials' : esc_url(get_home_url( NULL, '#testimonials' )); ?>" class="nav-link"><?php echo get_theme_mod('testimonials_heading', 'Testimonials'); ?></a></li><?php } ?>
						<?php if (get_theme_mod('services_enabled', 'yes') === 'yes') { ?><li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-services" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-services nav-item"><a title="<?php echo get_theme_mod('services_heading', 'Services'); ?>" href="<?php echo (is_front_page() && is_home()) ? '#services' : esc_url(get_home_url( NULL, '#services' )); ?>" class="nav-link"><?php echo get_theme_mod('services_heading', 'Services'); ?></a></li><?php } ?>
						<?php if (get_theme_mod('gallery_enabled', 'yes') === 'yes') { ?><li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-gallery" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-gallery nav-item"><a title="<?php echo get_theme_mod('gallery_heading', 'Gallery'); ?>" href="<?php echo (is_front_page() && is_home()) ? '#gallery' : esc_url(get_home_url( NULL, '#gallery' )); ?>" class="nav-link"><?php echo get_theme_mod('gallery_heading', 'Gallery'); ?></a></li><?php } ?>
						<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" id="menu-item-contact" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-contact nav-item"><a title="<?php echo get_theme_mod('contact_heading', 'Contact'); ?>" href="<?php echo (is_front_page() && is_home()) ? '#contact' : esc_url(get_home_url( NULL, '#contact' )); ?>" class="nav-link"><?php echo get_theme_mod('contact_heading', 'Contact'); ?></a></li>
					</ul>
				</div>
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>

		</nav><!-- #main-navbar -->

	</div><!-- #wrapper-navbar end -->
