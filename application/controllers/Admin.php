<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends CI_Controller {

		private $TPL = [];

		public function __construct()
		{
			parent::__construct();
			
			$this->TPL["UserLoggedIn"] = $this->userauthor->IsUserLoggedIn();
			
			$this->db->select("*");
			$this->db->from("hl_users as u");
			$this->db->join("hl_access_levels as al", "u.access_level_id = al.access_level_id");
			$query = $this->db->get();
			
			$emailQuery = $this->db->query("SELECT email FROM hl_users");
			$this->TPL['emails'] = $emailQuery->result_array();
			$this->TPL['listing'] = $query->result_array();
			
			$email = $this->userauthor->GetEmail();
				
			$this->TPL["Email"] = $email;
			$this->TPL["AccessLevel"] = $this->userauthor->GetAccessLevel($email);
			$this->TPL["ProfilePicture"] = $this->userauthor->GetProfilePicture($email);
			
			if($this->TPL["UserLoggedIn"] && !($this->TPL["AccessLevel"] == "Admin"))
			{
				$homepage = base_url();
				$this->userauthor->Redirect($homepage);
			}
			
			$this->TPL["AccessLevels"] = $this->get_access_levels();
		}
		
		public function index()
		{
			$this->template->show("admin", $this->TPL);
		}
		
		private function get_access_levels()
		{
			$accessLevels = $this->db->get("hl_access_levels")->result_array();
			
			return $accessLevels;
		}
		
		public function add_user()
		{
			date_default_timezone_set('EST');
			
			$first = $this->input->post("firstName");
			$last = $this->input->post("lastName");
			
			$email = $this->input->post("emailModal");
			$password = $this->input->post("passwordModal");
			$accessLevel = $this->input->post("accessLevel");

			if(!$this->userauthor->IsUserInDatabase($email))
			{
				$this->db->insert("hl_users", array("email" => $email, "first_name" => $first, "last_name" => $last, "enckey" => password_hash($password, PASSWORD_BCRYPT), "access_level_id" => $accessLevel));
				
				$adminPage = base_url() . "index.php/Admin";	
				$this->userauthor->Redirect($adminPage);
			}
			else 
			{
				$this->TPL["Error"] = "Email already in use!";
				
				$this->template->show("admin", $this->TPL);
			}
		}
		
		public function add_color() 
		{
			$color = $this->input->post("colorModal");
			
			$colorQuery = $this->db->query("INSERT INTO hl_colors(name) VALUES('$color')");
			redirect(base_url() . 'index.php/Admin');
		}
		
		public function add_category() 
		{
			$category = $this->input->post("categoryModal");
			
			$colorQuery = $this->db->query("INSERT INTO hl_categories(name) VALUES('$category')");
			redirect(base_url() . 'index.php/Admin');
		}
		
		public function add_space()
		{
			date_default_timezone_set('EST');
			
			$name = $this->input->post("nameSpace");
			$email = $this->input->post("emailList");
			$description = $this->input->post("descriptionSpace");
			$created = date("Y-m-d");
			
			$idQuery = $this->db->query("SELECT user_id FROM hl_users WHERE email = '$email'");
			$data['result'] = $idQuery->result_array();
			$user_id = $data['result'][0]['user_id'];
			
			$insertQuery = $this->db->query("INSERT INTO hl_spaces(name, description, user_id, created_date) VALUES ('$name', '$description', '$user_id', '$created')");
			redirect(base_url() . 'index.php/Admin');	
		}

		public function delete($id)
		{
			$query = $this->db->query("DELETE FROM hl_users where user_id = '$id';");
			redirect(base_url() . 'index.php/Admin');
		}
		
		public function update($id)
		{
			$query = $this->db->query("SELECT * FROM hl_users where user_id = '$id';");
			$this->TPL['entry'] = $query->result_array()[0];
			$this->TPL['update'] = true;

			$this->template->show('admin', $this->TPL);
		}

		public function updateentry($id)
		{  		
			$first = $this->input->post("firstName");
			$last = $this->input->post("lastName");
			$email = $this->input->post("email");
			$level = $this->input->post("accessLevel");
			
			$this->db->update("hl_users", array("first_name" => $first, "last_name" => $last, "email" => $email, "access_level_id" => $accessLevel));

			$adminPage = base_url() . "index.php/Admin";	
			$this->userauthor->Redirect($adminPage);
		}
	}
?>
