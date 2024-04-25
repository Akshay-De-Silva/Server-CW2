<?php
class User extends CI_Model
{
	public $nickname;
	public $faction;

	public $password;
	public $mutants_killed;
	public $stalkers_killed;
	public $zones_visited;

	public function insertUser($data)
	{
		return $this->db->insert('users', $data);
	}
}
