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
	 * @param $id
	 * @return void
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

}
