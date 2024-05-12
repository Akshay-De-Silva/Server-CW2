<?php

defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class GuideController extends CI_Controller
{
	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		// If the user is not logged in, redirect to the login page
		if(!get_cookie('authenticated')) {

			log_message('info', 'User tried to access guide page without logging in: ' . date('Y-m-d H:i:s') . ' - (custom)');
			$this->session->set_flashdata('error', 'Please login to view your profile.');
			$this->load->view('Auth/Account/login_index');

		} else {

			log_message('info', 'User accessed guide page: ' . date('Y-m-d H:i:s') . ' - (custom)');
			$this->load->view('Guide/guide_view');
		}
	}

	/**
	 * REST API FUNCTION
	 * Search for a guide. This is where the AJAX request is sent to.
	 */
	public function search()
	{
		$search_string = $this->input->post('search');
		$this->load->model('Guide', 'guide');
		$result = $this->guide->getGuide($search_string);

		if($result != false) {

			$data = array();
			foreach($result as $row) {
				$data[] = array(
					'entry_id' => $row->entry_id, // this is the same as 'id' in the 'guides' table
					'entry_name' => $row->entry_name,
					'entry_category' => $row->entry_category,
					'entry_description' => $row->entry_description,
					'entry_image_path' => $row->entry_image_path,
				);
			}

			log_message('info', 'User searched for a guide: ' . date('Y-m-d H:i:s') . ' - (custom)');
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($data));
		} else {

			log_message('info', 'No guides were found: ' . date('Y-m-d H:i:s') . ' - (custom)');
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(false));
		}
	}

}
