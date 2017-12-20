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
			
			$this->template->show('catalog', $this->TPL);
		}
	}
?>