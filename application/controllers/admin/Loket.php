<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Loket extends CI_Controller
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
		$this->load->model('dcm/pendapat/Pendapat_model', 'Pendapat_model');
		$this->load->model('Detail_user_model', 'Detail_user_model');
		$this->load->model('super_admin/User_model', 'User_model');
		$this->load->model('admin/Surat_model', 'Surat_model');



		// Load library form validation dan helper form
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('pic/kajian_manfaat/Kajian_manfaat_model', 'Kajian_manfaat_model');
		$this->load->model('pic/kajian_manfaat/Pemohon_bantuan_model', 'Pemohon_bantuan_model');
		$this->load->model('pts/survey/Survey_model', 'Survey_model');
		$this->load->model('pts/hasil_survey/Hasil_survey_model', 'Hasil_survey_model');
		$this->load->model('pic/kajian_manfaat/Bidang_manfaat_perusahaan_model', 'Bidang_manfaat_perusahaan_model');
		$this->load->model('pic/kajian_manfaat/Manfaat_masyarakat_model', 'Manfaat_masyarakat_model');
		$this->load->model('pic/proposal/Proposal_model', 'Proposal_model');
		$this->load->model('Detail_user_model', 'Detail_user_model');
		$this->load->helper('download');
		$this->load->library('pagination');
		$this->load->model('admin/Realisasi_model', 'Realisasi_model');
		$this->load->model('admin/Loket_model', 'Loket_model');
	}

	public function index()
	{
		$data['loket'] = $this->Loket_model->getLoket();
		$this->load->view('admin/loket/v_loket', $data);
	}

	public function updateLoket($id)
	{
		$data = array(
			'nama_loket' => $this->input->post('nama_loket'),
			'alamat_loket' => $this->input->post('alamat_loket'),
		);
		$this->Loket_model->updateLoket($id, $data);
		$this->session->set_flashdata('message', 'Data berhasil diubah');
		redirect('admin/loket');
	}
}
