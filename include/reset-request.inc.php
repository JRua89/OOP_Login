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
   
   $to = 'JRua89@gmail.com';
$subject = 'Hello from XAMPP!';
$message = 'This is a test';
$headers = "From: securerua@gmail.com\r\n";
if (mail($to, $subject, $message, $headers)) {
   echo "SUCCESS";
} else {
   echo "ERROR";
}
/////////////////////////////////////////////

// require '../phpmailer/phpmailer/src/PHPMailer.php';
// $mail = new PHPMailer;
// $mail->isSMTP();
// $mail->SMTPSecure = 'ssl';
// $mail->SMTPAuth = true;
// $mail->Host = 'smtp.gmail.com';
// $mail->Port = 465;
// $mail->Username = 'your-gmail-username@gmail.com';
// $mail->Password = 'your-gmail-password';
// $mail->setFrom('your@email-address.com');
// $mail->addAddress('recipients@email-address.com');
// $mail->Subject = 'Hello from PHPMailer!';
// $mail->Body = 'This is a test.';
// //send the message, check for errors
// if (!$mail->send()) {
//     echo "ERROR: " . $mail->ErrorInfo;
// } else {
//     echo "SUCCESS";
// }



}else{
	
	header("Location: ../login-form-7.php");
	
}
?>