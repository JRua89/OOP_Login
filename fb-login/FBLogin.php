<?php
// require_once "vendor/autoload.php";

// session_start();

// $fb = new \Facebook\Facebook([
	// 'app_id'=>'884433022864848',
	// 'app_secret'=>'93626d873b1bfeb4252cb82d4fc2a57a',
	// 'default_graph_version'=>'v2.5',
// ]);


// $helper=$fb->getRedirectLoginHelper();
// if(isset($_GET['code'])){
// if(isset($SESSION['access_token'])){
	// $access_token = $_SESSION['access_token'];
// }else{

	// $access_token=$helper->getAccessToken();
	// $_SESSION['access_token']=$access_token;

	// $fb->setDefaultAccessToken($_SESSION['access_token']);

// }

// $_SESSION['user_name']='';
// $_SESSION['user_email_address']='';

// $graph_response=$fb->get("/me?fields=name,email",$access_token);
// $facebook_user_info=$graph_response->getGraphUser();

 // $_SESSION['user_name']=$facebook_user_info['name'];
 // $_SESSION['user_email_address']=$facebook_user_info['email'];

// $requestpicture=$fb->get("/me/picture?redirect=false&height=150",$access_token);
// $fbpic=$graph_response->getGraphUser();

// $_SESSION['user_pic']=$fbpic;
// }else{
 // $permissions=['email'];

// $login_url=$helper->getLoginUrl('http://localhost/fb-login/',$permissions);

// }
// ?>

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

if (isset($_GET['code'])) {

header('Location: fb-login/profile.php');

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

$_SESSION['fb_id'] = $fbid.'</br>';

$_SESSION['fb_name'] = $fbfullname.'</br>';

$_SESSION['fb_email'] = $fbemail.'</br>';

$_SESSION['fb_pic'] = $fbpic.'</br>';

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

$loginUrl = $helper->getLoginUrl('http://localhost/oop_login/login-form-7.php', $permissions);


}

?>