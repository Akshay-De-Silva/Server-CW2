<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class AccountController extends CI_Controller
{
	/**
	 * 	This function will load the view for the login page
	 */
	public function loginIndex()
	{
		$this->load->view('Auth/Account/login_index');
	}

	/**
	 * 	This function will load the view for the register page
	 */
	public function registerIndex()
	{
		$this->load->view('Auth/Account/signup_index');
	}

	/**
	 * 	This function
	 */
	public function signup()
	{
		$this->form_validation->set_rules('nickname', 'Nickname', 'required|is_unique[users.nickname]');
		$this->form_validation->set_rules('faction', 'Faction', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmPass', 'Confirm Password', 'required|matches[password]'); //probably need something to check if same as password

		if ($this->form_validation->run()) {

			$data = array(
				'nickname' => $this->input->post('nickname'),
				'faction' => $this->input->post('faction'),
				'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
			);

			$this->load->model('Auth/Account/User', 'user');
			$this->user->insertUser($data);

			$this->session->set_userdata('authenticated', true);
			$this->session->set_flashdata('status', 'User Account created. Welcome STALKER.');

			// todo: add this to the logs file

			$this->loginIndex();

		} else {

			$this->session->set_flashdata('error', 'Something went wrong. Please try again!');
			$this->registerIndex();
		}
	}
}
