<?php
session_start();

if($_SESSION['user_type'] == 'Google'){

    include('..\GLogin\GLogin.php');

    //Reset OAuth access token
    $client->revokeToken();
    
    //Destroy entire session data.
    session_unset();
    session_destroy();

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