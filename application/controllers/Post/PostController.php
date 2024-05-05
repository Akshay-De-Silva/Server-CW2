<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class PostController extends CI_Controller
{
	/**
	 * Displays the index page of the Zone Updates
	 */
	public function index()
	{
		// If the user is not logged in, redirect to the login page
		if(!get_cookie('authenticated')) {
			$this->session->set_flashdata('error', 'Please login to view your profile.');
			$this->load->view('Auth/Account/login_index');

		} else {
			$this->load->view('Post/post_index');
		}
	}

	/**
	 * Displays the create post page
	 */
	public function createPost()
	{
		// If the user is not logged in, redirect to the login page
		if(!get_cookie('authenticated')) {
			$this->session->set_flashdata('error', 'Please login to view your profile.');
			$this->load->view('Auth/Account/login_index');

		} else {
			$this->load->view('Post/post_create');
		}
	}

	public function submitPost()
	{
		$this->form_validation->set_rules('title', 'Post Title', 'required');
		$this->form_validation->set_rules('content', 'Post Content', 'required');

		if($this->form_validation->run()) {

			$data = array(
				'user_id' => $this->session->userdata('auth_user')['user_id'],
				'post_title' => $this->input->post('title'),
				'post_content' => $this->input->post('content'),
				'votes' => 0,
			);

			$this->load->model('Post', 'post');
			$newPost = $this->post->createPost($data);

			if($newPost != false) {
				$this->session->set_flashdata('success', 'Post created successfully!');
				$this->index();
			} else {
				$this->session->set_flashdata('error', 'Something went wrong. Please try again!');
				$this->createPost();
			}

		} else {
			$this->session->set_flashdata('error', 'Please fill in all the fields.');
			$this->createPost();
		}
	}


	/**
	 * REST API FUNCTION
	 * This function will call all the posts available and return a JSON. To be used with AJAX
	 */
	public function getAllPosts()
	{
		$this->load->model('Post', 'post');
		$result = $this->post->getAllPosts();

		if($result != false) {

			$data = array();
			foreach($result as $row) {
				$data[] = array(
					'post_id' => $row->post_id, // this is the same as 'id' in the 'posts' table

					'user_id' => $row->user_id, // foreign key
					'user_nickname' => $row->nickname, // nickname from the users table
					'user_faction' => $row->faction, // faction from the users table

					'post_title' => $row->post_title,
					'post_content' => $row->post_content,
					'votes' => $row->votes,
				);
			}

			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
		} else {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(false));
		}

	}


	/**
	 * Displays the post that the user wants to view. With all the details.
	 */
	public function viewPost($id)
	{
		// If the user is not logged in, redirect to the login page
		if(!get_cookie('authenticated')) {
			$this->session->set_flashdata('error', 'Please login to view your profile.');
			$this->load->view('Auth/Account/login_index');

		} else {
			$this->load->model('Post', 'post');
			$result = $this->post->getPost($id);

			if($result != false) {

				$post = array(
					'post' => array(
						'post_id' => $result->post_id, // this is the same as 'id' in the 'posts' table

						'user_id' => $result->user_id, // foreign key
						'user_nickname' => $result->nickname, // nickname from the users table
						'user_faction' => $result->faction, // faction from the users table

						'post_title' => $result->post_title,
						'post_content' => $result->post_content,
						'votes' => $result->votes,
					)
				);

				$this->load->view('Post/post_show', $post);

			} else {
				$this->session->set_flashdata('error', 'Something went wrong. Please try again!');
				$this->index();
			}
		}
	}

	/**
	 * REST API FUNCTION
	 * This upvotes the post
	 */
	public function upvote()
	{
		$post_id = $this->input->post('post_id');
		$this->load->model('Post', 'post');

		// upvotes the post and update it in the posts table by 1
		$this->db->set('votes', 'votes+1', FALSE); // addition
		$this->db->where('post_id', $post_id);
		$this->db->update('posts');

		// gets the updated votes count
		$this->db->select('votes');
		$this->db->from('posts');
		$this->db->where('post_id', $post_id);
		$updatedVotes = $this->db->get()->row()->votes;

		// returns the response as a json, but specifically ONLY the new votes number
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('votes' => $updatedVotes)));

	}

	/**
	 * REST API FUNCTION
	 * This Downvotes a post
	 */
	public function downvote()
	{
		$post_id = $this->input->post('post_id');
		$this->load->model('Post', 'post');

		// downvotes the post and update it in the posts table by 1
		$this->db->set('votes', 'votes-1', FALSE); // subtract
		$this->db->where('post_id', $post_id);
		$this->db->update('posts');

		// gets the updated votes count
		$this->db->select('votes');
		$this->db->from('posts');
		$this->db->where('post_id', $post_id);
		$updatedVotes = $this->db->get()->row()->votes;

		// returns the response as a json, but specifically ONLY the new votes number
		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('votes' => $updatedVotes)));

	}

	/**
	 * Deletes a post
	 */
	public function deletePost($post_id)
	{
		$this->load->model('Post', 'post');
		$result = $this->post->removePost($post_id);

		if($result) {
			$this->session->set_flashdata('success', 'Post deleted successfully!');
			$this->index();
		} else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again!');
			$this->index();
		}
	}

}
