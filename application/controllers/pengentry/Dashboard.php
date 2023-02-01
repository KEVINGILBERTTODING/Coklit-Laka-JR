<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('login');
			redirect($url);
		} else if ($this->session->userdata('role') != '2') {
			$url = base_url('login');
			redirect($url);
		}

		$this->load->model('user/User_model', 'User_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
	}
	public function index()
	{
		$data['detail_user'] = $this->User_model->get_user_detail_by_id($this->session->userdata('id'));
		$this->session->set_userdata('nama_lengkap', $data['detail_user']['nama_lengkap']);
		$this->load->view('pengentry/v_dashboard', $data);
	}

	// public function cekUser()
	// {
	// 	$data = $this->Detail_user_model->cekUserModel($this->session->userdata('id'));
	// 	if ($data) {
	// 		$response = array(
	// 			'status' => 'success',
	// 			'code' => 200,
	// 			'message' => 'Data berhasil diambil',
	// 			'data' => $data
	// 		);

	// 		echo json_encode($response);
	// 	} else {
	// 		$response = array(
	// 			'status' => 'error',
	// 			'code' => 404,
	// 			'message' => 'Data tidak ditemukan',
	// 			'data' => $data
	// 		);
	// 		echo json_encode($response);
	// 	}
	// }


}
