<?php
  function init_services() {
    $labels = array(
      'name'                => _x( 'Services', 'Post Type General Name', 'text_domain' ),
      'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'text_domain' ),
      'menu_name'           => __( 'Services', 'text_domain' ),
      'name_admin_bar'      => __( 'Services', 'text_domain' ),
      'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
      'all_items'           => __( 'All Services', 'text_domain' ),
      'add_new_item'        => __( 'Add New Service', 'text_domain' ),
      'add_new'             => __( 'Add New', 'text_domain' ),
      'new_item'            => __( 'New Service', 'text_domain' ),
      'edit_item'           => __( 'Edit Service', 'text_domain' ),
      'update_item'         => __( 'Update Service', 'text_domain' ),
      'view_item'           => __( 'View Service', 'text_domain' ),
      'search_items'        => __( 'Search Service', 'text_domain' ),
      'not_found'           => __( 'Not found', 'text_domain' ),
      'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
      'label'               => __( 'Service', 'text_domain' ),
      'description'         => __( 'Service Offerings', 'text_domain' ),
      'labels'              => $labels,
      'supports'            => array( 'title', 'editor', 'excerpt', 'revisions', 'thumbnail'),
      'taxonomies'          => array( 'category', 'post_tag' ),
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'menu_position'       => 5,
      'show_in_admin_bar'   => true,
      'show_in_nav_menus'   => true,
      'can_export'          => true,
      'has_archive'         => true,
      'rewrite'             => array('slug' => 'service', 'with_front' => false ),
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'page',
    );
    register_post_type( 'service', $args );
  }
  add_action( 'init', 'init_services', 0 );

  function init_events() {
    $labels = array(
      'name'                => _x( 'Events', 'Post Type General Name', 'text_domain' ),
      'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
      'menu_name'           => __( 'Events', 'text_domain' ),
      'name_admin_bar'      => __( 'Events', 'text_domain' ),
      'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
      'all_items'           => __( 'All Events', 'text_domain' ),
      'add_new_item'        => __( 'Add New Event', 'text_domain' ),
      'add_new'             => __( 'Add New', 'text_domain' ),
      'new_item'            => __( 'New Event', 'text_domain' ),
      'edit_item'           => __( 'Edit Event', 'text_domain' ),
      'update_item'         => __( 'Update Event', 'text_domain' ),
      'view_item'           => __( 'View Event', 'text_domain' ),
      'search_items'        => __( 'Search Event', 'text_domain' ),
      'not_found'           => __( 'Not found', 'text_domain' ),
      'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
    );
    $args = array(
      'label'               => __( 'Event', 'text_domain' ),
      'description'         => __( 'Event Offerings', 'text_domain' ),
      'labels'              => $labels,
      'supports'            => array( 'title', 'editor', 'excerpt', 'revisions', 'thumbnail'),
      'taxonomies'          => array( 'category', 'post_tag' ),
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'menu_position'       => 5,
      'show_in_admin_bar'   => true,
      'show_in_nav_menus'   => true,
      'can_export'          => true,
      'has_archive'         => true,
      'rewrite'             => array('slug' => 'events', 'with_front' => false ),
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'page',
    );
    register_post_type( 'event', $args );
  }
  add_action( 'init', 'init_events', 0 );