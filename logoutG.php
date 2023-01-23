<?php

//logout.php

include('GLogin\GLogin.php');

//Reset OAuth access token
$google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect page to index.php
header('location:login-form-7.php');

?>