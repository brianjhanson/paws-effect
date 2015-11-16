<?php
  function pe_scripts() {
    wp_enqueue_style( 'app', get_template_directory_uri() . '/dist/styles/main.css', array(), true);
    wp_enqueue_script( 'app', get_template_directory_uri() . '/dist/scripts/bundle.js', array(), '1.0.0', true );
  }
  add_action( 'wp_enqueue_scripts', 'pe_scripts' );