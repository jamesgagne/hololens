<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Workspace extends CI_Controller {

		private $TPL = [];

		public function __construct()
		{
			parent::__construct();
			
			$this->TPL["UserLoggedIn"] = $this->userauthor->IsUserLoggedIn();
			
			$email = $this->userauthor->GetEmail();
				
			$this->TPL["Email"] = $email;
			$this->TPL["AccessLevel"] = $this->userauthor->GetAccessLevel($email);
			$this->TPL["ProfilePicture"] = $this->userauthor->GetProfilePicture($email);
			
			if(!$this->TPL["UserLoggedIn"])
			{
				$homepage = base_url();
				$this->userauthor->Redirect($homepage);
			}
		}
		
		public function index()
		{
			$email = $this->userauthor->GetEmail();
			
			$this->TPL["Workspaces"] = $this->GetWorkspacesForUser($email);
			
			$this->template->show("workspace", $this->TPL);
		}
		
		private function GetWorkspacesForUser($email)
		{
			$user_id = $this->db->get_where("hl_users", array("email" => $email))->result_array()[0]["user_id"];
			
			$workspaces = $this->db->get_where("hl_spaces", array("user_id" => $user_id))->result_array();
			
			return $workspaces;
		}
	}