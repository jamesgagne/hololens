<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();

    $this->load->model('UploadModel');
    // Your own constructor code
    //$this->TPL["UserLoggedIn"] = $this->userauthor->IsUserLoggedIn();
  }
  public function index()
	{
				
				
        $this->TPL['uploadsuccess'] = false;
			$this->template->show('upload', $this->TPL);
	}

	public function newFile(){
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    
    


	/*$validation = array(
       
        array(
                'field' => 'fbx',
                'label' => 'fbx',
                'rules' => array(array('img', function($value){
                  $allowed =  array('fbx');
				  $filename = $_Files['fbx']['name'];
				  $ext = $this->extension($filename);
				  if(!in_array($ext,$allowed) ) {
    			   return false;
				  }
                })),
                'errors' => array(
                        'required' => 'You must provide a %s.',
                        'img'=>'File must be of type fbx'
    )
        )
        
);

    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

    $this->form_validation->set_rules($validation);
                if ($this->form_validation->run() == FALSE)
                { 

                       $this->template->show('upload', $this->TPL);
                }
                else
                {
               
                    
                  }*/

        $src = $_FILES['fbx']['tmp_name'];
        $destination  = hardImgUrl(). $_FILES['fbx']['name'];

        move_uploaded_file($src,$destination);
      $name = $_FILES['fbx']['name'];
      $description = "";
      $size = "";
      $category_id = 0;
        $this->UploadModel->insertFile($name, $description, $destination,$size,$category_id); 	
        $this->TPL['uploadsuccess'] = true;
        $this->template->show('upload', $this->TPL);			
  			}
    
  function extension($path) { 
  $qpos = strpos($path, "?"); 

  if ($qpos!==false) $path = substr($path, 0, $qpos); 
  
  $extension = pathinfo($path, PATHINFO_EXTENSION); 

  return $extension; 
} 
}