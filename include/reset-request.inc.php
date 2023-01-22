<?PHP

if(isset($_POST["reset-request-submit"])){
	
	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);
	
	$url = "create-new-password.php?selector=" . $selector ."&validator=" . bin2hex($token);
	
	$expires = date("U") + 1800;
	$userEmail = $_POST["email"];
	
	include "../classes/dbh.classes.php";
	include "../classes/pwdreset.classes.php";
   
   $pwdReset = new pwdReset();
   
   $hashedToken = password_hash($token, PASSWORD_DEFAULT);

   $userDelete=$pwdReset->userDelete( $userEmail );
   $userInsert=$pwdReset->userInsert( $userEmail, $selector, $hashedToken, $expires );
   
   //send E-mail
   

   


$to_email = $userEmail;
$subject = "Test email to send from XAMPP";
$body = '<a href="' . $url . '">' . $url . '</a></p>';
$headers = "From: Jrua <Jrua@test.com>\r\n";
$headers .= "Reply-To: JRua89@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";
 
if (mail($to_email, $subject, $body, $headers))
 
{
    echo "Email successfully sent to $to_email...";
}
 
else
 
{
    echo "Email sending failed!";
}
   
   // mail($to, $subject, $message, $headers);
	
	// header('Location: ../pwdreset.php?reset=success');
	
}else{
	
	header("Location: ../login-form-7.php");
	
}
?>