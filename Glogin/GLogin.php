<?php

require_once 'vendor/autoload.php';
 
// init configuration 
$clientID = '238815036256-p47lj4a51f6mn6af9u42rfp5dnvbd6ua.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/oop_login/login-form-7.php?helloG=true';
  
// create Client Request to access Google API 
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
 
// authenticate code from Google OAuth Flow 
if (isset($_GET['code'], $_GET['helloG'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  
  // get profile info 
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();

   //$email =  $google_account_info->email;
   //$name =  $google_account_info->name;

  
  if(!empty($google_account_info['given_name']))
  {
    $_SESSION['user_first_name'] = $google_account_info['given_name'];
  }

  if(!empty($google_account_info['id']))
  {
     $_SESSION['userid'] = $google_account_info['id'];
  }

  if(!empty($google_account_info['family_name']))
  {
   $_SESSION['user_last_name'] = $google_account_info['family_name'];
  }

  if(!empty($google_account_info['email']))
  {
   $_SESSION['user_email_address'] = $google_account_info['email'];
  }

  if(!empty($google_account_info['gender']))
  {
   $_SESSION['user_gender'] = $google_account_info['gender'];
  }

  if(!empty($google_account_info['picture']))
  {
    $_SESSION['user_image'] = $google_account_info['picture'];
  }

  $_SESSION['user_type'] = "Google";
 
  header('Location: home.php');
  exit();
  // now you can use this profile info to create account in your website and make user logged in. 
} else {
  //echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
  $google_Url=$client->createAuthUrl();

}

?> 