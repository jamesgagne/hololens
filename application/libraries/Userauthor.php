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
		
		public function Login($username, $password)
		{			
			if($this->IsUserLoggedIn())
			{
				$this->Userauthor->Redirect();
			}
			else 
			{
				$isValid = true;
				$errors = [];
				
				if(!$this->ValidateLoginCredentials($username, $password))
				{
					$isValid = false;
					
					array_push($errors, "Username and password cannot be blank!");
				}
				else
				{
					if(!$this->IsUserInDatabase($username))
					{
						$isValid = false;
						
						array_push($errors, "No such user exists!");
					}
					else
					{
						if($this->IsUserSuspended($username))
						{
							$isValid = false;
							
							array_push($errors, "User is suspended you cannot login until your suspension ends!");
						}
						else
						{
							if($this->IsUserBanned($username))
							{
								$isValid = false;
								
								array_push($errors, "User is banned, you cannot login!");
							}
						}
					}
				}
				
				if($isValid)
				{
					//$stmt = "SELECT * FROM Account WHERE Username = ?;";
					$query = $this->CI->db->query($stmt, array($username));
					$result = $query->result_array();
					
					$hashedPassword = $result[0]["Password"];
					
					if(password_verify($password, $hashedPassword))
					{
						$privilegeLevel = $this->GetPrivilegeLevel($username);
					
						$this->WriteSession($username, $privilegeLevel);
					
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
			//$stmt = "SELECT * FROM Security_Question;";
			$query = $this->CI->db->query($stmt, array());
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
			
			return (isset($_SESSION['username']));
		}
		
		public function IsUserBanned($username)
		{
			//$stmt = "SELECT * FROM Account WHERE Username = ?;";
			$query = $this->CI->db->query($stmt, array($username));
			$result = $query->result_array();

			return ($result[0]["Account_Status"] == "Banned");
		}
		
		public function IsUserSuspended($username)
		{
			//$stmt = "SELECT * FROM Suspension WHERE Username = ?;";
			$query = $this->CI->db->query($stmt, array($username));
			$result = $query->result_array();

			return (sizeof($result) == 1);
		}
		
		public function IsUserInDatabase($username)
		{
			//$stmt = "SELECT * FROM Account WHERE Username = ?;";
			$query = $this->CI->db->query($stmt, array($username));
			$result = $query->result_array();
			
			return (sizeof($result) == 1);
		}
		
		public function ValidateLoginCredentials($username, $password)
		{
			return ((empty($username) == false) && (empty($password) == false));
		}
		
		public function GetUsername()
		{
			return $_SESSION['username'];
		}
		
		public function GetPrivilegeLevel($username)
		{
			if(isset($_SESSION["PrivilegeLevel"]))
			{
				return $_SESSION["PrivilegeLevel"];
			}
			else
			{
				//$stmt = "SELECT * FROM Account WHERE Username = ?;";
				$query = $this->CI->db->query($stmt, array($username));
				$result = $query->result_array();
			
				return $result[0]["Privilege_Level_ID"];
			}
		}
		
		public function Redirect($page) 
		{
			header("Location: " . $page);
			exit;
		}
		
		public function GetProfilePicture($username)
		{
			//$stmt = "SELECT * FROM Account AS a JOIN CAP_Picture AS p ON a.Picture_ID = p.Picture_ID WHERE Username = ?;";
			$query = $this->CI->db->query($stmt, array($username));
			$result = $query->result_array();
		
			return $result[0]["Link"];
		}
		
		private function WriteSession($username, $privilegeLevel)
		{
			$_SESSION['username'] = $username;
			$_SESSION["privilegeLevel"] = $privilegeLevel;
		}
	}
?>