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
			
			$email = $_POST["register-email"];
			$confirm_email = $_POST["confirm-email"];
			$password = $_POST["register-password"];
			$confirm_password = $_POST["confirm-password"];
			$picture = $_FILES["register-picture"];
			
			$first_name = $_POST["first-name"];
			$last_name = $_POST["last-name"];
			
			$security_question = $_POST["security-question"];
			$answer = $_POST["answer"];
			
			if($this->VerifyAccountInfo($email, $confirm_email, $password, $confirm_password, $picture))
			{
				$memberAccessLevelID = $this->db->get_where("hl_access_levels", array("name" => "Member"))->result_array()[0]["access_level_id"];
				
				if($this->VerifyPasswordResetInfo($security_question, $answer))
				{	
					if(file_exists($picture["tmp_name"]) || is_uploaded_file($picture['tmp_name']))
					{
						$picture_ID = uniqid();
						$picture_Ext = substr($picture["name"], strpos($picture["name"], "."));
						
						$picture["name"] = $picture_ID . $picture_Ext;
						
						// string manipulation stuff to get releative file directory path so that it should work on everyones csunix
						$startIndex = strpos(assetUrl(), "~") + 1;
						$endIndex = strpos(assetUrl(), "/private");
						
						$target_dir = "/home/student/" . substr(assetUrl(), $startIndex, ($endIndex - $startIndex)) . "/public_html" . substr(assetUrl(), strpos(assetUrl(), "/private/")) . "img/profile/" . $picture["name"];
						$picture_link = assetUrl() . "img/profile/" . $picture["name"];
						
						if (move_uploaded_file($picture["tmp_name"], $target_dir)) 
						{
							$this->db->trans_start();
							
							$values = array(
								"description" => "User profile picture",
								"link" => $picture_link
							);
							
							$this->db->insert("hl_pictures", $values);
							
							// get new picture_id - could also generate and use unique id here for picture and save the db call
							$picture_id = $this->db->get_where("hl_pictures", array("link" => $picture_link))->result_array()[0]["picture_id"];
							
							$values = array(
								"email" => $email,
								"enckey" => password_hash($password, PASSWORD_BCRYPT),
								"first_name" => $first_name,
								"last_name" => $last_name,
								"access_level_id" => $memberAccessLevelID,
								"picture_id" => $picture_id
							);
					
							$this->db->insert("hl_users", $values);
							
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
						$values = array(
							"email" => $email,
							"enckey" => password_hash($password, PASSWORD_BCRYPT),
							"first_name" => $first_name,
							"last_name" => $last_name,
							"access_level_id" => $memberAccessLevelID
						);
						
						$query = $this->db->insert("hl_users", $values);
						
						$didSucceed = true;
					}
				}
			
			}
			
			// if failed set form memory
			if($didSucceed == false)
			{
				$this->TPL["email"] = $email;
				$this->TPL["confirm_email"] = $confirm_email;				
				$this->TPL["password"] = $password;
				$this->TPL["confirm_password"] = $confirm_password;
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
		
		private function VerifyAccountInfo($email, $confirm_email, $password, $confirm_password, $picture)
		{
			$isValid = true;
			
			// Validate Email and Password
			if(!$this->userauthor->ValidateLoginCredentials($email, $password))
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Email or Password cannot be blank!");
			}
			
			// Check if email is already in use
			if($this->userauthor->IsUserInDatabase($email))
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Email is already in use!");
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
