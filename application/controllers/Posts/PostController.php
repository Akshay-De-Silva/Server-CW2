<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class PostController extends CI_Controller
{
	public function index()
	{
		// If the user is not logged in, redirect to the login page
		if(!get_cookie('authenticated')) {
			$this->session->set_flashdata('error', 'Please login to view your profile.');
			$this->load->view('Auth/Account/login_index');

		} else {
			$this->load->view('Post/post_view');
		}
	}

}
