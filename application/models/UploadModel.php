<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UploadModel extends CI_Model{
	
	function insertModel($name, $description, $location){
		$data = array(
               'name' => $name,
               'description' => $description,
               'location' => $location
            );
		$q = $this->db->insert('hl_models', $data); 
		return $this->db->insert_id();

	}
}
?>