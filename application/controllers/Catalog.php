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
		
		// get all categories in table
		private function GetCategories()
		{
			$stmt = "SELECT * FROM hl_categories;";
			
			$query = $this->db->query($stmt);
			
			return $query->result_array();
		}
		
		// Gets models based off currently selected filters or if none simply gets all models
		private function GetModels()
		{
			$stmt = "SELECT f.file_id, f.name FROM hl_files as f " .
						 "JOIN hl_categories as c ON f.category_id = c.category_id " .
						 "JOIN hl_colors as co ON f.color_id = co.color_id ";
						 
			$query;
			
			if(count($_GET) > 0) 
			{
				$color = "";
				$categories = [];
				
				if (isset($_GET["color"])) 
				{					
					$color = $_GET["color"];
					unset($_GET["color"]);
				} 
				
				foreach($_GET as $key => $value)
				{	
					array_push($categories, $key);
				}
				
				// filter by color if set to anything other than all
				if(!empty($color) && $color != "All") 
				{	
					$stmt .= "WHERE co.name = ? ";
			
					// if categories is also set
					if(count($categories) > 0) 
					{
						$stmt .= "AND c.name IN (?);";
												
						$query = $this->db->query($stmt, array($color, implode(", ", $categories)));
					}
					// if not then just query db
					else 
					{
						$query = $this->db->query($stmt, array($color));
					}
				}
				// if any categories are checked
				else if(count($categories) > 0) 
				{
					$stmt .= "WHERE c.name IN (?);";	
					
					$query = $this->db->query($stmt, array(implode(", ", $categories)));
				}
				// just find all otherwise
				else
				{
					$query = $this->db->query($stmt);
				}
				
				$this->TPL["SelectedColor"] = $color;
				$this->TPL["SelectedCategories"] = $categories;
			}
			else 
			{				
				$query = $this->db->query($stmt);
			}
			
			return $query->result_array();
		}
		
		// get all colors in table
		private function GetColors()
		{
			$stmt = "SELECT * FROM hl_colors;";
			
			$query = $this->db->query($stmt);
			
			return $query->result_array();
		}
	}
?>