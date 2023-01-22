<?php

class SignupContr extends Signup {
	
	private $uid;
	private $pwd;
	private $pwdrepeat;
	private $email;
	
	public function __construct($uid, $pwd, $pwdrepeat, $email) {
		$this->uid = $uid;
		$this->pwd = $pwd;
		$this->pwdrepeat = $pwdrepeat;
		$this->email = $email;	
	}
	
	public function SignupUser() {
		if($this->emptyInput() == false) {
			//empty input
			header('Location: ../login-form-7.php?error=emptyinput');
			exit();
		}
		//invalid username
		if($this->invalidUid() == false) {
			//empty input
			header('Location: ../login-form-7.php?error=username');
			exit();
		}
		
		//invalid email
		if($this->invalidEmail() == false) {
			//empty input
			header('Location: ../login-form-7.php?error=email');
			exit();
		}
		
		//password do not match
		if($this->pwdMatch() == false) {
			//empty input
			header('Location: ../login-form-7.php?error=passwordmatch');
			exit();
		}
		
		//invalid email
		if($this->uidTakencheck() == false) {
			//empty input
			header('Location: ../login-form-7.php?error=useroremailtaken');
			exit();
		}
		
		$this->setUser($this->uid, $this->pwd, $this->email);
	}
	
	
	
	private function emptyInput() {
		$result;
		if(empty($this->uid || $this->pwd || $this->pwdrepeat || $this->email)) {
		$result = false;
		
		}else{
		
		$result = true;
			
		}
		
		return $result;
	}
	
	private function invalidUid() {
		$result;
		if( !preg_match("/^[a-zA-Z0-9]*$/", $this->uid) ) {
			$result =false;
		}else{
			
			$result = true;
			
		}
		
		return $result;
		
	}
	
	private function invalidEmail() {
		$result;
		if( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ){
			$result= false;
		}else{
			$result = true;
		}
		return $result;
	}
	
	private function pwdMatch() {
		$result;
		if( $this->pwd !== $this->pwdrepeat ){
			$result= false;
		}else{
			$result = true;
		}
		return $result;
	}
	
	private function uidTakencheck() {
		$result;
		if( $this->checkUser($this->uid, $this->email) ){
			$result= false;
		}else{
			$result = true;
		}
		return $result;
	}
	
}

?>