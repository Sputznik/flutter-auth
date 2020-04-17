<?php
// Shows taxonomy: category in wordpress rest_api
add_action( 'init', 'flutter_category_taxonomy_rest_support', 25 );

function flutter_category_taxonomy_rest_support() {
  global $wp_taxonomies;

  //Taxonomy Name
  $taxonomy_name = 'category';
  if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
    $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;

    // Optionally customize the rest_base or controller class
    $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
    $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
  }
}
