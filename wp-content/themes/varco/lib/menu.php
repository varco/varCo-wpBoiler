<?php
// Register menus
register_nav_menus(
	array(
		'top-left' => __( 'Top Left', 'mbbasetheme' ),   // Left nav in header
        'top-right' => __( 'Top Right', 'mbbasetheme' ),   // Right nav in header
		'footer-left' => __( 'Footer Left', 'mbbasetheme' ), // Left nav in footer
        'footer-middle' => __( 'Footer Middle', 'mbbasetheme' ), // Middle nav in footer
        'footer-right' => __( 'Footer Right', 'mbbasetheme' ) // Right nav in footer
	)
);

// The Top Left Menu
function mb_top_left() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical medium-horizontal menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
        'theme_location' => 'top-left',        			// Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Topbar_Menu_Walker()
    ));
}

function mb_top_right() {
     wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical medium-horizontal menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
        'theme_location' => 'top-right',                    // Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Topbar_Menu_Walker()
    ));
}

/* End Top Menu */

// The Off Canvas Menu
function mb_off_canvas_nav() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-accordion-menu>%3$s</ul>',
        'theme_location' => 'main-nav',        			// Where it's located in the theme
        'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Off_Canvas_Menu_Walker()
    ));
} /* End Off Canvas Menu */

// The Footer Left
function mb_footer_left() {
    wp_nav_menu(array(
        'container' => 'false',                              // Remove nav container
        'menu' => __( 'Footer Left', 'mbbasetheme' ),      // Nav name
        'menu_class' => 'menu',                         // Adding custom nav class
        'theme_location' => 'footer-left',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
        'fallback_cb' => ''                             // Fallback function
    ));
} /* End Footer Menu */

// The Footer Middle
function mb_footer_middle() {
    wp_nav_menu(array(
        'container' => 'false',                              // Remove nav container
        'menu' => __( 'Footer Middle', 'mbbasetheme' ),      // Nav name
        'menu_class' => 'menu',                         // Adding custom nav class
        'theme_location' => 'footer-middle',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
        'fallback_cb' => ''                             // Fallback function
    ));
} /* End Footer Menu */

// The Footer Right
function mb_footer_right() {
    wp_nav_menu(array(
    	'container' => 'false',                              // Remove nav container
    	'menu' => __( 'Footer Right', 'mbbasetheme' ),   	// Nav name
    	'menu_class' => 'menu',      					// Adding custom nav class
    	'theme_location' => 'footer-right',             // Where it's located in the theme
        'depth' => 0,                                   // Limit the depth of the nav
    	'fallback_cb' => ''  							// Fallback function
	));
} /* End Footer Menu */

// Header Fallback Menu
function mb_main_nav_fallback() {
	wp_page_menu( array(
		'show_home' => true,
    	'menu_class' => '',      // Adding custom nav class
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
        'link_before' => '',                            // Before each link
        'link_after' => ''                             // After each link
	) );
}

// Footer Fallback Menu
function mb_footer_links_fallback() {
	/* You can put a default here if you like */
}