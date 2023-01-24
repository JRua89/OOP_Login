<?php
    // require config and twitter helper
    
    // your app consumer key
    define( 'CONSUMER_KEY', 't9bJLutgVx1jZAuRnvtxWdLU4' );

    // your app consumer secret
    define( 'CONSUMER_SECRET', 'GmiflpvGQ4zYrGqZrWzot9jJgWo23ysNHKZd8HkpscsuTFzHKn' );

    // your app callback url
    define( 'OAUTH_CALLBACK', 'http://localhost/oop_login/login-form-7.php' );

    require 'vendor/autoload.php';

    // use our twitter helper
    use Abraham\TwitterOAuth\TwitterOAuth;

    if ( isset( $_SESSION['twitter_access_token'] ) && $_SESSION['twitter_access_token'] ) { // we have an access token
        $isLoggedIn = true;    
    } elseif ( isset( $_GET['oauth_verifier'] ) && isset( $_GET['oauth_token'] ) && isset( $_SESSION['oauth_token'] ) && $_GET['oauth_token'] == $_SESSION['oauth_token'] ) { // coming from twitter callback url
        // setup connection to twitter with request token
        $connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
        
        // get an access token
        $access_token = $connection->oauth( "oauth/access_token", array( "oauth_verifier" => $_GET['oauth_verifier'] ) );

        // save access token to the session
        $_SESSION['twitter_access_token'] = $access_token;

        // user is logged in
        $isLoggedIn = true;
    } else { // not authorized with our app, show login button
        // connect to twitter with our app creds
        $connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET );

        // get a request token from twitter
        $request_token = $connection->oauth( 'oauth/request_token', array( 'oauth_callback' => OAUTH_CALLBACK ) );

        // save twitter token info to the session
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

        // user is logged in
        $isLoggedIn = false;
    }

    if ( $isLoggedIn ) { // logged in
        // get token info from session
        $oauthToken = $_SESSION['twitter_access_token']['oauth_token'];
        $oauthTokenSecret = $_SESSION['twitter_access_token']['oauth_token_secret'];

        // setup connection
        $connection = new TwitterOAuth( CONSUMER_KEY, CONSUMER_SECRET, $oauthToken, $oauthTokenSecret );

        // user twitter connection to get user info
        $user = $connection->get( "account/verify_credentials", ['include_email' => 'true'] );
      
        if ( property_exists( $user, 'errors' ) ) { // errors, clear session so user has to re-authorize with our app
            $_SESSION = array();
            header( 'Refresh:0' );
        } else { // display user info in browser
        
        if(!empty( $user->name ))
        {
        $_SESSION['name'] = $user->name;
        }

        if(!empty( $user->id ))
        {
        $_SESSION['userid'] = $user->id;
        }

        if(!empty( $user->screen_name ))
        {
            $_SESSION['screen_name'] = $user->screen_name;
        }

        $_SESSION['user_type'] = "twitter";
 
        header('Location: home.php');
        exit();

        }
    } else {  // not logged in, get and display the login with twitter link
        
        $twitter_Login = $connection->url( 'oauth/authorize', array( 'oauth_token' => $request_token['oauth_token'] ) );
        
    }