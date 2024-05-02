<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class AccountController extends CI_Controller
{
	/**
	 * 	This function will load the view for the login page
	 */
	public function loginIndex()
	{
		// If the user is already logged in, redirect to the home page
		if($this->session->authenticated) {
			$this->homePage();
		} else {
			$this->load->view('Auth/Account/login_index');
		}
	}

	/**
	 * 	This function will load the view for the register page
	 */
	public function registerIndex()
	{
		// If the user is already logged in, redirect to the home page
		if($this->session->authenticated) {
			$this->homePage();
		} else {
			$this->load->view('Auth/Account/signup_index');
		}
	}

	/**
	 * 	This function will handle the logout process
	 */
	public function logout()
	{
		// removes the session keys called authenticated and user_data
		$this->session->unset_userdata('authenticated');
		$this->session->unset_userdata('auth_user');

		$this->session->set_flashdata('success', 'Successfully logged out.');
		$this->loginIndex();
	}

	/**
	 * 	This function will handle the signup process
	 */
	public function signup()
	{
		$this->form_validation->set_rules('nickname', 'Nickname', 'required|is_unique[users.nickname]');
		$this->form_validation->set_rules('faction', 'Faction', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmPass', 'Confirm Password', 'required|matches[password]');

		if ($this->form_validation->run()) {

			$data = array(
				'nickname' => $this->input->post('nickname'),
				'faction' => $this->input->post('faction'),
				'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
			);

			$this->load->model('Auth/Account/User', 'user');
			$newUser = $this->user->createAccount($data);

			// gets the newly created user details from the model and stores it in the session
			$userDetails = array(
				'user_id' => $newUser->user_id,
				'nickname' => $newUser->nickname,
				'faction' => $newUser->faction,
			);

			$this->session->set_userdata('authenticated', true);
			$this->session->set_userdata('auth_user', $userDetails);
			$this->session->set_flashdata('success', 'User Account created.');

			// todo: add this to the logs file
			// todo: change to the landing page
			$this->homePage();

		} else {

			$this->session->set_flashdata('error', 'Something went wrong. Please try again!');
			$this->registerIndex();
		}
	}


	/**
	 * 	This function will handle the login process
	 */
	public function login()
	{
		$this->form_validation->set_rules('nickname', 'Nickname', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {

			$data = array(
				'nickname' => $this->input->post('nickname'),
				'password' => $this->input->post('password'),
			);

			$this->load->model('Auth/Account/User', 'user');
			$result = $this->user->login($data);

			if($result != false) {

				$userDetails = array(
					'user_id' => $result->user_id,
					'nickname' => $result->nickname,
					'faction' => $result->faction
				);

				$this->session->set_userdata('authenticated', true);
				$this->session->set_userdata('auth_user', $userDetails);

				// todo: add this to the logs file
				// todo: change to the landing page
				$this->homePage();

			} else {
				$this->session->set_flashdata('error', 'Something went wrong. Please try again!');
				$this->loginIndex();
			}

		} else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try again!');
			$this->loginIndex();
		}
	}

	public function homePage()
	{
		// If the user is logged in
		if($this->session->authenticated) {
			$this->load->view('home');

			// If the user is NOT logged in
		} else {
			$this->session->set_flashdata('error', 'You are not authorized to view this page!');
			$this->loginIndex();
		}
	}

}
