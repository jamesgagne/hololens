<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Userauthor
	{
		private $CI;
		
		function __construct() 
		{
			error_reporting(E_ALL & ~E_NOTICE);
			
			$this->CI =& get_instance();
		}
		
		public function Login($email, $password)
		{			
			if($this->IsUserLoggedIn())
			{
				$this->Userauthor->Redirect();
			}
			else 
			{
				$isValid = true;
				$errors = [];
				
				if(!$this->ValidateLoginCredentials($email, $password))
				{
					$isValid = false;
					
					array_push($errors, "Email and password cannot be blank!");
				}
				else
				{
					if(!$this->IsUserInDatabase($email))
					{
						$isValid = false;
						
						array_push($errors, "No such user exists!");
					}
				}
				
				if($isValid)
				{
					$query = $this->CI->db->get_where("hl_users", array("email" => $email));
					
					$result = $query->result_array();
					
					$hashedPassword = $result[0]["enckey"];
					
					if(password_verify($password, $hashedPassword))
					{
						$accessLevel = $this->GetAccessLevel($email);
					
						$this->WriteSession($email, $accessLevel);
					
						return [];
					}
					else
					{
						array_push($errors, "Password is incorrect please try again!");
						
						return $errors;
					}
				}
				else
				{
					return $errors;
				}
			}
		}
		
		public function GetAllSecurityQuestions()
		{
			$query = $this->CI->db->get("hl_security_questions");
			$result = $query->result_array();

			return $result;
		}
		
		public function Logout()
		{
			session_start();
			
			$_SESSION = array();
			
			session_destroy();
		}
		
		public function IsUserLoggedIn()
		{
			session_start();
			
			return (isset($_SESSION['Email']));
		}
		
		public function IsUserInDatabase($email)
		{
			$query = $this->CI->db->get_where("hl_users", array("email" => $email));
			$result = $query->result_array();
			
			return (sizeof($result) == 1);
		}
		
		public function ValidateLoginCredentials($email, $password)
		{
			return ((empty($email) == false) && (empty($password) == false));
		}
		
		public function GetEmail()
		{
			return $_SESSION['Email'];
		}
		
		public function GetAccessLevel($email)
		{
			if(isset($_SESSION["AccessLevel"]))
			{
				return $_SESSION["AccessLevel"];
			}
			else
			{			
				$this->CI->db->select("al.name");
				$this->CI->db->from("hl_users as u");
				$this->CI->db->join("hl_access_levels as al", "u.access_level_id = al.access_level_id");
				$query = $this->CI->db->get_where("hl_users", array("u.email" => $email));
				
				$result = $query->result_array();
				
				return $result[0]["name"];
			}
		}
		
		public function Redirect($page) 
		{
			header("Location: " . $page);
			exit;
		}
		
		public function GetProfilePicture($email)
		{			
			$this->CI->db->select("u.email, p.link");
			$this->CI->db->from("hl_users as u");
			$this->CI->db->join("hl_pictures as p", "u.picture_id = p.picture_id");
			$this->CI->db->where("u.email", $email);		
			$query = $this->CI->db->get();
				
			$result = $query->result_array();
		
			return $result[0]["link"];
		}
		
		private function WriteSession($email, $accessLevel)
		{
			$_SESSION['Email'] = $email;
			$_SESSION["AccessLevel"] = $accessLevel;
		}
	}
?>