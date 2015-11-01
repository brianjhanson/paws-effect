<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['event_time'] = '';
$context['event_date'] = date_create_from_format('Ymd', get_field('event_date'));

$start_time = false;
$end_time = false;

/*
 * Examples
 * 
 * Hours equal, periods equal
 * input: 3:15 PM, 6:00 PM
 * output: 3:15 – 6:00 PM
 *
 * Minutes equal Periods equal
 * input: 3:00 PM, 6:00 PM
 * output: 3 – 6 PM
 *
 * Minutes equal, periods not equal
 * input: 10:00 AM, 2:00PM
 * output: 10 AM – 2 PM
*/

if (have_rows('start_time')) {
  $start_time = [];
  while (have_rows('start_time')) {
    the_row();

    $start_time['hours'] = get_sub_field('hour');
    $start_time['minutes'] = get_sub_field('minute') != '00' ? ':' . get_sub_field('minute') : '';
    $start_time['period'] = get_sub_field('period');
  }
}

if (have_rows('end_time')) {
  $end_time = [];
  while (have_rows('end_time')) {
    the_row();

    $end_time['hours'] = get_sub_field('hour');
    $end_time['minutes'] = get_sub_field('minute') != '00' ? ':' . get_sub_field('minute') : '';
    $end_time['period'] = get_sub_field('period');
  }
}

$context['map'] = get_field('map');

$context['event_time'] = $start_time['hours'] . $start_time['minutes'] . ' ' . $start_time['period'];
if ($end_time) {
  $context['event_time'] .= ' – ' . $end_time['hours'] . $end_time['minutes'] . ' ' . $end_time['period'];
}

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
