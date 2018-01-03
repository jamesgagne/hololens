<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UploadModel extends CI_Model{
	
	function insertModel($name, $description, $location, $category_id, $color_id){
		$data = array(
               'name' => $name,
               'description' => $description,
               'location' => $location,
               'color_id' => $color_id,
               'category_id' => $category_id
            );
		$q = $this->db->insert('hl_models', $data); 
		return $this->db->insert_id();

	}
	function getColors(){
		$q = $this->db->get('hl_colors');
		return $q->result_array();
	}
	function getCategories(){
		$q = $this->db->get('hl_categories');
		return $q->result_array();
	}
	function insertImage($description, $savePath){
		$data = array(
               'description' => $description,
               'link' => $savePath
           );
		$q = $this->db->insert('hl_pictures', $data); 
		return $this->db->insert_id();
	}
	function updateModelsPicture($model_id, $picture_id){
		  $data = array(
               'picture_id' => $picture_id
            );
    	$this->db->where("model_id", $model_id);
  		$this->db->update('hl_models', $data); 
  		$this->db->trans_complete();
  		if ($this->db->trans_status() === FALSE)
		{
			return "error";
		}
		else{
			return "sucess";
		}
	}
}
?>