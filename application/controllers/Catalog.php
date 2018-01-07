<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Catalog extends CI_Controller {

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
				$email = $this->userauthor->GetEmail();
				
				$this->TPL["Email"] = $email;
				$this->TPL["AccessLevel"] = $this->userauthor->GetAccessLevel($email);
				$this->TPL["ProfilePicture"] = $this->userauthor->GetProfilePicture($email);
				$this->TPL["Spaces"] = $this->GetWorkSpaces($email);
			}
			
			$this->TPL["Models"] = $this->GetModels();
			$this->TPL["Categories"] = $this->GetCategories();
			$this->TPL["Colors"] = $this->GetColors();
			
			$this->template->show('catalog', $this->TPL);
		}
		
		public function DeleteModel()
		{
			$model_id = $this->input->post("model_id");
			
			$this->db->delete("hl_models", array("model_id" => $model_id));
			
			$query = $this->db->get_where("hl_models", array("model_id" => $model_id));
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
		
		public function AddModelToWorkspace() 
		{
			$space_id = $this->input->post("space_id");
			$model_id = $this->input->post("model_id");
			
			$values = array(
				"space_id" => $space_id,
				"model_id" => $model_id
			);
	
			$this->db->insert("hl_space_file_lines", $values);
		}
		
		// get all categories in table
		private function GetCategories()
		{
			$query = $this->db->get("hl_categories");
			$result = $query->result_array();
			
			if(count(result) > 0) return $result;
			else return [];
		}
		
		// Gets models based off currently selected filters or if none simply gets all models
		private function GetModels()
		{ 
			$query = [];
			
			if(count($_GET) > 0) 
			{
				$color = "";
				$categories = [];
				$queryString = "";
				
				// get selected color
				if (isset($_GET["color"])) 
				{					
					$color = $_GET["color"];
					unset($_GET["color"]);
				}
				
				// get search string
				if(isset($_GET["query"]))
				{
					$queryString = $_GET["query"];
					unset($_GET["query"]);
				}
				
				// get all categories
				foreach($_GET as $key => $value)
				{	
					array_push($categories, $key);
				}

				// when both color and category(s) are selected
				if((!empty($color) AND $color != "All") AND (count($categories) > 0)) 
				{
					$this->db->select("m.model_id, m.name, m.location, p.link");
					$this->db->from("hl_models as m");
					$this->db->join("hl_pictures as p", "m.picture_id = p.picture_id", "left");
					$this->db->join("hl_colors as co", "m.color_id = co.color_id");
					$this->db->join("hl_categories as ca", "m.category_id = ca.category_id");			
					$this->db->where("co.name", $color);
					$this->db->where_in("ca.name", $categories);
				}
				// when only a color is selected
				else if(!empty($color) && $color != "All")
				{
					$this->db->select("m.model_id, m.name, m.location, p.link");
					$this->db->from("hl_models as m");
					$this->db->join("hl_pictures as p", "m.picture_id = p.picture_id", "left");
					$this->db->join("hl_colors as co", "m.color_id = co.color_id");		
					$this->db->where("co.name", $color);
				}
				// when only category(s) are selected
				else if(count($categories) > 0)
				{
					$this->db->select("m.model_id, m.name, m.location, p.link");
					$this->db->from("hl_models as m");
					$this->db->join("hl_pictures as p", "m.picture_id = p.picture_id", "left");
					$this->db->join("hl_categories as ca", "m.category_id = ca.category_id");			
					$this->db->where_in("ca.name", $categories);
				}
				// otherwise get everything
				else
				{
					$this->db->select("m.model_id, m.name, m.location, p.link");
					$this->db->from("hl_models as m");
					$this->db->join("hl_pictures as p", "m.picture_id = p.picture_id", "left");
				}
				
				// where search string
				if(!empty($queryString))
				{
					$this->db->like("m.name", $queryString);
				}
				
				$query = $this->db->get();
				
				// form memory
				$this->TPL["SelectedColor"] = $color;
				$this->TPL["SelectedCategories"] = $categories;
				$this->TPL["QueryString"] = $queryString;
			}
			else
			{
				$this->db->select("m.model_id, m.name, m.location, p.link");
				$this->db->from("hl_models as m");
				$this->db->join("hl_pictures as p", "m.picture_id = p.picture_id", "left");
				$query = $this->db->get();
			}

			return $query->result_array();
		}
		
		// get all colors in table
		private function GetColors()
		{
			$query = $this->db->get("hl_colors");
			$result = $query->result_array();
			
			if(count(result) > 0) return $result;
			else return [];
		}
		
		// Get all workspaces for this user if a user is logged in
		private function GetWorkSpaces($email) 
		{
			$user_id = $this->db->get_where("hl_users", array("email" => $email))->result_array()[0]["user_id"];
			
			$workspacesForUser = $this->db->get_where("hl_spaces", array("user_id" => $user_id))->result_array();
			
			return $workspacesForUser;
		}
	}
?>