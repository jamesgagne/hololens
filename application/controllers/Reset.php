<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Reset extends CI_Controller {

		var $TPL = [];

		public function __construct()
		{
			parent::__construct();
			
			$this->TPL["UserLoggedIn"] = $this->userauthor->IsUserLoggedIn();
			
			if($this->TPL["UserLoggedIn"])
			{
				$email = $this->userauthor->GetEmail();
				
				$this->TPL["Email"] = $email;
				$this->TPL["AccessLevel"] = $this->userauthor->GetAccessLevel($email);
				$this->TPL["ProfilePicture"] = $this->userauthor->GetProfilePicture($email);
			}
		}

		public function index()
		{
			if(count($_POST) > 0)
			{
				$email = $_POST["email-reset"];
				
				if(isset($_POST["password-reset"]) AND isset($_POST["confirm-password-reset"]))
				{
					$password = $_POST["password-reset"];
					$confirm_password = $_POST["confirm-password-reset"];
					
					if(empty($password))
					{
						$this->TPL["Error"] = "Password cannot be empty!";
						
						$this->template->show("reset_password", $this->TPL);
					}
					else
					{
						if($password == $confirm_password)
						{
							if(!empty($email))
							{
								$this->db->where("email", $email);
								$this->db->update("hl_users", array("enckey" => password_hash($password, PASSWORD_BCRYPT)));
							}
							
							$this->TPL["Success"] = "Password changed successfully! You can now login using your new password!";
							
							$this->template->show("reset_password", $this->TPL);
						}
						else
						{
							$this->TPL["Error"] = "Passwords do not match!";
							
							$this->template->show("reset_password", $this->TPL);
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
						$this->TPL["Email"] = $email;
						
						$this->template->show("reset_question", $this->TPL);
					}
					else
					{						
						$this->db->select("*");
						$this->db->from("hl_users as u");
						$this->db->join("hl_security_questions as sq", "u.security_question_id = sq.security_question_id", "left");
						$this->db->where("u.email", $email);
						$result = $this->db->get()->result_array()[0];
						
						if($answer == $result["security_question_answer"])
						{
							$this->TPL["Email"] = $email;
							
							$this->template->show("reset_password", $this->TPL);
						}
						else
						{							
							$this->TPL["Error"] = "Your answer does not match!";
							$this->TPL["Question"] = $_POST["question"];
							$this->TPL["Email"] = $email;
							
							$this->template->show("reset_question", $this->TPL);
						}
					}
				}
				else
				{
					if(empty($email))
					{
						$this->TPL["Error"] = "You must enter your email!";
						
						$this->template->show("reset", $this->TPL);
					}
					else
					{
						$result = $this->db->get_where("hl_users", array("email" => $email))->result_array();
						
						if(count($result) == 1)
						{									
							$this->db->select("*");
							$this->db->from("hl_users as u");
							$this->db->join("hl_security_questions as sq", "u.security_question_id = sq.security_question_id", "left");
							$this->db->where("email", $email);
							$result = $this->db->get()->result_array()[0];
							
							$this->TPL["Question"] = $result["question"];
							$this->TPL["Email"] = $email;
							
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