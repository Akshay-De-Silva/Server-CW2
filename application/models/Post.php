
<?php

class Post extends CI_Model
{
	public $post_id;
	public $user_id;
	public $post_title;
	public $post_content;
	public $votes;

	/**
	 * Gets all posts. Along with the associated User's name and faction.
	 */
	public function getAllPosts()
	{
		$this->db->select('posts.*, users.nickname, users.faction');
		$this->db->from('posts');
		$this->db->join('users', 'posts.user_id = users.user_id');
		$this->db->order_by('posts.post_id', 'DESC');

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	/**
	 * Gets a single post by its ID. Along with the associated User's name and faction.
	 */
	public function getPost($id)
	{
		$this->db->select('posts.*, users.nickname, users.faction');
		$this->db->from('posts');
		$this->db->join('users', 'posts.user_id = users.user_id');
		$this->db->where('post_id', $id);

		$query = $this->db->get();

		if($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	/**
	 * Inserts a new post into the database.
	 */
	public function createPost($data){
		$inserted = $this->db->insert('posts', $data);

		// This is so that I can get the post details after the insert and change the details in the controller
		if($inserted){
			$id = $this->db->insert_id();
			$query = $this->db->get_where('posts', array('post_id' => $id));

			return $query->row();
		} else {
			return false;
		}
	}

	/**
	 * Deletes a post from the database.
	 */
	public function removePost($id)
	{
		$this->db->where('post_id', $id);
		$deleted = $this->db->delete('posts');

		if($deleted) {
			return true;
		} else {
			return false;
		}
	}

}
