<?php

//initialize facebook sdk

require 'vendor/autoload.php';


$fb = new Facebook\Facebook([

 'app_id' => '884433022864848',

 'app_secret' => '93626d873b1bfeb4252cb82d4fc2a57a',

 'default_graph_version' => 'v2.5',

]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // optional


if (isset($_SESSION['facebook_access_token'])) {

$accessToken = $_SESSION['facebook_access_token'];

} else {

  $accessToken = $helper->getAccessToken();

}



if (isset($accessToken)) {

if (isset($_SESSION['facebook_access_token'])) {

$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

} else {

// getting short-lived access token

$_SESSION['facebook_access_token'] = (string) $accessToken;

  // OAuth 2.0 client handler

$oAuth2Client = $fb->getOAuth2Client();

// Exchanges a short-lived access token for a long-lived one

$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);

$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;

// setting default access token to be used in script

$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

}

// redirect the user to the profile page if it has "code" GET variable

if (isset($_GET['code'], $_GET['hellofb'])) {

header('Location: ../oop_login/home.php');

}

// getting basic info about user

try {

$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');

$requestPicture = $fb->get('/me/picture?redirect=false&height=200'); //getting user picture

$picture = $requestPicture->getGraphUser();

$profile = $profile_request->getGraphUser();

$fbid = $profile->getProperty('id');           // To Get Facebook ID

$fbfullname = $profile->getProperty('name');   // To Get Facebook full name

$fbemail = $profile->getProperty('email');    //  To Get Facebook email

$fbpic = "<img src='".$picture['url']."' class='img-rounded'/>";

# save the user nformation in session variable

$_SESSION['userid'] = $fbid;

$_SESSION['fb_name'] = $fbfullname;

$_SESSION['fb_email'] = $fbemail;

$_SESSION['fb_pic'] = $fbpic;

$_SESSION['user_type'] = 'facebook';

} catch(Facebook\Exceptions\FacebookResponseException $e) {

// When Graph returns an error

echo 'Graph returned an error: ' . $e->getMessage();

session_destroy();

// redirecting user back to app login page

header("Location: ./");

exit;

} catch(Facebook\Exceptions\FacebookSDKException $e) {

// When validation fails or other local issues

echo 'Facebook SDK returned an error: ' . $e->getMessage();

exit;

}

} else {

// replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used            

$loginUrl = $helper->getLoginUrl('http://localhost/oop_login/login-form-7.php?hellofb=true', $permissions);

}

?>