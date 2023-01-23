<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('238815036256-p47lj4a51f6mn6af9u42rfp5dnvbd6ua.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/oop_login/');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?> 