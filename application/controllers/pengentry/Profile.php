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
		} else if ($this->session->userdata('role') != 2) {
			$url = base_url('login');
			redirect($url);
		}

		$this->load->model('user/User_model', 'User_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->library('pagination');
	}

	public function index()
	{
		$data['detail_user'] = $this->User_model->get_user_detail_by_id($this->session->userdata('id'));
		$this->load->view('pengentry/profile/v_profile', $data);
	}

	public function update_photo_profile()
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
			redirect('pengentry/profile/');
		}


		$data = array(
			'photo_profile' => $foto_profil

		);
		$this->User_model->update_profile($data, $user_id);
		$this->session->set_flashdata('message', 'Foto profil berhasil diubah');
		redirect('pengentry/profile');
	}

	public function update_profile()
	{
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$nama_lengkap = $this->input->post('nama_lengkap');
		$user = array(
			'username' => $username,
			'email' => $email,
			'nama_lengkap' => $nama_lengkap
		);

		$this->User_model->update_profile($user, $this->session->userdata('id'));
		$this->session->set_flashdata('message', 'Profile Berhasil Diubah');
		redirect('pengentry/profile');
	}

	public function download_qrcode($id)
	{

		$data = $this->db->get_where('user', ['user_id' => $id])->row();
		force_download('uploads/qrcode/' . $data->file_qrcode, NULL);
	}

	public function update_password()
	{
		$passwordHash = hash('sha224', $this->input->post('password'));
		$id = $this->input->post('user_id');

		$data = array(
			'user_password' => $passwordHash
		);
		$this->User_model->update_profile($data, $id);
		$this->session->set_flashdata('message', 'Password Berhasil Diubah');
		redirect('pengentry/profile');
	}

	public function update_qr_code()
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
			redirect('pengentry/profile/');
		}


		$data = array(
			'file_qrcode' => $qrcode

		);
		$this->User_model->update_profile($data, $user_id);
		$this->session->set_flashdata('message', 'QrCode Berhasil Diubah');
		redirect('pengentry/profile');
	}
}
