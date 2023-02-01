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
		} else if ($this->session->userdata('role') != '3') {
			$url = base_url('login');
			redirect($url);
		}

		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('user/User_model', 'User_model');
	}
	public function index()
	{

		$data['total_user'] = $this->User_model->count_total_user();
		$data['detail_user'] = $this->User_model->get_user_detail_by_id($this->session->userdata('id'));
		$this->session->set_userdata('nama_lengkap', $data['detail_user']['nama_lengkap']);
		$this->load->view('super_admin/v_dashboard', $data);
	}


	// public function insert()
	// {
	// 	$user_id = $this->session->userdata('id');
	// 	$nama_lengkap = $this->input->post('nama_lengkap');
	// 	$jabatan = $this->input->post('jabatan');
	// 	$email = $this->input->post('email');

	// 	$data = array(
	// 		'user_id' => $user_id,
	// 		'nama_lengkap' => $nama_lengkap,
	// 		'jabatan' => $jabatan,
	// 		'email' => $email
	// 	);

	// 	$this->Detail_user_model->insert($data);
	// 	$this->session->set_flashdata('message', 'Berhasil menambahkan data');
	// 	redirect('super_admin/dashboard');
	// }
}
