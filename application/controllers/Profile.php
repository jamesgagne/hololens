<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Profile extends CI_Controller {

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
				if(count($_POST) > 0)
				{
				  $this->Update();
				}
				  
				  $this->template->show("profile", $this->TPL);
			}
			else
			{
				  $homepage = base_url();
				  $this->userauthor->Redirect($homepage);			
				
			}
		}
		
		public function Update()
		{
			$this->TPL["errorList"] = [];
			$didSucceed = false;
			
			$email = $_POST["update-email"];
			$first_name = $_POST["first-name"];
			$last_name = $_POST["last-name"];
			$picture = $_FILES["update-picture"];
			
			if($this->VerifyAccountInfo($email, $first_name, $last_name, $picture))
			{				
				$picture_ID = uniqid();
				$picture_Ext = substr($picture["name"], strpos($picture["name"], "."));
				
				$picture["name"] = $picture_ID . $picture_Ext;
				
				$target_dir = profilePicturePath() . $picture["name"];
				$picture_link = assetUrl() . "img/profile/" . $picture["name"];
				
				if (move_uploaded_file($picture["tmp_name"], $target_dir) || !$updatePicture) 
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
						"first_name" => $first_name,
						"last_name" => $last_name,
						"picture_id" => $picture_id
					);
					if (!$updateEmail)
					{
						unset($values["email"]);
					}
					
					if (!updateFirstName)
					{
						unset($values["first_name"]);
					}
					
					if (!updateLastName)
					{
						unset($values["last_name"]);
					}
					
					if (!updatePicture)
					{
						unset($values["picture_id"]);
					}
			
					$this->db->update("hl_users", $values);
					
					$this->db->trans_complete();
					
					$didSucceed = true;
				}
				else
				{
					array_push($this->TPL["errorList"], "Sorry, there was an error uploading your file.");
				}
			
			}
			
			// if failed set form memory
			if($didSucceed == false)
			{
				$this->TPL["email"] = $email;
				$this->TPL["first_name"] = $first_name;
				$this->TPL["last_name"] = $last_name;
				$this->TPL["picture"] = $picture;
			}
			else
			{
				$this->TPL["success"] = "Account information updated successfully!";
			}
		}
		
		private function VerifyAccountInfo($email, $first_name, $last_name, $picture)
		{
			$isValid = true;
			
			// Check if email is already in use
			if($this->userauthor->IsUserInDatabase($email))
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Email is already in use!");
			}
			
			// Check if user updated email
			if(empty($email))
			{
				$updateEmail = false;
			}
			// Email validation
			else if(!preg_match("/[a-z0-9]{1,}@[a-z0-9].{1,}/", strtolower($email)))
			{
				$isValid = false;
				
				array_push($this->TPL["errorList"], "Email not in correct format! Format is eg. abc@abc.com");
			}
			
			// Check if user updated first name
			if(empty($first_name))
			{
				$updateFirstName = false;
			}
			
			// Check if user updated last name
			if(empty($last_name))
			{
				$updateLastName = false;
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
			else
			{
				$updatePicture = false;
			}
			
			return $isValid;
		}
	}
?>
