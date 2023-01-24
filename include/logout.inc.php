<?php
session_start();

if($_SESSION['user_type'] == 'Google'){

    include('..\GLogin\GLogin.php');

    //Reset OAuth access token
    $client->revokeToken();
    
    //Destroy entire session data.
    session_unset();
    session_destroy();

    session_unset($_SESSION["userid"]);

}elseif($_SESSION['user_type'] == 'facebook'){
    
    session_unset();
    
    $_SESSION['userid'] = NULL;
    $_SESSION['fb_name'] = NULL;
    $_SESSION['fb_email'] =  NULL; 
    $_SESSION['fb_pic'] =  NULL;
    
    session_unset($_SESSION["userid"]);

}elseif($_SESSION['user_type'] == 'twitter'){
    session_unset();
    
    $_SESSION['userid'] = NULL;
    $_SESSION['name'] = NULL;
    $_SESSION['screen_name'] =  NULL; 
    
    session_unset($_SESSION["userid"]);
}else{

    session_unset();
    session_destroy();

    session_unset($_SESSION["userid"]);
    session_unset($_SESSION["useruid"]);

}

//Going to back to front page
header("Location: ../login-form-7.php");
exit();

?>