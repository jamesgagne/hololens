<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();

    $this->load->model('UploadModel');
    
	$this->TPL["UserLoggedIn"] = $this->userauthor->IsUserLoggedIn();
  }
  public function index()
	{
		if(!$this->TPL["UserLoggedIn"])
		{
			$homepage = base_url();
			$this->userauthor->Redirect($homepage);
		}
		else
		{
			$this->TPL['uploadsuccess'] = false;
			$this->template->show('upload', $this->TPL);
		}	
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
		  $savePath = assetUrl() . "models/".$_FILES['fbx']['name'];
      $name = $_FILES['fbx']['name'];
      $description = "";
      $size = "";
      $category_id = 1;
      $color_id = 1;
      $this->UploadModel->insertFile($name, $description, $savePath,$size,$category_id, $color_id); 	
      $this->TPL['uploadsuccess'] = true;
      $this->template->show('upload', $this->TPL);		
  }
    
  function extension($path) { 
  $qpos = strpos($path, "?"); 

  if ($qpos!==false) $path = substr($path, 0, $qpos); 
  
  $extension = pathinfo($path, PATHINFO_EXTENSION); 

  return $extension; 
  } 
  public function addnew(){
      $src = $_FILES['model']['tmp_name'];
      $destination  = hardImgUrl(). $_FILES['model']['name'];

      move_uploaded_file($src,$destination);
      $savePath = assetUrl() . "models/".$_FILES['model']['name'];
      $name = $_FILES['model']['name'];
      $description = $_POST['description'];
      $size = "";
      $category_id = 1;
      $color_id = 1;
      $thisID = $this->UploadModel->insertModel($name, $description, $savePath);   
      $this->TPL['uploadsuccess'] = true;
      $this->TPL['newModelID'] = $thisID;
      //$this->template->show('upload', $this->TPL);    
  

    /*$org = $this->getOrganization();
    $_POST['validated'] = $this->validatePost();  
                  
    if($_POST['validated']){

        $resp = $this->addToDB();
        if ($resp['sucess']){
          $src = $_FILES['file']['tmp_name'];
          $destination  ="/home/student/000328298/public_html/private/CloudPOS/application/assets/img/" . $org['name'] ."/". $_FILES['file']['name'];
          copy($src, $destination);
        }
        $resp['validated'] = true;
        echo json_encode($resp);    
     }
    else{
      $resp = array();
        $resp['validated'] = false;
        $resp['sucess'] = false;
        $resp['errors'] = $this->postErrors;
        echo json_encode($resp);
      }       */
      echo json_encode($this->TPL);       
    
  }
}

