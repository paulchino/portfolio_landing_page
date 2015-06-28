<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//MODEL MODEL MODEL

class Note extends CI_Controller {

	public function show()
	{
		$query = "SELECT * FROM notes;";
		return $this->db->query($query)->result_array();
	}
	
	public function create($data) {
		$query = "INSERT INTO notes (title, description, created_at, updated_at)
				VALUE (?, ?, NOW(), NOW());";
		$values = array($data['title'], $data['description']);
		return $this->db->query($query, $values);	
	}

	public function delete($id)
	{
		$array = array('id' => $id);
		$query = "DELETE FROM notes WHERE id=?;";
		return $this->db->query($query, $array);
	}

	public function update($id, $description)
	{
		$array = array('description' => $description, 'id' => $id);
		$query = "UPDATE notes SET description=? WHERE id=?;";
		return $this->db->query($query, $array);
	}
}