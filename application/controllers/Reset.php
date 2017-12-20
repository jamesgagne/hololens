<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Reset extends CI_Controller {

		var $TPL = [];

		public function __construct()
		{
			parent::__construct();
			
			$this->TPL["UserLoggedIn"] = $this->userauthor->IsUserLoggedIn();
		}

		public function index()
		{		
			if($this->TPL["UserLoggedIn"])
			{
				$username = $this->userauthor->GetUsername();
				
				$this->TPL["Username"] = $username;
				$this->TPL["PrivilegeLevel"] = $this->userauthor->GetPrivilegeLevel($username);
				$this->TPL["ProfilePicture"] = $this->userauthor->GetProfilePicture($username);
			}
			
			if(count($_POST) > 0)
			{
				$username = $_POST["username-reset"];
				
				if(isset($_POST["password-reset"]) AND isset($_POST["confirm-password-reset"]))
				{
					$password = $_POST["password-reset"];
					$confirm_password = $_POST["confirm-password-reset"];
					
					if(empty($password))
					{
						$this->TPL["Error"] = "Password cannot be empty!";
						
						$this->template->show("reset_password", 'faq', $this->TPL);
					}
					else
					{
						if($password == $confirm_password)
						{							
							//$stmt = "UPDATE Account " . 
							//			"SET Password = ? " .
							//			"WHERE Username = ?;";
							
							$query = $this->db->query($stmt, array(password_hash($password, PASSWORD_BCRYPT), $username));
							
							$this->TPL["Success"] = "Password changed successfully! You can now login using your new password!";
							
							$this->template->show("reset_password", 'faq', $this->TPL);
						}
						else
						{
							$this->TPL["Error"] = "Passwords do not match!";
							
							$this->template->show("reset_password", 'faq', $this->TPL);
						}
					}
				}
				else if(isset($_POST["answer"]))
				{
					$answer = $_POST["answer"];
					
					if(empty($answer))
					{
						$this->TPL["Error"] = "You must enter your security question answer!";
						$this->TPL["Question"] = $_POST["question"];
						$this->TPL["Username"] = $username;
						
						$this->template->show("reset_question", 'faq', $this->TPL);
					}
					else
					{
						//$stmt = "SELECT Security_Question_Answer " . 
						//			"FROM Account " .
						//			"WHERE Username = ?;";
									
						$query = $this->db->query($stmt, array($username));
						$result = $query->result_array()[0];

						if($answer == $result["Security_Question_Answer"])
						{
							$this->TPL["Username"] = $username;
							
							$this->template->show("reset_password", 'faq', $this->TPL);
						}
						else
						{
							$this->TPL["Error"] = "Your answer does not match!";
							$this->TPL["Question"] = $_POST["question"];
							$this->TPL["Username"] = $username;
							
							$this->template->show("reset_question", 'faq', $this->TPL);
						}
					}
				}
				else
				{
					if(empty($username))
					{
						$this->TPL["Error"] = "You must enter your username!";
						
						$this->template->show("reset", 'faq', $this->TPL);
					}
					else
					{
						//$stmt = "SELECT * " . 
						//			"FROM Account " .
						//			"WHERE Username = ?;";
						//
						
						$query = $this->db->query($stmt, array($username));
						$result = $query->result_array();
						
						if(count($result) == 1)
						{		
							//$stmt = "SELECT Question " . 
							//			"FROM Account as a " .
							//			"JOIN Security_Question as s ON a.Security_Question_ID = s.Security_Question_ID " .
							//			"WHERE Username = ?;";
										
							$query = $this->db->query($stmt, array($username));
							$result = $query->result_array();
							
							$this->TPL["Question"] = $result[0]["Question"];
							$this->TPL["Username"] = $username;
							
							$this->template->show("reset_question", $this->TPL);
						}
						else
						{
							$this->TPL["Error"] = "No such user found!";
						
							$this->template->show("reset", $this->TPL);
						}
					}
				}
			}
			else
			{
				$this->template->show("reset", $this->TPL);
			}
		}
	}
?>