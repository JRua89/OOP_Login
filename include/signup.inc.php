<?php


if(isset($_POST["submit"])){

// Grabbing the data
$uid = $_POST["uid"];
$pwd = $_POST["pwd"];	
$pwdrepeat = $_POST["pwdrepeat"];
$email = $_POST["email"];
	
//Instamtiate signupcontr class_alias
include "../classes/dbh.classes.php";
include "../classes/signup.classes.php";
include "../classes/signup-contr.classes.php";

$signup = new SignupContr($uid, $pwd, $pwdrepeat, $email);

//Running error handler and user signupcontr
$signup->SignupUser();
//Going to back to front page
header("Location: ../login-form-7.php?error=none");
	
}

?>