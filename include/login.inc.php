<?php


if(isset($_POST["submit"])){

// Grabbing the data
$uid = $_POST["uid"];
$pwd = $_POST["pwd"];	

	
//Instamtiate signupcontr class_alias
include "../classes/dbh.classes.php";
include "../classes/login.classes.php";
include "../classes/login-contr.classes.php";

$login = new loginContr($uid, $pwd);

//Running error handler and user signupcontr
$login->loginUser();

//Going to back to front page
header("Location: ../home.php?error=none");
	
}

?>