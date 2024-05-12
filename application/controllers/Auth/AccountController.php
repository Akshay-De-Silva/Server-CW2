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
		if(get_cookie('authenticated')) {
			$this->homePage();
		} else {

			log_message('info', 'User accessed login page: ' . date('Y-m-d H:i:s') . ' - (custom)');
			$this->load->view('Auth/Account/login_index');
		}
	}

	/**
	 * 	This function will load the view for the register page
	 */
	public function registerIndex()
	{
		// If the user is already logged in, redirect to the home page
		if(get_cookie('authenticated')) {
			$this->homePage();
		} else {

			log_message('info', 'User accessed registration page: ' . date('Y-m-d H:i:s') . ' - (custom)');
			$this->load->view('Auth/Account/signup_index');
		}
	}

	/**
	 * 	This function will handle the logout process
	 */
	public function logout()
	{
		log_message('info', 'User logged out: ' . $this->session->userdata('auth_user')['nickname'] . ' - ' . date('Y-m-d H:i:s') . ' - (custom)');

		// removes the session key user_data
		$this->session->unset_userdata('auth_user');

		// remove authenticated cookie
		delete_cookie('authenticated');
		unset($_COOKIE['authenticated']); // removes the cookie from the global $_COOKIE array

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

			// sets the cookie for 1 hour
			set_cookie('authenticated', true, 3600);
			$_COOKIE['authenticated'] = true; // sets the cookie in the global $_COOKIE array

			$this->session->set_userdata('auth_user', $userDetails);
			$this->session->set_flashdata('success', 'User Account created.');

			log_message('info', 'User created: ' . $userDetails['nickname'] . ' - ' . date('Y-m-d H:i:s') . ' - (custom)');

			$this->homePage();

		} else {

			log_message('info', 'User creation failed: ' . $data['nickname'] . ' - ' . date('Y-m-d H:i:s') . ' - (custom)');
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

				// sets the cookie for 1 hour
				set_cookie('authenticated', true, 3600);
				$_COOKIE['authenticated'] = true; // sets the cookie in the global $_COOKIE array

				$this->session->set_userdata('auth_user', $userDetails);

				log_message('info', 'User logged in: ' . $userDetails['nickname'] . ' - ' . date('Y-m-d H:i:s') . ' - (custom)');

				$this->homePage();

			} else {

				log_message('info', 'User login failed: ' . $data['nickname'] . ' - ' . date('Y-m-d H:i:s') . ' - (custom)');
				$this->session->set_flashdata('error', 'Something went wrong. Please try again!');
				$this->loginIndex();
			}

		} else {

			log_message('info', 'User login failed: ' . $data['nickname'] . ' - ' . date('Y-m-d H:i:s') . ' - (custom)');
			$this->session->set_flashdata('error', 'Something went wrong. Please try again!');
			$this->loginIndex();
		}
	}

	public function homePage()
	{
		// If the user is logged in
		if(get_cookie('authenticated')) {

			log_message('info', 'User accessed home page: ' . $this->session->userdata('auth_user')['nickname'] . ' - ' . date('Y-m-d H:i:s') . ' - (custom)');

			$this->load->view('home');
		} else {

			log_message('info', 'Unauthorized access to home page: ' . date('Y-m-d H:i:s') . ' - (custom)');

			// If the user is NOT logged in
			$this->session->set_flashdata('error', 'You are not authorized to view this page!');
			$this->loginIndex();
		}
	}

}
