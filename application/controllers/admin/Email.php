<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Email extends CI_Controller
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
		$this->load->model('admin/Email_model', 'Email_model');



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
		$this->load->view('admin/email/v_email');
	}

	public function emailPersetujuan()
	{
		$data['email'] = $this->Email_model->getTemplatePersetujuan();
		$this->load->view('admin/email/v_email_persetujuan', $data);
	}

	public function emailPenolakan()
	{
		$data['email'] = $this->Email_model->getTemplatePenolakan();
		$this->load->view('admin/email/v_email_penolakan', $data);
	}

	public function editemailpersetujuan()
	{
		$data = array(
			'subject' => $this->input->post('subject_email'),
			'salam_pembuka' => $this->input->post('salam_pembuka_email'),
			'isi_email' => $this->input->post('isi_email'),
			'penutup' => $this->input->post('penutup_email')
		);
		$this->Email_model->updateTemplateEmail(1, $data);
		$this->session->set_flashdata('message', 'Berhasil memperbaharui data');
		redirect('admin/email/emailpersetujuan');
	}

	public function editemailpenolakan()
	{
		$data = array(
			'subject' => $this->input->post('subject_email'),
			'salam_pembuka' => $this->input->post('salam_pembuka_email'),
			'isi_email' => $this->input->post('isi_email'),
			'penutup' => $this->input->post('penutup_email'),
			'penutup2' => $this->input->post('penutup_email2'),
		);
		$this->Email_model->updateTemplateEmail(2, $data);
		$this->session->set_flashdata('message', 'Berhasil memperbaharui data');
		redirect('admin/email/emailpenolakan');
	}
}
