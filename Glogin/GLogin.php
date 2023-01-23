<?php

//config.php

// //Include Google Client Library for PHP autoload file
// require_once 'vendor/autoload.php';

// //Make object of Google API Client for call Google API
// $google_client = new Google_Client();

// //Set the OAuth 2.0 Client ID
// $google_client->setClientId('238815036256-p47lj4a51f6mn6af9u42rfp5dnvbd6ua.apps.googleusercontent.com');

// //Set the OAuth 2.0 Client Secret key
// $google_client->setClientSecret('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');

// //Set the OAuth 2.0 Redirect URI
// $google_client->setRedirectUri('http://localhost/oop_login/');

// // to get the email and profile 
// $google_client->addScope('email');

// $google_client->addScope('profile');



require_once 'vendor/autoload.php';
 
// init configuration 
$clientID = '238815036256-p47lj4a51f6mn6af9u42rfp5dnvbd6ua.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/oop_login/login-form-7.php';
  
// create Client Request to access Google API 
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
 
// authenticate code from Google OAuth Flow 
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  
  // get profile info 
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();

  print_r($google_account_info);

  echo $email =  $google_account_info->email;
  echo $name =  $google_account_info->name;
 
  // now you can use this profile info to create account in your website and make user logged in. 
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
  $google_Url=$client->createAuthUrl();
}

?> 