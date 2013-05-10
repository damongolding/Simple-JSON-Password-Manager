<?php

class login
{
	private $pw = "1f37af897f23b496f7617e7a973143d0ea85357a2aa3a5de30b0a66bb658d6ed91876d2e2de1209ff2c2179b81a5db4e38cfb3814035e57959c1fc244ffdb6ad"; // your pass word encrypted
	private $check;
	
	// lets check to see if the password entered is the correct
	public function check($pass)
	{
		// first we need to encrypt it
		$this->check = hash("sha512", $pass);
		
		if($this->check == $this->pw)
		{
			// if correct call the correct function
			$this->loginCorrect();
		}
		else
		{
			// and if incorrect..
			$this->loginIncoreect();
		}
	}
	
	private function loginCorrect()
	{
		include("index.php");
	}
	
	private function loginIncoreect()
	{
		$error = true;
		include("loginForm.php");
	}
}

?>