<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Register extends CI_Controller {

		private $TPL = [];

		public function __construct()
		{
			parent::__construct();
			
			$this->TPL["UserLoggedIn"] = $this->userauthor->IsUserLoggedIn();
			
			$this->TPL["security_Questions"] = $this->userauthor->GetAllSecurityQuestions();
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
				if(count($_POST) > 0)
				{
					$this->Register();
				}
				
				$this->template->show("register", $this->TPL);
			}
		}
		
		public function Register()
		{
			$this->TPL["errorList"] = [];
			$didSucceed = false;
			
			$username = $_POST["register-username"];
			$password = $_POST["register-password"];
			$confirm_password = $_POST["confirm-password"];
			$email = $_POST["email"];
			$confirm_email = $_POST["confirm-email"];
			$picture = $_FILES["picture"];
			
			$first_name = $_POST["first-name"];
			$last_name = $_POST["last-name"];
			
			$security_question = $_POST["security-question"];
			$answer = $_POST["answer"];
			
			if($this->VerifyAccountInfo($username, $password, $confirm_password, $email, $confirm_email, $picture))
			{
				if($this->VerifyPasswordResetInfo($security_question, $answer))
				{	
					if(file_exists($picture["tmp_name"]) || is_uploaded_file($picture['tmp_name']))
					{
						$picture_ID = uniqid();
						$picture_Ext = substr($picture["name"], strpos($picture["name"], "."));
						
						$picture["name"] = $picture_ID . $picture_Ext;
						
						$target_dir = "/home/student/000328298/public_html/private/hololens/application/assets/img/" . $picture["name"];
						$picture_link = assetUrl() . "../assets/img/" . $picture["name"];
						
						if (move_uploaded_file($picture["tmp_name"], $target_dir)) 
						{
							$this->db->trans_start();
					
							$stmt = "INSERT INTO hl_files (file_id, name, description, location, size, category_id) VALUES (?, ?, ?, ?, ?, ?);";
							$query = $this->db->query($stmt, array($file_id, $picture["name"], "User Profile Picture", "../assets/img/", ""));						
							
							$stmt = "INSERT INTO hl_users (user_id, name, salt, email, enckey, access_level_id, ) VALUES (?, ?, ?, ?, ?, ?);";
							$query = $this->db->query($stmt, array($username, "", password_hash($password, PASSWORD_BCRYPT), $email, "", ""));
							
							$this->db->trans_complete();
							
							$didSucceed = true;
						}
						else
						{
							array_push($this->TPL["errorList"], "Sorry, there was an error uploading your file.");
						}
					}
					else
					{
						$this->db->trans_start();
						
						$stmt = "INSERT INTO hl_users (user_id, name, salt, email, enckey, access_level_id, ) VALUES (?, ?, ?, ?, ?, ?);";
						$query = $this->db->query($stmt, array($username, "", password_hash($password, PASSWORD_BCRYPT), $email, "", ""));
						$this->db->trans_complete();
						
						$didSucceed = true;
					}
				}
			
			}
			
			// if failed set form memory
			if($didSucceed == false)
			{				
				$this->TPL["username"] = $username;
				$this->TPL["password"] = $password;
				$this->TPL["confirm_password"] = $confirm_password;
				$this->TPL["email"] = $email;
				$this->TPL["confirm_email"] = $confirm_email;
				$this->TPL["picture"] = $picture;
				
				$this->TPL["first_name"] = $first_name;
				$this->TPL["last_name"] = $last_name;
				
				$this->TPL["security_question"] = $security_question;
				$this->TPL["answer"] = $answer;
			}
			else
			{
				$this->TPL["success"] = "Account created successfully! Please login to access member specific funtionality!";
			}
		}
		
		private function VerifyAccountInfo($username, $password, $confirm_password, $email, $confirm_email, $picture)
		{
			$isValid = true;
			
			// Validate Username and Password
			if(!$this->userauthor->ValidateLoginCredentials($username, $password))
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Username or Password cannot be blank!");
			}
			
			// Check if username is already in use
			if($this->userauthor->IsUserInDatabase($username))
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Username is already in use!");
			}
			
			// Check that password and password confirmation are the same
			if($password != $confirm_password)
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Passwords do not match!");
			}
			
			// Email Validation
			if(empty($email))
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Email is required!");
			}
			else if(!preg_match("/[a-z0-9]{1,}@[a-z0-9].{1,}/", strtolower($email)))
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Email not in correct format! Format is eg. abc@abc.com");
			}
			
			// Check that email and email confirmation are the same
			if($email != $confirm_email)
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Emails do not match!");
			}
			
			// Check if user uploaded a profile picture
			if(file_exists($picture["tmp_name"]) || is_uploaded_file($picture['tmp_name']))
			{
				// Check that profile picture is in correct format
				if(!preg_match("/image\/png|jpg|jpeg/", $picture["type"]))
				{
					$isValid = false;
					
					array_push($this->TPL["errorList"], "File type must be PNG, JPG, or JPEG");
				}
			}
			
			return $isValid;
		}
		
		private function VerifyPasswordResetInfo($security_question, $answer)
		{
			return !(empty($security_question) && empty($answer));
		}
	}
?>
