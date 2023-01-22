<?php
class Signup extends Dbh {
	
	protected function setUser($uid, $pwd, $email) {
		$stmt = $this->connect()->prepare('INSERT INTO users (users_uid, users_pwd, users_email) VALUES(?,?,?);');
		
		$hashpwd = password_hash($pwd, PASSWORD_DEFAULT);
		
		if( !$stmt->execute(array($uid, $hashpwd, $email)) ) {
			$stmt =null;
			header('Location: ../login-form-7.php?error=stmtfailedinsert');
			exit();
		}
		$stmt =null;
		
	}
	
	
	protected function checkuser($uid, $email) {
		$stmt = $this->connect()->prepare('SELECT user_uid from users WHERE users_uid = ? OR users_email = ?;');
		
		if( $stmt->execute(array($uid,$email)) ) {
			$stmt =null;
			header('Location: ../login-form-7.php?error=stmtfailed');
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