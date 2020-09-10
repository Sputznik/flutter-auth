<?php

// CATEGORIES AJAX FUNCTIONS
require_once plugin_dir_path( dirname(__FILE__) ).'/utils/categories-ajax-request.php';

// Categories Page
add_action( 'admin_menu', 'settings');

function settings(){
  add_menu_page(
    'Choose Categories',
    'Choose Categories',
    'manage_options',
    'flutter_categories',
    'settingsTemplate',
    'dashicons-cloud',
    110
  );
}

// Include the backend template
function settingsTemplate(){ require_once plugin_dir_path( dirname(__FILE__) , 1 ).'/templates/category.php';}

// Register Settings
add_action( 'admin_init', 'registerCategoryFields' );
function registerCategoryFields(){
  register_setting( 'flutter_categories_group', 'flutter-category-field' );
  add_settings_section( 'flutter_categories_section','','flutterSectionTitle','flutter_categories' );
  add_settings_field( 'flutter-category-field','Category List','categoriesField','flutter_categories', 'flutter_categories_section' );
}

function flutterSectionTitle(){ echo "<h2>Choose Categories</h2>"; }

//Checkbox fields for all the post categories
function categoriesField(){
  $options = get_option( 'flutter-category-field');
  $field = 'flutter-category-field';

  $categories = get_categories( array(
      'taxonomy'   => 'category', // Taxonomy to retrieve terms for.
      'orderby'    => 'name',
      'parent'     => 0,
      'hide_empty' => 0, // change to 1 to hide categores not having a single post
  ) );

  if ( ! empty( $categories ) && is_array( $categories ) ) {
    $output = '<ul class="choose-categories">';
    foreach( $categories as $category ){
      if( !empty( $options ) ){ $checked = in_array($category->slug, $options) ? 'checked="checked"' : ''; }
      $output .= '<li>';
      $output .= sprintf( '<input type="checkbox" id="%1$s[%2$s]" name="%1$s[]" value="%2$s" %3$s />', $field, $category->slug, $checked );
      $output .= sprintf( '<label for="%1$s[%3$s]"> %2$s</label><br>', $field, $category->name, $category->slug );
      $output .= '</li>';
    }
    $output .= '</ul>';
    echo $output;
  }


}
