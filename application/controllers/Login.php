<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller 
	{
		private $TPL = [];

		public function __construct()
		{
			parent::__construct();

			$this->TPL["UserLoggedIn"] = $this->userauthor->IsUserLoggedIn();
		}

		public function index()
		{
			if($this->TPL["UserLoggedIn"])
			{
				$homepage = base_url();
				$this->userauthor->Redirect($homepage);
			}
			else
			{
				if(isset($_POST))
				{
					$this->TPL["errorList"] = [];
					
					if(isset($_POST["login-email"]))
					{
						$email = $_POST["login-email"];
					}
					else
					{
						$email = $_POST["email"];
					}
					
					if(isset($_POST["login-password"]))
					{
						$password = $_POST["login-password"];
					}
					else
					{
						$password = $_POST["password"];
					}

					$this->TPL["errorList"] = $this->userauthor->Login($email, $password);
					
					if(sizeof($this->TPL["errorList"]) == 0)
					{
						$homepage = base_url();
						$this->userauthor->Redirect($homepage);
					}			
					else
					{
						
					}
				}
				
				$this->template->show("login", $this->TPL);
			}
		}
	}
?>