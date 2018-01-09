<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Help extends CI_Controller {

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
			$this->template->show("help", $this->TPL);
		}
	}