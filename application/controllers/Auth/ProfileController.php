<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class ProfileController extends CI_Controller
{
	/**
	 * 	This function will load the view for the profile page
	 */
	public function index()
	{
		// If the user is not logged in, redirect to the login page
		if(!$this->session->authenticated) {
			$this->session->set_flashdata('error', 'Please login to view your profile.');
			$this->load->view('login_index');
		}

		// boots the user model and gets the user details
		$this->load->model('Auth/Account/User', 'user');
		$userDetails = $this->user->getProfile($this->session->userdata('auth_user')['user_id']);

		// converts the user details into an array so it can be passed to the view and accessed there
		$userDetails = array('userDetails' => $userDetails);

		$this->load->view('Auth/Profile/profile_index', $userDetails);
	}
}
