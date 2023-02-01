<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
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
	}

	public function index()
	{
		$this->load->view('admin/surat/v_surat');
	}

	public function suratPenolakan()
	{
		$data['surat'] = $this->Surat_model->getSuratPenolakan();
		$this->load->view('admin/surat/v_surat_penolakan', $data);
	}

	public function suratpersetujuan()
	{
		$data['surat'] = $this->Surat_model->getSuratPersetujuan();
		$this->load->view('admin/surat/v_surat_persetujuan', $data);
	}
	public function updateLogoKopSurat()
	{
		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('logo_kop_surat')) {
			$data = $this->upload->data();
			$logo_kop_surat = $data['file_name'];

			$data = array(
				'logo_kop_surat' => $logo_kop_surat
			);

			$this->Surat_model->updateSuratPenolakan($data);
			$this->Surat_model->updateSuratPersetujuan($data);
			$this->session->set_flashdata('message', 'Berhasil memperbaharui data');
			redirect('admin/surat/suratpenolakan');
		} else {
			$logo_kop_surat = '';
			$error = array('error' => $this->upload->display_errors());
			$data = $this->upload->data();
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			redirect('admin/surat/suratpenolakan');
		}
	}

	public function editSuratPenolakan()
	{
		$data = array(
			'no_surat' => $this->input->post('no_surat'),
			'sifat' => $this->input->post('sifat'),
			'hal' => $this->input->post('hal'),
			'salam_pembuka' => $this->input->post('salam_pembuka'),
			'penutup1' => $this->input->post('penutup1'),
			'penutup2' => $this->input->post('penutup2'),
			'catatan_kaki' => $this->input->post('catatan_kaki')
		);
		$this->Surat_model->updateSuratPenolakan($data);
		$this->session->set_flashdata('message', 'Berhasil memperbaharui data');
		redirect('admin/surat/suratpenolakan');
	}

	public function editSuratPersetujuan()
	{
		$data = array(
			'no_surat' => $this->input->post('no_surat'),
			'sifat' => $this->input->post('sifat'),
			'hal' => $this->input->post('hal'),
			'salam_pembuka' => $this->input->post('salam_pembuka'),
			'isi' => $this->input->post('isi'),
			'persyaratan' => $this->input->post('persyaratan'),
			'penutup' => $this->input->post('penutup'),
			'catatan_kaki' => $this->input->post('catatan_kaki')
		);
		$this->Surat_model->updateSuratPersetujuan($data);
		$this->session->set_flashdata('message', 'Berhasil memperbaharui data');
		redirect('admin/surat/suratpersetujuan');
	}
}
