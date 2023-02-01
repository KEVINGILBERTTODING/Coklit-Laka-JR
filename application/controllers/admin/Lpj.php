<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lpj extends CI_Controller
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
		$this->load->model('Detail_user_model', 'Detail_user_model');
		$this->load->helper('download');
		$this->load->library('pagination');
		$this->load->model('admin/Realisasi_model', 'Realisasi_model');
		$this->load->model('admin/Lpj_model', 'Lpj_model');
	}

	public function index()
	{
		$config['base_url'] = base_url('/admin/lpj/index');
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->Lpj_model->countTotalLpj();


		// Kondisi jika ada keyword pencarian maka hilangkan limit pagination
		if ($this->input->get('keyword')) {
			$this->db->like('no_proposal', $this->input->get('keyword'));
			$this->db->or_like('asal_proposal', $this->input->get('keyword'));
			$this->db->where('status', 'Diterima');
			$this->db->where('realisasi_bantuan', 1);
			$this->db->where('lpj', 1);
			$this->db->from('proposal');
			$config['total_rows'] = $this->db->count_all_results();
		} else {
			// Tampilkan limit pagination
			$config['total_rows'] = $this->Lpj_model->countTotalLpj();
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

		$data['proposal'] = $this->Lpj_model->getProposalLpj($limit, $offset);
		$data['lpj'] = $this->Lpj_model->getLpjKegiatan();
		$data['keyword'] = $this->input->get('keyword');

		if (!empty($this->input->get('keyword'))) {
			$data['proposal'] = $this->Lpj_model->searchLpj($data['keyword']);
			$data['lpj'] = $this->Lpj_model->getLpjKegiatan();
		}

		if (count($data['proposal']) <= 0 && !$this->input->get('keyword')) {
			$this->load->view('admin/lpj/v_lpj', $data);
		} else {
			$this->load->view('admin/lpj/v_lpj', $data);
		}
	}

	public function realisasi()
	{
		$config['base_url'] = base_url('/admin/lpj/realisasi');
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->Lpj_model->countTotalRealisasiBantuan();


		// Kondisi jika ada keyword pencarian maka hilangkan limit pagination
		if ($this->input->get('keyword')) {
			$this->db->like('no_proposal', $this->input->get('keyword'));
			$this->db->or_like('asal_proposal', $this->input->get('keyword'));
			$this->db->where('status', 'Diterima');
			$this->db->where('realisasi_bantuan', 1);
			$this->db->where('progress', 80);
			$this->db->from('proposal');
			$config['total_rows'] = $this->db->count_all_results();
		} else {
			// Tampilkan limit pagination
			$config['total_rows'] = $this->Lpj_model->countTotalRealisasiBantuan();
		}

		$config['per_page'] = 5; // Total data yang ditampilkan per halaman

		//config for untuk style pagination
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

		$data['proposal'] = $this->Lpj_model->getProposalRealisasi($limit, $offset);
		$data['realisasi'] = $this->Lpj_model->getRealisasiBantuan();
		$data['keyword'] = $this->input->get('keyword');

		if (!empty($this->input->get('keyword'))) {
			$data['proposal'] = $this->Lpj_model->searchProposalRealisasiBantuan($data['keyword']);
			$data['realisasi'] = $this->Lpj_model->getRealisasiBantuan();
		}

		if (count($data['proposal']) <= 0 && !$this->input->get('keyword')) {
			$this->load->view('admin/lpj/v_realisasi', $data);
		} else {
			$this->load->view('admin/lpj/v_realisasi', $data);
		}
	}

	public function detailRealisasi($id)
	{
		$data['realisasi'] = $this->Realisasi_model->getRealisasiById($id);
		$data['proposal'] = $this->Proposal_model->getProposalById2($id);
		$this->load->view('admin/lpj/v_detail_realisasi', $data);
	}

	public function insert()
	{


		$config['upload_path']          = './uploads/lpj_kegiatan/';
		$config['allowed_types']        = 'jpg|png|jpeg|pdf';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$proposal_id = $this->input->post('proposal_id');


		if ($this->upload->do_upload('foto_kegiatan')) {
			$data = $this->upload->data();
			$foto_kegiatan = $data['file_name'];
			$format_foto_kegiatan = $data['file_type'];
		} else {
			$foto_kegiatan = '';
			$format_foto_kegiatan = '';
			$error = array('error' => $this->upload->display_errors());
			$data = $this->upload->data();
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			redirect('admin/lpj/realisasi');
		}


		if ($this->upload->do_upload('lpj')) {
			$data = $this->upload->data();
			$foto_lpj = $data['file_name'];
			$format_lpj = $data['file_type'];
		} else {
			$foto_lpj = '';
			$format_lpj = '';
			$error = array('error' => $this->upload->display_errors());
			$data = $this->upload->data();
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			redirect('admin/lpj/realisasi');
		}



		$data = array(
			'proposal_id' => $proposal_id,
			'foto_kegiatan' => $foto_kegiatan,
			'format_foto_kegiatan' => $format_foto_kegiatan,
			'lpj' => $foto_lpj,
			'format_lpj' => $format_lpj,
			'date_created' => date('Y-m-d H:i:s')

		);

		$progress = array(
			'progress' => 90,
			'lpj' => 1
		);

		$this->Lpj_model->insert($data);
		$this->Proposal_model->updateProposal($proposal_id, $progress);
		$this->session->set_flashdata('message', 'Lpj Kegiatan Berhasil Ditambahkan');
		redirect('admin/lpj/realisasi');
	}

	public function detail($id)
	{
		$data['lpj'] = $this->Lpj_model->getLpjById($id);
		$data['proposal'] = $this->Proposal_model->getProposalById2($id);
		$this->load->view('admin/lpj/v_detail_lpj', $data);
	}

	function download($id, $file)
	{
		$data = $this->db->get_where('lpj_kegiatan', ['proposal_id' => $id])->row();
		force_download('uploads/lpj_kegiatan/' . $data->$file, NULL);
	}

	public function update($id)
	{
		$data['lpj'] = $this->Lpj_model->getLpjById($id);
		$data['proposal'] = $this->Proposal_model->getProposalById2($id);
		$this->load->view('admin/lpj/v_edit_lpj', $data);
	}

	public function updateFotoKegiatan()
	{

		$proposal_id = $this->input->post('proposal_id');
		$config['upload_path']          = './uploads/lpj_kegiatan/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('foto_kegiatan')) {
			$data = $this->upload->data();
			$foto_kegiatan = $data['file_name'];
			$format_foto_kegiatan = $data['file_type'];
			$this->session->set_flashdata('message', 'Lpj Kegiatan Berhasil Diperbaharui');
		} else {
			$foto_kegiatan = '';
			$format_foto_kegiatan = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/lpj/update/' . $proposal_id);
		}

		$data = array(
			'foto_kegiatan' => $foto_kegiatan,
			'format_foto_kegiatan' => $format_foto_kegiatan,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->Lpj_model->editLpj($proposal_id, $data);
		redirect('admin/lpj/update/' . $proposal_id);
	}

	public function updateLpj()
	{

		$proposal_id = $this->input->post('proposal_id');
		$config['upload_path']          = './uploads/lpj_kegiatan/';
		$config['allowed_types']        = 'jpg|png|jpeg|pdf';
		$config['max_size']             = 5000;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('lpj')) {
			$data = $this->upload->data();
			$lpj = $data['file_name'];
			$format_lpj = $data['file_type'];
			$this->session->set_flashdata('message', 'Lpj Kegiatan Berhasil Diperbaharui');
		} else {
			$lpj = '';
			$format_lpj = '';
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			$data = $this->upload->data();
			redirect('admin/lpj/update/' . $proposal_id);
		}

		$data = array(
			'lpj' => $lpj,
			'format_lpj' => $format_lpj,
			'date_created' => date('Y-m-d H:i:s')
		);

		$this->Lpj_model->editLpj($proposal_id, $data);
		redirect('admin/lpj/update/' . $proposal_id);
	}
}
