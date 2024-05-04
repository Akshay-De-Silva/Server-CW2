<?php

class Guide extends CI_Model
{
	public $entry_id;
	public $entry_category;
	public $entry_name;
	public $entry_description;
	public $entry_image_path;


	public function getGuide($search_string)
	{
		$this->db->select('*');
		$this->db->from('guides');
		$this->db->like('entry_name', $search_string); // using like to search for the title similar to the search string
		$this->db->or_like('entry_description', $search_string);
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
}
