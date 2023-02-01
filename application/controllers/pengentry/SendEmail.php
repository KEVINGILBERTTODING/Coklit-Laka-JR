<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SendEmail extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('email'));
		$this->load->library(array('email'));


		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('login');
			redirect($url);
		} else if ($this->session->userdata('role') != 2) {
			$url = base_url('login');
			redirect($url);
		}


		// Load library form validation dan helper form
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->model('user/User_model', 'User_model');
	}


	public function index()
	{
		$passwordHash = hash('sha224', $this->input->post('password'));
		$user_id = $this->input->post('user_id');
		$data['detail_user'] = $this->User_model->get_user_detail_by_id($user_id);

		$updatePassword = array(
			'user_password' => $passwordHash
		);

		$this->User_model->update_profile($updatePassword, $user_id);

		$new_password = $this->input->post('password');
		$username = $data['detail_user']['username'];
		$email = $data['detail_user']['email'];
		$nama_lengkap = $data['detail_user']['nama_lengkap'];

		// Konfigurasi email
		$subject = 'Kata Sandi Berhasil di Perbaharui';
		$message =
			"
			<center><p>Halo $nama_lengkap,</p></center>
			<p>Kami telah mengirimkan email ini untuk memberitahukan bahwa kata sandi anda telah di perbaharui.</p>
			<p>Anda dapat login dengan menggunakan kata sandi baru anda.</p>
		
			<p>Username : <b>$username</b></p>
			<p>Kata Sandi: <b>$new_password</b></p>
			<br><br>
			<p>Salam Hangat</p>
			<br>
			<b>Super Admin JATENG</b>
			";


		$this->sendEmail($message, $subject, $email, $username, $user_id);
	}
	function sendEmail($message, $subject, $email, $username, $user_id)
	{

		// Config email
		$this->load->library('PHPMailer_load'); //Load Library PHPMailer
		$mail = $this->phpmailer_load->load(); // Mendefinisikan Variabel Mail
		$mail->isSMTP();  // Mengirim menggunakan protokol SMTP
		$mail->Host = 'smtp.gmail.com'; // Host dari server SMTP
		$mail->SMTPAuth = true; // Autentikasi SMTP
		$mail->Username = 'jateng.app@gmail.com';
		$mail->Password = 'kebgckyuiissdapn';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->setFrom('Jateng-jr@gmail.com', 'JATENG-JR'); // Sumber email
		$mail->addAddress($email, $username); // Alamat tujuan
		$mail->Subject = $subject; // Subjek Email

		$mail->msgHtml($message);

		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
			$this->session->set_flashdata('message', 'Password Berhasil Diubah');
			redirect('pengentry/profile');
		} else {
			$this->session->set_flashdata('message', 'Password Berhasil Diubah');
			redirect('pengentry/profile');
		}
	}
}
