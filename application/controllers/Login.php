

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mlogin', 'Mlogin');
	}

	function index()
	{
		if ($this->session->userdata('logged') != TRUE) {
			$this->load->view('login/v_login');
		} else {
			$url = base_url('home');
			redirect($url);
		};
	}

	function autentikasi()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('pass');

		$validasi_username = $this->Mlogin->query_validasi_username($username);
		if ($validasi_username->num_rows() > 0) {
			$validate_ps = $this->Mlogin->query_validasi_password($username, $password);
			if ($validate_ps->num_rows() > 0) {
				$x = $validate_ps->row_array();
				if ($x['user_status'] == '1') {
					$this->session->set_userdata('logged', TRUE);
					$this->session->set_userdata('user', $username);
					$id = $x['user_id'];
					if ($x['role'] == 1) { // Pelihat
						$name = $x['nama'];
						$kode_loket = $x['kode_loket'];
						$role = $x['role'];
						$this->session->set_userdata('id', $id);
						$this->session->set_userdata('name', $name);
						$this->session->set_userdata('kode_loket', $kode_loket);
						$this->session->set_userdata('role', $role);
						redirect('pelihat/dashboard');
					} else if ($x['role'] == '2') { // Petugas Survey
						$name = $x['nama'];
						$kode_loket = $x['kode_loket'];
						$role = $x['role'];
						$this->session->set_userdata('id', $id);
						$this->session->set_userdata('name', $name);
						$this->session->set_userdata('kode_loket', $kode_loket);
						$this->session->set_userdata('role', $role);
						redirect('pengentry/dashboard');
					} else if ($x['role'] == '3') { // Super admin
						$name = $x['nama'];
						$kode_loket = $x['kode_loket'];
						$role = $x['role'];
						$this->session->set_userdata('id', $id);
						$this->session->set_userdata('name', $name);
						$this->session->set_userdata('kode_loket', $kode_loket);
						$this->session->set_userdata('role', $role);
						redirect('super_admin/dashboard');
					} else if ($x['role'] == 'admin') { // Petugas Survey
						$name = $x['nama'];
						$role = $x['role'];
						$this->session->set_userdata('id', $id);
						$this->session->set_userdata('name', $name);
						$this->session->set_userdata('role', $role);
						redirect('admin/dashboard');
					} else if ($x['role'] == 'super_admin') { // Petugas Survey
						$name = $x['nama'];
						$role = $x['role'];
						$this->session->set_userdata('id', $id);
						$this->session->set_userdata('name', $name);
						$this->session->set_userdata('role', $role);
						redirect('super_admin/dashboard');
					}
				} else {
					$url = base_url('login');
					echo $this->session->set_flashdata('msg', "Akun anda telah dinonaktifkan.");
					redirect($url);
				}
			} else {
				$url = base_url('login');
				echo $this->session->set_flashdata('msg', "Password yang anda masukkan salah.");
				redirect($url);
			}
		} else {
			$url = base_url('login');
			echo $this->session->set_flashdata('msg', "Username yang anda masukkan salah.");

			redirect($url);
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		$url = base_url('login');
		redirect($url);
	}
}
