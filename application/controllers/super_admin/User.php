<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('login');
			redirect($url);
		} else if ($this->session->userdata('role') != '3') {
			$url = base_url('login');
			redirect($url);
		}

		$this->load->model('user/User_model', 'User_model');


		// Load library form validation dan helper form
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->library('pagination');
	}

	public function index()
	{
		$data['user'] = $this->User_model->get_all_user();
		$this->load->view('super_admin/user/v_user', $data);
	}
	public function enableUser($id)
	{
		$data = array(
			'user_status' => 1
		);
		$this->User_model->update_profile($data, $id);
		$this->session->set_flashdata('message', 'User berhasil diaktifkan');
		redirect('super_admin/user');
	}

	public function disableUser($id)
	{
		$data = array(
			'user_status' => 0
		);
		$this->User_model->update_profile($data, $id);
		$this->session->set_flashdata('message', 'User berhasil dinonaktifkan');
		redirect('super_admin/user');
	}
}
