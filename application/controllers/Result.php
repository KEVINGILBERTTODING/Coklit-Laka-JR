<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Result extends CI_Controller
{
	function __construct()
	{

		parent::__construct();

		$this->load->model('pic/proposal/Proposal_model', 'Proposal_model');
		$this->load->model('pts/hasil_survey/Hasil_survey_model', 'Hasil_survey_model');
		$this->load->model('dcm/pendapat/Pendapat_model', 'Pendapat_model');
		$this->load->model('Detail_user_model', 'Detail_user_model');
		// panggil library yang kita buat sebelumnya yang bernama pdfgenerator

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
		$this->load->model('admin/Loket_model', 'Loket_model');
		$this->load->helper('download');
		$this->load->library('pagination');
	}
	public function cetak_surat($p)
	{

		$proposal_id = base64_decode($p);
		// get data user
		$data['kasubag'] = $this->Detail_user_model->getDetailUserById(27);
		$data['kabag'] = $this->Detail_user_model->getDetailUserById(28);
		$data['kacab'] = $this->Detail_user_model->getDetailUserById(29);
		$data['proposal'] = $this->Proposal_model->getProposalById2($proposal_id);
		$data['survey'] = $this->Survey_model->getSurveyById($proposal_id);
		$data['pendapat'] = $this->Pendapat_model->getPendapatById2($proposal_id);
		$data['surat_penolakan'] = $this->Pendapat_model->getSuratPenolokan();
		$data['surat_persetujuan'] = $this->Pendapat_model->getSuratPersetujuan();
		$data['loket'] = $this->Loket_model->getLoketById($data['proposal']['kode_loket']);

		if ($data['proposal']['status'] == 'Ditolak') {
			$this->load->library('pdflib');
			$this->pdflib->setFileName('Surat_penolakan_' . $data['proposal']['no_proposal'] . '.pdf');
			$this->pdflib->setPaper('A4', 'potrait');
			$this->pdflib->loadView('surat/v_surat_penolakan', $data);
		} else if ($data['proposal']['status'] == 'Diterima') {
			$this->load->library('pdflib');
			$this->pdflib->setFileName('Surat_persetujuan_' . $data['proposal']['no_proposal'] . '.pdf');
			$this->pdflib->setPaper('A4', 'potrait');
			$this->pdflib->loadView('surat/v_surat_persetujuan', $data);
		}
	}
}
