<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| HybridAuth settings
| -------------------------------------------------------------------------
| Your HybridAuth config can be specified below.
|
| See: https://github.com/hybridauth/hybridauth/blob/v2/hybridauth/config.php
*/
$config['hybridauth'] = array(
  "providers" => array(
    // openid providers
   /* "OpenID" => array(
      "enabled" => FALSE,
    ),    
    "AOL" => array(
      "enabled" => FALSE,
    ),*/
   "Envato" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),
    "Google" => array(
      "enabled" => FALSE,
	   "scope"   =>'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email'
		, // optional
      "keys" => array("id" => "", "secret" => ""),
    ),
    "Facebook" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
      "scope"   => array("email"), // optional

      "trustForwarded" => FALSE,
    ),
    "Twitter" => array(
      "enabled" => FALSE,
      "keys" => array("key" => "", "secret" => ""),
      "includeEmail" => TRUE,
    ),
    /*"Live" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),*/
    "LinkedIn" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
      "scope"   => array("r_liteprofile r_emailaddress"), // optional
      "fields"  => array("id", "email-address", "first-name", "last-name","picture-url","public-profile-url"), // optional
      //https://developer.linkedin.com/docs/fields/basic-profile#
    ),
    /*"Foursquare" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),*/
      "GitHub" => array(
          "enabled" => FALSE,
          "keys" => array("id" => "", "secret" => ""),
          "scope"=>"user:email"
      ),
      "Yahoo" => array(
          "enabled" => FALSE,
          "keys" => array("id" => "", "secret" => ""),
      )
  ),
  // If you want to enable logging, set 'debug_mode' to true.
  // You can also set it to
  // - "error" To log only error messages. Useful in production
  // - "info" To log info and error messages (ignore debug messages)
  "debug_mode" => ENVIRONMENT === 'development',
  // Path to file writable by the web server. Required if 'debug_mode' is not false
  "debug_file" => APPPATH . 'logs/hybridauth.log',
);
