<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UploadModel extends CI_Model{
	
	function insertFile($name, $description, $location,$size,$category_id){
		$data = array(
               'name' => $name,
               'description' => $description,
               'location' => $location,
               'size' => $size,
               'category_id' => $category_id
            );
		$q = $this->db->insert('hl_files', $data); 

	}
}
?>