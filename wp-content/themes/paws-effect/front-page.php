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
  'post_type' => 'post',
  'posts_per_page' => 1
));
Timber::render( array( 'front-page.twig', 'page.twig' ), $context );