<?php
function mb_scripts() {

  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    // Register stylesheet - gulp tasks compile all CSS into /assets/styles/min/style.css
    wp_enqueue_style( '_mbbasetheme-style', get_stylesheet_uri() );
    wp_register_style('_mbbasetheme-min', get_template_directory_uri(). '/assets/styles/min/style.css', array(), '1.0.0', 'all');
    wp_enqueue_style( '_mbbasetheme-min' );

    // Adding scripts file in the footer
    if ( !is_admin() ) {
        //wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'customplugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array('jquery'), NULL, true );
        wp_enqueue_script( 'customscripts', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), NULL, true );
    }
}

add_action('wp_enqueue_scripts', 'mb_scripts', 999);