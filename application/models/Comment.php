<?php

class Comment extends CI_Model
{
	public $comment_id;
	public $user_id;
	public $post_id;
	public $comment_content;


	/**
	 * Get all comments for a post
	 */
	public function getComments($post_id)
	{
		// Selects the comments, along with the user's nickname and faction from the users table
		$this->db->select('comments.*, users.nickname, users.faction');
		$this->db->from('comments');

		// Gets comments that belong to the passed in post_id
		$this->db->where('post_id', $post_id);

		$this->db->join('users', 'users.user_id = comments.user_id');

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	/**
	 * Inserts a new comment into the database.
	 */
	public function createComment($data){

		// inserts the data into the database table comments
		$inserted = $this->db->insert('comments', $data);

		if($inserted) {

			// Selects the comments, along with the user's nickname and faction from the users table
			$this->db->select('comments.*, users.nickname, users.faction');
			$this->db->from('comments');

			// gets specifically the comment that was just inserted
			$this->db->where('comment_id', $this->db->insert_id());

			// gets the user's nickname and faction
			$this->db->join('users', 'users.user_id = comments.user_id');
			$query = $this->db->get();

			if($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}

		} else {
			return false;
		}
	}

	/**
	 * Deletes a comment from the database
	 */
	public function removeComment($comment_id)
	{
		$this->db->where('comment_id', $comment_id);

		// deletes the comment from the database
		$deleted = $this->db->delete('comments');

		if($deleted) {
			return true;
		} else {
			return false;
		}
	}

}
