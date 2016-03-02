<?php
/**
 * _mbbasetheme functions and definitions
 *
 * @package _mbbasetheme
 */

/****************************************
Theme Setup
*****************************************/

/**
 * Theme initialization
 */
require get_template_directory() . '/lib/init.php';

/**
 * Register Menue Areas
 */
require get_template_directory() . '/lib/menu.php';

/**
 * Register Widget Areas
 */
require get_template_directory() . '/lib/sidebar.php';

/**
 * Enqueue scripts
 */

require get_template_directory() . '/lib/enqueue-scripts.php';

/**
 * Custom theme functions definited in /lib/init.php
 */
require get_template_directory() . '/lib/inc/theme-functions.php';

/**
 * Theme support functions like post thumbnails, markup and image sizes
 */
require get_template_directory() . '/lib/inc/theme-support.php';

/**
 * Helper functions for use in other areas of the theme
 */
require get_template_directory() . '/lib/inc/theme-helpers.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/lib/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/lib/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/lib/inc/jetpack.php';




/****************************************
Require Plugins
*****************************************/

require get_template_directory() . '/lib/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/lib/inc/theme-require-plugins.php';

/****************************************
Misc Theme Functions
*****************************************/


/**
 * Define custom post type capabilities for use with Members
 */
add_action( 'admin_init', 'mb_add_post_type_caps' );
function mb_add_post_type_caps() {
	// mb_add_capabilities( 'portfolio' );
}

/**
 * Filter Yoast SEO Metabox Priority
 */
add_filter( 'wpseo_metabox_prio', 'mb_filter_yoast_seo_metabox' );
function mb_filter_yoast_seo_metabox() {
	return 'low';
}

/**************************************
GoCactus functions added by SC Allemang
**************************************/

// Removing top margin from Admin Bar; for testing!
  // add_action('get_header', 'my_filter_head');

  // function my_filter_head() {
  //   remove_action('wp_head', '_admin_bar_bump_cb');
  // }

// Rename WP's sticky class to prevent conflicts with Foundation
function remove_sticky_class($classes) {
	$classes = array_diff($classes, array("sticky"));
	$classes[] = 'wordpress-sticky';
	return $classes;
}
add_filter('post_class','remove_sticky_class');

// Menu walker to automatically add dropdown classes
// Via https://wlcdesigns.com/2015/11/foundation-6-menu-walker-class-for-wordpress/
class F6_TOPBAR_MENU_WALKER extends Walker_Nav_Menu
{   
	/*
	 * Add vertical menu class and submenu data attribute to sub menus
	 */
	 
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\" data-submenu>\n";
	}
}
 
//Optional fallback
function f6_topbar_menu_fallback($args)
{
	/*
	 * Instantiate new Page Walker class instead of applying a filter to the
	 * "wp_page_menu" function in the event there are multiple active menus in theme.
	 */
	 
	$walker_page = new Walker_Page();
	$fallback = $walker_page->walk(get_pages(), 0);
	$fallback = str_replace("<ul class='children'>", '<ul class="children submenu menu vertical" data-submenu>', $fallback);
	
	echo '<ul class="dropdown menu" data-dropdown-menu">'.$fallback.'</ul>';
}

//Register Menu
function _register_menu() {
	register_nav_menu( 'topbar-menu', __( 'Top Bar Menu','textdomain' ) );
}
 
//Add Menu to theme setup hook
add_action( 'after_setup_theme', '_theme_setup' );
 
function _theme_setup()
{
	add_action( 'init', '_register_menu' );
		
	//Theme Support
	add_theme_support( 'menus' );
}