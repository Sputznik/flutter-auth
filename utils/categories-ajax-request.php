<?php

add_action( 'wp_ajax_get_categories', 'categories' );
add_action( 'wp_ajax_nopriv_get_categories', 'categories' );

function categories(){

  $categories = [];

  $terms = get_option('flutter-category-field');

  foreach ( $terms as $term) {

    $term_val = get_term_by( 'slug', $term , 'category' );

    // Create new array with necessary details only
    $final_val = array(
      'term_id' =>  $term_val->term_id,
      'slug'    =>  $term_val->slug,
      'name'    =>  $term_val->name,
    );
    array_push( $categories, $final_val );
  }

  $response->topics = $categories;

  $response->totalResponses = count($categories);

  if( ! is_wp_error( $response ) ) {print_r( json_encode( $response ) ); } // JSON DATA

   wp_die();
 }
