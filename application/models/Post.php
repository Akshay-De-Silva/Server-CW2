
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
		// Selects the posts, along with the user's nickname and faction from the users table
		$this->db->select('posts.*, users.nickname, users.faction');
		$this->db->from('posts');
		$this->db->join('users', 'posts.user_id = users.user_id');

		// Orders the comments by the most recent first
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
		// Selects the posts, along with the user's nickname and faction from the users table
		$this->db->select('posts.*, users.nickname, users.faction');
		$this->db->from('posts');
		$this->db->join('users', 'posts.user_id = users.user_id');

		// gets the post that matches the passed in id
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
		// delete all the comments associated with the post
		$this->db->where('post_id', $id);
		$commentsDeleted = $this->db->delete('comments');

		// if the comments were not deleted, return false
		if(!$commentsDeleted) {
			return false;
		}

		// if the comments were deleted, delete the post
		$this->db->where('post_id', $id);
		$postsDeleted = $this->db->delete('posts');

		if($postsDeleted) {
			return true;
		} else {
			return false;
		}
	}

}
