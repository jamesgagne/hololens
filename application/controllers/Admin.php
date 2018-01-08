<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin extends CI_Controller {

		private $TPL = [];

		public function __construct()
		{
			parent::__construct();
			
			$this->TPL["UserLoggedIn"] = $this->userauthor->IsUserLoggedIn();
			$query = $this->db->query("SELECT * FROM hl_users ORDER BY user_id ASC");
			$emailQuery = $this->db->query("SELECT email FROM hl_users");
			$this->TPL['emails'] = $emailQuery->result_array();
			$this->TPL['listing'] = $query->result_array();
			
		}
		
		public function index()
		{
			if($this->TPL["UserLoggedIn"])
			{
				$homepage = base_url();
				$this->userauthor->Redirect($homepage);
			}
			else
			{
				$this->template->show("admin", $this->TPL);
			}
		}
		
		public function add_user()
		{
			date_default_timezone_set('EST');
			
			$name = $this->input->post("nameModal");
			$email = $this->input->post("emailModal");
			$password = $this->input->post("passwordModal");
			$role = $this->input->post("roleModal");

			$verifyQuery = $this->db->query("SELECT * FROM hl_users WHERE email = '$email'");
			
			if ($verifyQuery->num_rows() >= 1)
			{
				$_SESSION['roomError'] = "This account already exists! Please try again.";
				redirect(base_url() . 'index.php/Admin');
			}
			else
			{
				$insertQuery = $this->db->query("INSERT INTO hl_users(name, email, enckey, access_level_id) VALUES ('$name', '$email', '$password', '$role')");
				redirect(base_url() . 'index.php/Admin');
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
			$name = $this->input->post("name");
			$email = $this->input->post("email");
			$role = $this->input->post("role");

			$query = $this->db->query("UPDATE hl_users SET name = '$name', email = '$email', access_level_id = '$role' WHERE user_id = '$id'");

			redirect(base_url() . 'index.php/Admin');
		}
	}
?>
