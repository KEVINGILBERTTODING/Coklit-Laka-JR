<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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
		$data['user'] = $this->User_model->getUserById($this->session->userdata('id'));
		$data['detail_user'] = $this->Detail_user_model->getDetailUserById($this->session->userdata('id'));
		$this->load->view('admin/profile/v_profile', $data);
	}

	public function updatePhotoProfile()
	{

		$config['upload_path']          = './uploads/photo_profile/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 5000;
		$config['encrypt_name']         = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$user_id = $this->input->post('user_id');


		if ($this->upload->do_upload('foto_profil')) {
			$data = $this->upload->data();
			$foto_profil = $data['file_name'];
		} else {
			$foto_profil = '';
			$error = array('error' => $this->upload->display_errors());
			$data = $this->upload->data();
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			redirect('admin/profile/');
		}


		$data = array(
			'photo_profile' => $foto_profil

		);
		$this->User_model->updatePhotoProfile($user_id, $data);
		$this->session->set_flashdata('message', 'Foto profil berhasil diubah');
		redirect('admin/profile');
	}

	public function updateProfile()
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$jabatan = $this->input->post('jabatan');

		$user = array(
			'username' => $username,
		);
		$detail_user = array(
			'email' => $email,
			'nama_lengkap' => $nama_lengkap,
			'jabatan' => $jabatan,
		);

		$this->User_model->updateProfile($this->session->userdata('id'), $user);
		$this->Detail_user_model->updateProfile($this->session->userdata('id'), $detail_user);
		$this->session->set_flashdata('message', 'Profile Berhasil Diubah');
		redirect('admin/profile');
	}

	public function downloadQrcode($id)
	{

		$data = $this->db->get_where('detail_user', ['user_id' => $id])->row();
		force_download('uploads/qrcode/' . $data->file_qrcode, NULL);
	}

	public function updatePassword()
	{
		$passwordHash = hash('sha224', $this->input->post('password'));
		$id = $this->input->post('user_id');

		$data = array(
			'user_password' => $passwordHash
		);


		$this->User_model->updatePassword($id, $data);
		$this->session->set_flashdata('message', 'Password Berhasil Diubah');
		redirect('admin/profile');
	}

	public function updateQrCode()
	{

		$config['upload_path']          = './uploads/qrcode/';
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 5000;
		$config['encrypt_name']         = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$user_id = $this->input->post('user_id');


		if ($this->upload->do_upload('qrcode')) {
			$data = $this->upload->data();
			$qrcode = $data['file_name'];
		} else {
			$qrcode = '';
			$error = array('error' => $this->upload->display_errors());
			$data = $this->upload->data();
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			redirect('admin/profile/');
		}


		$data = array(
			'file_qrcode' => $qrcode

		);
		$this->Detail_user_model->updateProfile($user_id, $data);
		$this->session->set_flashdata('message', 'QrCode Berhasil Diubah');
		redirect('admin/profile');
	}
}
