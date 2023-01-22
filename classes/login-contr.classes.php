<?php

class loginContr extends Login {
	
	private $uid;
	private $pwd;
	
	
	public function __construct($uid, $pwd) {
		$this->uid = $uid;
		$this->pwd = $pwd;
	
	}
	
	public function loginUser() {
		if($this->emptyInput() == false) {
			//empty input
			header('Location: ../login-form-7.php?error=emptyinput');
			exit();
		}
			
		$this->getUser($this->uid, $this->pwd);
	}
	
	
	
	private function emptyInput() {
		$result;
		if( empty($this->uid || $this->pwd) ) {
		$result = false;
		
		}else{
		
		$result = true;
			
		}
		
		return $result;
	}
	
	
	
}

?>