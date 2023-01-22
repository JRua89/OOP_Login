<?php
class pwdReset extends Dbh {

	 function userDelete($email) {
	
		
		 $stmt = $this->connect()->prepare('DELETE from pwdreset WHERE pwdRedetEmail = ?;');
		
		if( !$stmt->execute(array($email)) ) {
			$stmt =null;
			header('Location: ../login-form-7.php?error=stmtfailed1');
			exit();
		}
		
		$resultCheck;
		if( $stmt->rowCount() > 0 ) {
			$resultCheck = false;
		}else{
			$resultCheck =true;
		}
		
		return $resultCheck;
	}
	
		 function userInsert($userEmail, $selector, $hashedToken, $expires ) {
	
		
		 $stmt = $this->connect()->prepare('INSERT INTO pwdreset (pwdRedetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?)');
		
		if( !$stmt->execute(array($userEmail, $selector, $hashedToken, $expires )) ) {
			$stmt =null;
			header('Location: ../login-form-7.php?error=stmtfailed2');
			exit();
		}
		
		$resultCheck;
		if( $stmt->rowCount() > 0 ) {
			$resultCheck = false;
		}else{
			$resultCheck =true;
		}
		
		return $resultCheck;
	}
	
	
	
}
?>