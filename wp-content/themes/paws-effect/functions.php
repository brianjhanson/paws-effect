<?php

if ( ! class_exists( 'Timber' ) ) {
  add_action( 'admin_notices', function() {
      echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
    } );
  return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

  protected $pe_includes = [
    'lib/scripts.php',
    'lib/post-types.php'
  ];
  
  function __construct() {
    $this->get_files();
    $this->add_options_page();
    add_theme_support( 'post-formats' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    add_filter( 'timber_context', array( $this, 'add_to_context' ) );
    add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    parent::__construct();
  }

  function get_files() {
    foreach ($this->pe_includes as $file) {
      if (!$filepath = locate_template($file)) {
        trigger_error(sprintf('Error locating %s for inclusion', $file), E_USER_ERROR);
      }
      require_once $filepath;
    }
    unset($file, $filepath);
  }

  function register_taxonomies() {
    //this is where you can register custom taxonomies
  }

  function add_to_context( $context ) {
    $context['foo'] = 'bar';
    $context['stuff'] = 'I am a value set in your functions.php file';
    $context['notes'] = 'These values are available everytime you call Timber::get_context();';
    $context['menu'] = new TimberMenu();
    $context['site'] = $this;
    return $context;
  }

  function add_to_twig( $twig ) {
    /* this is where you can add your own fuctions to twig */
    $twig->addExtension( new Twig_Extension_StringLoader() );
    $twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
    return $twig;
  }

  function add_options_page() {
    if( function_exists('acf_add_options_page') ) {
      acf_add_options_page(array(
        'page_title' => 'Globals',
        'menu_title' => 'Globals',
        'menu_slug' => 'globals',
      ));

      acf_add_options_sub_page(array(
        'page_title' => 'Contact Info',
        'menu_title' => 'Contact Info',
        'parent_slug' => 'globals'
      )); 
    }
  }

}

new StarterSite();

function myfoo( $text ) {
  $text .= ' bar!';
  return $text;
}
