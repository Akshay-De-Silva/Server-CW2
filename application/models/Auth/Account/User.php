<?php
class User extends CI_Model
{
	public $nickname;
	public $faction;

	public $password;
	public $mutants_killed;
	public $stalkers_killed;
	public $zones_visited;

	/**
	 * Saves the user data into the users table in the database
	 */
	public function createAccount($data)
	{
		return $this->db->insert('users', $data);
	}

	/**
	 * 	This function will handle the login process by verifying the login details
	 */
	public function login($data)
	{
		$this->db->select('*');

		$this->db->where('nickname', $data['nickname']);

		$this->db->from('users');
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() === 1) {
			$user = $query->row();

			// First argument is user input, 2nd is from the Database result
			if(password_verify($data['password'], $user->password)) {
				return $user;

			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	public function getProfile($user_id)
	{
		$this->db->select('nickname, faction, mutants_killed, stalkers_killed, zones_visited');
		$this->db->where('user_id', $user_id);
		$this->db->from('users');
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() === 1) {
			return $query->row();
		} else {
			return false;
		}
	}

}
