<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Realisasi extends CI_Controller
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
		$config['base_url'] = base_url('/admin/realisasi/index');
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->Realisasi_model->countTotalRealisasiBantuan();


		// Kondisi jika ada keyword pencarian maka hilangkan limit pagination
		if ($this->input->get('keyword')) {
			$this->db->like('no_proposal', $this->input->get('keyword'));
			$this->db->or_like('asal_proposal', $this->input->get('keyword'));
			$this->db->where('status', 'Diterima');
			$this->db->where('realisasi_bantuan', 1);
			$this->db->from('proposal');
			$config['total_rows'] = $this->db->count_all_results();
		} else {
			// Tampilkan limit pagination
			$config['total_rows'] = $this->Realisasi_model->countTotalRealisasiBantuan();
		}

		$config['per_page'] = 5; // Total data yang ditampilkan per halaman

		//config for untuk style pagination
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = ' <i class="fa fa-angle-right"></i> ';
		$config['prev_link']        = ' <i class="fa fa-angle-left"></i> ';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link text-white">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link text-white">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';



		$this->pagination->initialize($config);
		$limit = $config['per_page'];
		$offset = html_escape($this->input->get('per_page'));

		$data['proposal'] = $this->Realisasi_model->getProposalRealisasi($limit, $offset);
		$data['realisasi'] = $this->Realisasi_model->getRealisasiBantuan();
		$data['keyword'] = $this->input->get('keyword');
		$data['user'] = $this->User_model->getUserById($this->session->userdata('id'));


		if (!empty($this->input->get('keyword'))) {
			$data['proposal'] = $this->Realisasi_model->searchProposalRealisasiBantuan($data['keyword']);
			$data['realisasi'] = $this->Realisasi_model->getRealisasiBantuan();
			$data['user'] = $this->User_model->getUserById($this->session->userdata('id'));
		}

		if (count($data['proposal']) <= 0 && !$this->input->get('keyword')) {
			$this->load->view('admin/realisasi/v_realisasi', $data);
		} else {
			$this->load->view('admin/realisasi/v_realisasi', $data);
		}
	}



	public function getPendapat()
	{

		$config['base_url'] = base_url('/admin/realisasi/getPendapat');
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->Pendapat_model->countTotalHasilSurveyKacab3();


		// Kondisi jika ada keyword pencarian maka hilangkan limit pagination
		if ($this->input->get('keyword')) {
			$this->db->like('no_proposal', $this->input->get('keyword'));
			$this->db->or_like('asal_proposal', $this->input->get('keyword'));
			$this->db->where('kajian_manfaat', '1');
			$this->db->where('survey', '1');
			$this->db->where('pendapat_kabag', 1);
			$this->db->where('status', 'Diterima');

			$this->db->where('pendapat_kasubag', 1);
			$this->db->where('hasil_survey', 1);
			$this->db->where('pendapat_kacab', 1);
			$this->db->from('proposal');
			$config['total_rows'] = $this->db->count_all_results();
		} else {
			// Tampilkan limit pagination
			$config['total_rows'] = $this->Hasil_survey_model->countTotalHasilSurveyKacab3();
		}

		$config['per_page'] = 5; // Total data yang ditampilkan per halaman

		//config for untuk style pagination
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = ' <i class="fa fa-angle-right"></i> ';
		$config['prev_link']        = ' <i class="fa fa-angle-left"></i> ';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link text-white">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link text-white">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';



		$this->pagination->initialize($config);
		$limit = $config['per_page'];
		$offset = html_escape($this->input->get('per_page'));

		$data['proposal'] = $this->Pendapat_model->getProposalHasilSurveyKacab3($limit, $offset);
		$data['hasil_survey'] = $this->Pendapat_model->getHasilSurvey2();
		$data['pendapat'] = $this->Pendapat_model->getPendapatTanggapan();
		$data['detail_user'] = $this->Detail_user_model->getDetailUser();
		$data['kasubag'] = $this->Detail_user_model->getDetailUserById(27);
		$data['kabag'] = $this->Detail_user_model->getDetailUserById(28);
		$data['kacab'] = $this->Detail_user_model->getDetailUserById(29);
		$data['survey'] = $this->Survey_model->getSurvey();
		$data['keyword'] = $this->input->get('keyword');

		if (!empty($this->input->get('keyword'))) {
			$data['proposal'] = $this->Pendapat_model->searchProposalHasilSurveyKacab3($data['keyword']);
			$data['hasil_survey'] = $this->Pendapat_model->getHasilSurvey2();
			$data['pendapat'] = $this->Pendapat_model->getPendapatTanggapan();
			$data['survey'] = $this->Survey_model->getSurvey();
			$data['kasubag'] = $this->Detail_user_model->getDetailUserById(27);
			$data['kabag'] = $this->Detail_user_model->getDetailUserById(28);
			$data['kacab'] = $this->Detail_user_model->getDetailUserById(29);
			$data['detail_user'] = $this->Detail_user_model->getDetailUser();
		}

		if (count($data['proposal']) <= 0 && !$this->input->get('keyword')) {
			$this->load->view('admin/realisasi/v_pendapat', $data);
		} else {
			$this->load->view('admin/realisasi/v_pendapat', $data);
		}
	}


	public function insert()
	{
		$proposal_id = $this->input->post('proposal_id');
		$tanggal_kegiatan = $this->input->post('tgl_kegiatan');
		$tempat_kegiatan = $this->input->post('tempat_kegiatan');
		$nominal_bantuan  = str_replace('.', '', $this->input->post('nominal_bantuan'));
		$jenis_bantuan = $this->input->post('jenis_bantuan');
		$barang_berupa = $this->input->post('barang_berupa');
		$link_berita = $this->input->post('link_berita');


		$config['upload_path']          = './uploads/realisasi/';
		$config['allowed_types']        = 'jpg|png|jpeg|pdf';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('foto_kegiatan')) {
			$data = $this->upload->data();
			$foto_kegiatan = $data['file_name'];
			$format_foto_kegiatan = $data['file_type'];
		} else {
			$foto_kegiatan = '';
			$format_foto_kegiatan = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/realisasi/create/' . $proposal_id);
		}



		if ($this->upload->do_upload('kuitansi')) {
			$data = $this->upload->data();
			$kuitansi = $data['file_name'];
			$format_kuitansi = $data['file_type'];
		} else {
			$kuitansi = '';
			$format_kuitansi = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/realisasi/create/' . $proposal_id);
		}

		if ($this->upload->do_upload('bast')) {
			$data = $this->upload->data();
			$bast = $data['file_name'];
			$format_bast = $data['file_type'];
		} else {
			$bast = '';
			$format_bast = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/realisasi/create/' . $proposal_id);
		}

		if ($this->upload->do_upload('spt')) {
			$data = $this->upload->data();
			$spt = $data['file_name'];
			$format_spt = $data['file_type'];
		} else {
			$spt = '';
			$format_spt = '';

			$error = array('error' => $this->upload->display_errors());

			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/realisasi/create/' . $proposal_id);
		}

		if ($this->upload->do_upload('erp')) {
			$data = $this->upload->data();
			$erp = $data['file_name'];
			$format_erp = $data['file_type'];
		} else {
			$erp = '';
			$format_erp = '';
			$error = array('error' => $this->upload->display_errors());
			$data = $this->upload->data();
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			redirect('admin/realisasi/create/' . $proposal_id);
		}


		$data = array(
			'proposal_id' => $proposal_id,
			'tanggal_kegiatan' => $tanggal_kegiatan,
			'tempat_kegiatan' => $tempat_kegiatan,
			'nominal_bantuan' => $nominal_bantuan,
			'jenis_bantuan' => $jenis_bantuan,
			'barang_berupa' => $barang_berupa,
			'foto_kegiatan' => $foto_kegiatan,
			'link_berita' => $link_berita,
			'kuitansi' => $kuitansi,
			'bast' => $bast,
			'spt' => $spt,
			'erp' => $erp,
			'format_foto' => $format_foto_kegiatan,
			'format_kuitansi' => $format_kuitansi,
			'format_bast' => $format_bast,
			'format_spt' => $format_spt,
			'format_erp' => $format_erp,
			'date_created' => date('Y-m-d H:i:s')

		);

		$progress = array(
			'progress' => 80,
			'realisasi_bantuan' => 1
		);

		$this->Realisasi_model->insert($data);
		$this->Proposal_model->updateProposal($proposal_id, $progress);
		$this->session->set_flashdata('message', 'Realisasi Berhasil Ditambahkan');
		redirect('admin/realisasi/getpendapat');
	}

	public function create($id)
	{
		$data['proposal'] = $this->Proposal_model->getProposalById2($id);
		$this->load->view('admin/realisasi/v_add_realisasi', $data);
	}


	public function detail($id)
	{
		$data['realisasi'] = $this->Realisasi_model->getRealisasiById($id);
		$data['proposal'] = $this->Proposal_model->getProposalById2($id);
		$this->load->view('admin/realisasi/v_detail_realisasi', $data);
	}

	// Fungsi download file hasil survey
	function download($id, $file)
	{
		$data = $this->db->get_where('realisasi_bantuan', ['proposal_id' => $id])->row();
		force_download('uploads/realisasi/' . $data->$file, NULL);
	}

	public function update($id)
	{
		$data['realisasi'] = $this->Realisasi_model->getRealisasiById($id);
		$data['proposal'] = $this->Proposal_model->getProposalById2($id);
		$this->load->view('admin/realisasi/v_edit_realisasi', $data);
	}

	public function edit()
	{
		$proposal_id = $this->input->post('proposal_id');
		$tanggal_kegiatan = $this->input->post('tgl_kegiatan');
		$tempat_kegiatan = $this->input->post('tempat_kegiatan');
		$nominal_bantuan  = str_replace('.', '', $this->input->post('nominal_bantuan'));
		$jenis_bantuan = $this->input->post('jenis_bantuan');
		$barang_berupa = $this->input->post('barang_berupa');
		$link_berita  = $this->input->post('link_berita');

		if ($jenis_bantuan == "Uang Tunai") {
			$barang_berupa = "";
		}


		$data = array(
			'tanggal_kegiatan' => $tanggal_kegiatan,
			'tempat_kegiatan' => $tempat_kegiatan,
			'nominal_bantuan' => $nominal_bantuan,
			'jenis_bantuan' => $jenis_bantuan,
			'link_berita' => $link_berita,
			'barang_berupa' => $barang_berupa,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->Realisasi_model->editRealisasi($proposal_id, $data);
		$this->session->set_flashdata('message', 'Realisasi Berhasil Diperbaharui');
		redirect('admin/realisasi');
	}

	public function updateFotoKegiatan()
	{

		$proposal_id = $this->input->post('proposal_id');
		$config['upload_path']          = './uploads/realisasi/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('foto_kegiatan')) {
			$data = $this->upload->data();
			$foto_kegiatan = $data['file_name'];
			$format_foto_kegiatan = $data['file_type'];
			$this->session->set_flashdata('message', 'Realisasi Berhasil Diperbaharui');
		} else {
			$foto_kegiatan = '';
			$format_foto_kegiatan = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/realisasi/update/' . $proposal_id);
		}

		$data = array(
			'foto_kegiatan' => $foto_kegiatan,
			'format_foto' => $format_foto_kegiatan,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->Realisasi_model->editRealisasi($proposal_id, $data);
		redirect('admin/realisasi/update/' . $proposal_id);
	}

	public function updateKuitansi()
	{

		$proposal_id = $this->input->post('proposal_id');
		$config['upload_path']          = './uploads/realisasi/';
		$config['allowed_types']        = 'jpg|png|jpeg|pdf';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('kuitansi')) {
			$data = $this->upload->data();
			$kuitansi = $data['file_name'];
			$format_kuitansi = $data['file_type'];
			$this->session->set_flashdata('message', 'Realisasi Berhasil Diperbaharui');
		} else {
			$kuitansi = '';
			$format_kuitansi = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/realisasi/update/' . $proposal_id);
		}

		$data = array(
			'kuitansi' => $kuitansi,
			'format_kuitansi' => $format_kuitansi,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->Realisasi_model->editRealisasi($proposal_id, $data);
		redirect('admin/realisasi/update/' . $proposal_id);
	}

	public function updateBast()
	{

		$proposal_id = $this->input->post('proposal_id');
		$config['upload_path']          = './uploads/realisasi/';
		$config['allowed_types']        = 'jpg|png|jpeg|pdf';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('bast')) {
			$data = $this->upload->data();
			$bast = $data['file_name'];
			$format_bast = $data['file_type'];
			$this->session->set_flashdata('message', 'Realisasi Berhasil Diperbaharui');
		} else {
			$bast = '';
			$format_bast = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/realisasi/update/' . $proposal_id);
		}

		$data = array(
			'bast' => $bast,
			'format_bast' => $format_bast,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->Realisasi_model->editRealisasi($proposal_id, $data);
		redirect('admin/realisasi/update/' . $proposal_id);
	}


	public function updateSpt()
	{

		$proposal_id = $this->input->post('proposal_id');
		$config['upload_path']          = './uploads/realisasi/';
		$config['allowed_types']        = 'jpg|png|jpeg|pdf';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('spt')) {
			$data = $this->upload->data();
			$spt = $data['file_name'];
			$format_spt = $data['file_type'];
			$this->session->set_flashdata('message', 'Realisasi Berhasil Diperbaharui');
		} else {
			$spt = '';
			$format_spt = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/realisasi/update/' . $proposal_id);
		}

		$data = array(
			'spt' => $spt,
			'format_spt' => $format_spt,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->Realisasi_model->editRealisasi($proposal_id, $data);
		redirect('admin/realisasi/update/' . $proposal_id);
	}


	public function updateErp()
	{

		$proposal_id = $this->input->post('proposal_id');
		$config['upload_path']          = './uploads/realisasi/';
		$config['allowed_types']        = 'jpg|png|jpeg|pdf';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('erp')) {
			$data = $this->upload->data();
			$erp = $data['file_name'];
			$format_erp = $data['file_type'];
			$this->session->set_flashdata('message', 'Realisasi Berhasil Diperbaharui');
		} else {
			$erp = '';
			$format_erp = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/realisasi/update/' . $proposal_id);
		}

		$data = array(
			'erp' => $erp,
			'format_erp' => $format_erp,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->Realisasi_model->editRealisasi($proposal_id, $data);
		redirect('admin/realisasi/update/' . $proposal_id);
	}

	public function countTotalHasilSurveyKasubag3()
	{
		$this->db->select('*');
		$this->db->from('proposal');
		$this->db->where('kajian_manfaat', 1);
		$this->db->where('survey', 1);
		$this->db->where('pendapat_kasubag', 1);
		$this->db->where('hasil_survey', 1);
		$query = $this->db->get();
		return $query->num_rows();
	}
}
