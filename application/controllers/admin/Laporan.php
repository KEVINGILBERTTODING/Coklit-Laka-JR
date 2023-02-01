<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
		$this->load->model('pic/proposal/Loket_model', 'Loket_model');
		$this->load->model('Detail_user_model', 'Detail_user_model');
		$this->load->model('pic/evaluasi/Evaluasi_model', 'Evaluasi_model');
		$this->load->model('pic/evaluasi/Perencanaan_strategis_model', 'Perencanaan_strategis_model');
		$this->load->model('pic/evaluasi/Keselarasan_model', 'Keselarasan_model');
		$this->load->model('pic/evaluasi/Keberlanjutan_model', 'Keberlanjutan_model');
		$this->load->model('pic/evaluasi/Keberlanjutan_model', 'Keberlanjutan_model');
		$this->load->model('pic/evaluasi/Sebaran_manfaat_model', 'Sebaran_manfaat_model');
		$this->load->model('pic/evaluasi/Jenis_manfaat_perusahaan_model', 'Jenis_manfaat_perusahaan_model');
		$this->load->model('pic/evaluasi/Jenis_manfaat_masyarakat_model', 'Jenis_manfaat_masyarakat_model');
		$this->load->model('pic/kajian_manfaat/Manfaat_masyarakat_model', 'Manfaat_masyarakat_model');
		$this->load->model('pic/evaluasi/Sebaran_manfaat_model', 'Sebaran_manfaat_model');
		$this->load->helper('download');
		$this->load->library('pagination');
		$this->load->model('admin/Realisasi_model', 'Realisasi_model');
		$this->load->model('admin/Lpj_model', 'Lpj_model');
		$this->load->model('admin/laporan/Laporan_model', 'Laporan_model');
	}

	public function index()
	{

		$data['klasifikasi_bantuan'] = $this->Pemohon_bantuan_model->getPemohonBantuan2();
		$data['nama_loket'] = $this->Loket_model->getAllLoket();
		$data['bulan'] = $this->input->get('bulan');

		if (!empty($this->input->get('bulan'))) {

			$filter_data = explode('/', $this->input->get('bulan'));
			$month = $filter_data[0];
			$year = $filter_data[1];
			$data['proposal'] = $this->Laporan_model->searchMonth($month, $year);
			$this->load->view('admin/laporan/v_laporan', $data);
		} else if (!empty($this->input->get('query_klasifikasi'))) {

			$data['proposal'] = $this->Laporan_model->searchKlasifikasi($this->input->get('query_klasifikasi'));
			$this->load->view('admin/laporan/v_laporan', $data);
		} else if (!empty($this->input->get('query_loket'))) {

			$data['proposal'] = $this->Laporan_model->searchLoket($this->input->get('query_loket'));
			$this->load->view('admin/laporan/v_laporan', $data);
		} else if (!empty($this->input->get('klasifikasi_program'))) {

			$data['proposal'] = $this->Laporan_model->searchKlasifikasiProgram();
			$this->load->view('admin/laporan/v_laporan', $data);
		} else {
			$data['proposal'] = '';
			$this->load->view('admin/laporan/v_laporan', $data);
		}
	}
}
