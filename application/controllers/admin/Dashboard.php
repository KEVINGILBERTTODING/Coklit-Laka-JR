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
		} else if ($this->session->userdata('role') != 'admin') {
			$url = base_url('login');
			redirect($url);
		}

		$this->load->model('pic/proposal/Proposal_model', 'Proposal_model');
		$this->load->model('pts/hasil_survey/Hasil_survey_model', 'Hasil_survey_model');
		$this->load->model('pic/proposal/Proposal_model', 'Proposal_model');
		$this->load->model('Detail_user_model', 'Detail_user_model');
		$this->load->model('super_admin/User_model', 'User_model');
		$this->load->model('dcm/pendapat/Pendapat_model', 'Pendapat_model');
		$this->load->model('admin/Realisasi_model', 'Realisasi_model');
		$this->load->model('admin/Loket_model', 'Loket_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
	}
	public function index()
	{
		$data['proposal'] = $this->Proposal_model->countKajianManfaat();
		$data['survey'] = $this->Proposal_model->countProposalSurvey();
		$data['hs'] = $this->Pendapat_model->countTotalPendapat();
		$data['hk'] = $this->Realisasi_model->countTotalRealisasi();
		$data['user'] = $this->User_model->getUserById($this->session->userdata('id'));
		$data['loket'] = $this->Loket_model->countLoket();

		$data['nama_lengkap'] = $this->Detail_user_model->getNamaLengkap($this->session->userdata('id'));
		foreach ($data['nama_lengkap'] as $nama) {
			$data['nama_lengkap'] = $nama->nama_lengkap;
		}
		$data['detail_user'] = $this->Detail_user_model->getDetailUserById($this->session->userdata('id'));
		$this->session->set_userdata('nama_lengkap', $data['nama_lengkap']);
		$this->load->view('admin/v_dashboard', $data);
	}

	public function cekUser()
	{
		$data = $this->Detail_user_model->cekUserModel($this->session->userdata('id'));
		if ($data) {
			$response = array(
				'status' => 'success',
				'code' => 200,
				'message' => 'Data berhasil diambil',
				'data' => $data
			);

			echo json_encode($response);
		} else {
			$response = array(
				'status' => 'error',
				'code' => 404,
				'message' => 'Data tidak ditemukan',
				'data' => $data
			);
			echo json_encode($response);
		}
	}

	public function insert()
	{
		$user_id = $this->session->userdata('id');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$jabatan = $this->input->post('jabatan');
		$email = $this->input->post('email');

		$data = array(
			'user_id' => $user_id,
			'nama_lengkap' => $nama_lengkap,
			'jabatan' => $jabatan,
			'email' => $email
		);

		$this->Detail_user_model->insert($data);
		$this->session->set_flashdata('message', 'Berhasil menambahkan data');
		redirect('admin/dashboard');
	}
}
