<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Logout extends CI_Controller 
	{
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
				$this->userauthor->Logout();
			}
			
			$homepage = base_url();
			$this->userauthor->Redirect($homepage);
		}
	}
?>