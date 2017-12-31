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
				$username = $this->userauthor->GetUsername();
				
				$this->TPL["Username"] = $username;
				$this->TPL["PrivilegeLevel"] = $this->userauthor->GetPrivilegeLevel($username);
				$this->TPL["ProfilePicture"] = $this->userauthor->GetProfilePicture($username);
			}
			
			$this->TPL["Models"] = $this->GetModels();
			$this->TPL["Categories"] = $this->GetCategories();
			$this->TPL["Colors"] = $this->GetColors();
			
			$this->template->show('catalog', $this->TPL);
		}
		
		public function DeleteModel() {
			$filePath = $this->input->post("filePath");
			
			//return print($filePath); // return true if successful to update view
		}
		
		public function AddModelToList() {
			//$filePath = $this->input->post("filePath");
			//$listID = $this->input->post("listID");
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
					$this->db->select("f.file_id, f.name, f.description, f.location, co.name, ca.name");
					$this->db->from("hl_files as f");
					$this->db->join("hl_pictures as p");
					$this->db->join("hl_colors as co", "f.color_id = co.color_id");
					$this->db->join("hl_categories as ca", "f.category_id = ca.category_id");			
					$this->db->where("co.name", $color);
					$this->db->where_in("ca.name", $categories);
				}
				// when only a color is selected
				else if(!empty($color) && $color != "All")
				{
					$this->db->select("f.file_id, f.name, f.description, f.location, co.name");
					$this->db->from("hl_files as f");			
					$this->db->join("hl_colors as co", "f.color_id = co.color_id");		
					$this->db->where("co.name", $color);
				}
				// when only category(s) are selected
				else if(count($categories) > 0)
				{
					$this->db->select("f.file_id, f.name, f.description, f.location, ca.name");
					$this->db->from("hl_files as f");
					$this->db->join("hl_categories as ca", "f.category_id = ca.category_id");			
					$this->db->where_in("ca.name", $categories);
				}
				// otherwise get everything
				else
				{
					$this->db->select("f.file_id, f.name, f.description, f.location");
					$this->db->from("hl_files as f");
				}
				
				// where search string
				if(!empty($queryString))
				{
					$this->db->like("f.name", $queryString);
				}
				
				$query = $this->db->get();
				
				// form memory
				$this->TPL["SelectedColor"] = $color;
				$this->TPL["SelectedCategories"] = $categories;
				$this->TPL["QueryString"] = $queryString;
			}
			else
			{
				$query = $this->db->get("hl_files");
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
	}
?>