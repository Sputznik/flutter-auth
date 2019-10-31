<?php
/*
Plugin Name: Flutter Authentication
Description: A simple plugin for flutter authentication
Version: 1.0.0
Author: Samuel Thomas
Text Domain: flutter-auth
*/

defined( 'ABSPATH' ) or die( 'Hey you cannot accesse this plugin, you silly human' );

add_action( 'wp_ajax_auth_with_flutter', 'authentication' );
add_action( 'wp_ajax_nopriv_auth_with_flutter', 'authentication' );

function authentication(){

  $username = base64_decode($_REQUEST['ukey']);
  $password = base64_decode($_REQUEST['pkey']);

  //$username = "sam";
  //$password = "sam";

  if( !empty( $username ) && !empty( $password ) ){

    $user = wp_signon( array(
      'user_login'    => $username,
      'user_password' => $password
    ) );

    if(is_wp_error($user)){
      return '';
    }

    $app = new Application_Passwords;
    list( $new_password, $new_item ) = $app->create_new_application_password( 1, 'yka_app' );
    return $new_password;

  }

  return '';
  wp_die();

}
