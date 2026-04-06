<?php

/**
 * Wp Enqueue styles and scripts
 */


 
add_action( 'wp_enqueue_scripts', 'enqueue_script_styles' );

function enqueue_script_styles() {


  wp_enqueue_style(  'swiper-css' , get_stylesheet_directory_uri(  ).'/assets/css/swiper.css');
  wp_enqueue_style( 'all-styles' , get_stylesheet_directory_uri(  ).'/assets/css/style.css');

  wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/assets/js/swiper.js' , '' , null, true );
  wp_enqueue_script( 'newscript', get_template_directory_uri() . '/assets/js/script.js', array('swiper-js') , null, true );

  wp_localize_script('newscript' , 'script_js', [
    'ajax_url' => admin_url('admin-ajax.php'),
    'post_id'  => get_the_ID(),
    'nonce'    => wp_create_nonce('bury_ajax_nonce'),
    ]);
}
