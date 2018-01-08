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
			
			if(count($_GET) > 0)
			{
				$space_id = $_GET["space_id"];
				
				$this->TPL["CurrentWorkspace"] = $_GET["space_id"];
				$this->TPL["Models"] = $this->GetModelsForWorkspace($space_id);
				$this->TPL["SpaceID"] = $space_id;
			}
			else
			{
				$space_id = $this->TPL["Workspaces"][0]["space_id"];
				
				$this->TPL["Models"] = $this->GetModelsForWorkspace($space_id);
				$this->TPL["SpaceID"] = $space_id;
			}
			
			$this->template->show("workspace", $this->TPL);
		}
		
		public function RemoveModel()
		{
			$model_id = $this->input->post("model_id");
			$space_id = $this->input->post("space_id");
			
			$this->db->delete("hl_space_file_lines", array("model_id" => $model_id, "space_id" => $space_id));
			
			$query = $this->db->get_where("hl_space_file_lines", array("model_id" => $model_id, "space_id" => $space_id));
			$result = $query->result_array();
			
			if(count($result) == 0)
			{
				return print($model_id);
			}
			else
			{
				return print("error");
			}
		}
		
		private function GetModelsForWorkspace($space_id)
		{
			$this->db->select("*");
			$this->db->from("hl_models as m");
			$this->db->join("hl_space_file_lines as fl", "m.model_id = fl.model_id", "left");
			$this->db->join("hl_pictures as p", "m.picture_id = p.picture_id", "left");
			$this->db->where("space_id", $space_id);
			
			$models = $this->db->get()->result_array();
			
			return $models;
		}
		
		private function GetWorkspacesForUser($email)
		{
			$user_id = $this->db->get_where("hl_users", array("email" => $email))->result_array()[0]["user_id"];
			
			$workspaces = $this->db->get_where("hl_spaces", array("user_id" => $user_id))->result_array();
			
			return $workspaces;
		}
	}