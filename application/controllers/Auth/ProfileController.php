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
			$this->load->view('Auth/Account/login_index');

		} else {

			// boots the user model and gets the user details
			$this->load->model('Auth/Account/User', 'user');
			$userDetails = $this->user->getProfile($this->session->userdata('auth_user')['user_id']);

			// converts the user details into an array so it can be passed to the view and accessed there
			$userDetails = array('userDetails' => $userDetails);

			$this->load->view('Auth/Profile/profile_index', $userDetails);
		}
	}

	/**
	 * 	This function will load the view for the profile edit page
	 */
	public function edit() {
		// If the user is not logged in, redirect to the login page
		if(!$this->session->authenticated) {

			$this->session->set_flashdata('error', 'Please login to view your profile.');
			$this->load->view('Auth/Account/login_index');

		} else {

			// boots the user model and gets the user details
			$this->load->model('Auth/Account/User', 'user');
			$userDetails = $this->user->getProfile($this->session->userdata('auth_user')['user_id']);

			// converts the user details into an array so it can be passed to the view and accessed there
			$userDetails = array('userDetails' => $userDetails);

			$this->load->view('Auth/Profile/profile_edit', $userDetails);

		}
	}

	/**
	 * 	This function will handle the profile update process
	 */
	public function update() {

		// if a new password is entered, validate it as well. Otherwise, only validate the other fields
		$password = $this->input->post('password');
		if (!empty($password)) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirmPass', 'Confirm Password', 'trim|required|matches[password]');
		}

		$this->form_validation->set_rules('nickname', 'Nickname', 'trim|max_length[50]');
		$this->form_validation->set_rules('faction', 'Faction', 'trim|max_length[50]');
		$this->form_validation->set_rules('stalkers_killed', 'Stalkers Killed', 'trim|numeric|greater_than_equal_to[0]');
		$this->form_validation->set_rules('mutants_killed', 'Mutants Killed', 'trim|numeric|greater_than_equal_to[0]');
		$this->form_validation->set_rules('zones_visited', 'Zones Visited', 'trim|numeric|greater_than_equal_to[0]');

		if($this->form_validation->run()) {

			$data = array(
				'nickname' => $this->input->post('nickname'),
				'faction' => $this->input->post('faction'),
				'stalkers_killed' => $this->input->post('stalkers_killed'),
				'mutants_killed' => $this->input->post('mutants_killed'),
				'zones_visited' => $this->input->post('zones_visited')
			);

			// if a new password is entered, hash it and update the password field in the data array
			$password = $this->input->post('password');
			if (!empty($password)) {
				$data['password'] = password_hash($password, PASSWORD_DEFAULT);
			}

			$this->load->model('Auth/Account/User', 'user');
			$this->user->updateProfile($this->session->userdata('auth_user')['user_id'], $data);

			// updates the session data with the new nickname and faction
			$auth_user = $this->session->userdata('auth_user');
			$auth_user['nickname'] = $data['nickname'];
			$auth_user['faction'] = $data['faction'];
			$this->session->set_userdata('auth_user', $auth_user);

			$this->session->set_flashdata('success', 'Profile updated successfully.');
			$this->index();

		} else {
			$this->session->set_flashdata('error', 'Please fill in all the required fields.');
			$this->edit();
		}

	}
}
