<?php
/**
 * The template for displaying the front page.
 *
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['latestPost'] = Timber::get_post(array(
  'post_type' => 'post'
));

$context['services'] = Timber::get_posts(array(
  'post_type' => 'services',
  'posts_per_page' => 4
));

$context['global'] = get_fields('options');
Timber::render( array( 'front-page.twig', 'page.twig' ), $context );