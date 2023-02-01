<?php

use FontLib\Table\Type\post;

defined('BASEPATH') or exit('No direct script access allowed');

class Coklit extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library(array('excel', 'session'));
		if ($this->session->userdata('logged') != TRUE) {
			$url = base_url('login');
			redirect($url);
		} else if ($this->session->userdata('role') != '2') {
			$url = base_url('login');
			redirect($url);
		}


		$this->load->model('coklit/Coklit_model', 'Coklit_model');
		$this->load->model('coklit/Excel_model', 'Excel_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->library('pagination');
	}
	public function insert_data()
	{

		$data['dasi_setting'] = $this->Excel_model->get_setting('dasi_excel_setting');
		$data['setting_irms'] = $this->Excel_model->get_setting('irms_excel_setting');

		$this->load->view('pengentry/iw/v_entry_iw', $data);
	}
	public function index()
	{


		$this->load->view('pengentry/iw/v_entry_iw');
	}
	public function import_excel()
	{
		// Load setting excel iwkbu
		$setting_iwkbu_tahun_sekarang = $this->Excel_model->get_setting_excel_by_id('excel_iwkbu_setting', 1);
		$setting_iwkbu_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkbu_setting', 2);
		$setting_iwkbu_4_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkbu_setting', 3);

		// load setting excel iwkl
		$setting_iwkl_tahun_sekarang = $this->Excel_model->get_setting_excel_by_id('excel_iwkl_setting', 1);
		$setting_iwkl_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkl_setting', 2);
		$setting_iwkl_4_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkl_setting', 3);

		if (isset($_FILES["fileExcel"]["name"])) {
			$path = $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			$kode_loket = 1;
			foreach ($object->getWorksheetIterator() as $worksheet) {
				// $highestRow = $worksheet->getHighestRow();

				$highestColumn = $worksheet->getHighestColumn();

				// IWKBU tahun saat ini
				$row_iwkbu_tahun_sekarang = $setting_iwkbu_tahun_sekarang['row_start'];
				$highestRow_iwkbu_tahun_sekarang = $setting_iwkbu_tahun_sekarang['row_end'];
				$column_iwkbu_tahun_sekarang = $setting_iwkbu_tahun_sekarang['col'];
				for ($row = $row_iwkbu_tahun_sekarang; $row <= $highestRow_iwkbu_tahun_sekarang; $row++) {
					$nominal_iwkbu_tahun_sekarang = $worksheet->getCellByColumnAndRow($column_iwkbu_tahun_sekarang, $row)->getValue();
					$nominal_iwkbu_tahun_sekarang = str_replace('Rp', '', $nominal_iwkbu_tahun_sekarang);
					$nominal_iwkbu_tahun_sekarang = str_replace('.', '', $nominal_iwkbu_tahun_sekarang);
					$nominal_iwkbu_tahun_sekarang = str_replace(',', '', $nominal_iwkbu_tahun_sekarang);
					$nominal_iwkbu_tahun_sekarang = str_replace('(', '', $nominal_iwkbu_tahun_sekarang);
					$nominal_iwkbu_tahun_sekarang = str_replace(')', '', $nominal_iwkbu_tahun_sekarang);

					$data_iwkbu_tahun_sekarang[] = array(
						'kode_loket' => $kode_loket++,
						'nominal'	=> $nominal_iwkbu_tahun_sekarang,
						'tanggal' => $this->input->post('tanggal'),
						'date_created' => date('Y-m-d H:i:s')
					);
				}


				// IWKBU tahun sebelumnya
				$kode_loket_tahun_sebelumnya = 1;
				$row_iwkbu_tahun_sebelumnya = $setting_iwkbu_tahun_sebelumnya['row_start'];
				$highestRow_iwkbu_tahun_sebelumnya = $setting_iwkbu_tahun_sebelumnya['row_end'];
				$column_iwkbu_tahun_sebelumnya = $setting_iwkbu_tahun_sebelumnya['col'];
				for ($row = $row_iwkbu_tahun_sebelumnya; $row <= $highestRow_iwkbu_tahun_sebelumnya; $row++) {
					$nominal_iwkbu_tahun_sebelumnya = $worksheet->getCellByColumnAndRow($column_iwkbu_tahun_sebelumnya, $row)->getValue();
					$nominal_iwkbu_tahun_sebelumnya = str_replace('Rp', '', $nominal_iwkbu_tahun_sebelumnya);
					$nominal_iwkbu_tahun_sebelumnya = str_replace('.', '', $nominal_iwkbu_tahun_sebelumnya);
					$nominal_iwkbu_tahun_sebelumnya = str_replace(',', '', $nominal_iwkbu_tahun_sebelumnya);
					$nominal_iwkbu_tahun_sebelumnya = str_replace('(', '', $nominal_iwkbu_tahun_sebelumnya);
					$nominal_iwkbu_tahun_sebelumnya = str_replace(')', '', $nominal_iwkbu_tahun_sebelumnya);

					$data_iwkbu_tahun_sebelumnya[] = array(
						'kode_loket' => $kode_loket_tahun_sebelumnya++,
						'nominal'	=> $nominal_iwkbu_tahun_sebelumnya,
						'tanggal' => $this->modify_year($this->input->post('tanggal'), '-1 year'),
						'date_created' => date('Y-m-d H:i:s')
					);
				}


				// IWKBU 4 tahun sebelumnya
				$kode_loket_4_tahun_sebelumnya = 1;
				$row_iwkbu_4_tahun_sebelumnya = $setting_iwkbu_4_tahun_sebelumnya['row_start'];
				$highestRow_iwkbu_4_tahun_sebelumnya = $setting_iwkbu_4_tahun_sebelumnya['row_end'];
				$column_iwkbu_4_tahun_sebelumnya = $setting_iwkbu_4_tahun_sebelumnya['col'];
				for ($row = $row_iwkbu_4_tahun_sebelumnya; $row <= $highestRow_iwkbu_4_tahun_sebelumnya; $row++) {
					$nominal_iwkbu_4_tahun_sebelumnya = $worksheet->getCellByColumnAndRow($column_iwkbu_4_tahun_sebelumnya, $row)->getValue();
					$nominal_iwkbu_4_tahun_sebelumnya = str_replace('Rp', '', $nominal_iwkbu_4_tahun_sebelumnya);
					$nominal_iwkbu_4_tahun_sebelumnya = str_replace('.', '', $nominal_iwkbu_4_tahun_sebelumnya);
					$nominal_iwkbu_4_tahun_sebelumnya = str_replace(',', '', $nominal_iwkbu_4_tahun_sebelumnya);
					$nominal_iwkbu_4_tahun_sebelumnya = str_replace('(', '', $nominal_iwkbu_4_tahun_sebelumnya);
					$nominal_iwkbu_4_tahun_sebelumnya = str_replace(')', '', $nominal_iwkbu_4_tahun_sebelumnya);

					$data_iwkbu_4_tahun_sebelumnya[] = array(
						'kode_loket' => $kode_loket_4_tahun_sebelumnya++,
						'nominal'	=> $nominal_iwkbu_4_tahun_sebelumnya,
						'tanggal' => $this->modify_year($this->input->post('tanggal'), '-4 year'),
						'date_created' => date('Y-m-d H:i:s')
					);
				}

				// IWKL tahun saat ini
				$kode_loket_iwkl_tahun_sekarang = 1;
				$row_iwkl_tahun_sekarang = $setting_iwkl_tahun_sekarang['row_start'];
				$highestRow_iwkl_tahun_sekarang = $setting_iwkl_tahun_sekarang['row_end'];
				$column_iwkl_tahun_sekarang = $setting_iwkl_tahun_sekarang['col'];
				for ($row = $row_iwkl_tahun_sekarang; $row <= $highestRow_iwkl_tahun_sekarang; $row++) {
					$nominal_iwkl_tahun_sekarang = $worksheet->getCellByColumnAndRow($column_iwkl_tahun_sekarang, $row)->getValue();
					$nominal_iwkl_tahun_sekarang = str_replace('Rp', '', $nominal_iwkl_tahun_sekarang);
					$nominal_iwkl_tahun_sekarang = str_replace('.', '', $nominal_iwkl_tahun_sekarang);
					$nominal_iwkl_tahun_sekarang = str_replace(',', '', $nominal_iwkl_tahun_sekarang);
					$nominal_iwkl_tahun_sekarang = str_replace('(', '', $nominal_iwkl_tahun_sekarang);
					$nominal_iwkl_tahun_sekarang = str_replace(')', '', $nominal_iwkl_tahun_sekarang);

					$data_iwkl_tahun_sekarang[] = array(
						'kode_loket' => $kode_loket_iwkl_tahun_sekarang++,
						'nominal'	=> $nominal_iwkl_tahun_sekarang,
						'tanggal' => $this->input->post('tanggal'),
						'date_created' => date('Y-m-d H:i:s')
					);
				}


				// IWKL tahun sebelumya
				$kode_loket_iwkl_tahun_sebelumnya = 1;
				$row_iwkl_tahun_sebelumnya = $setting_iwkl_tahun_sebelumnya['row_start'];
				$highestRow_iwkl_tahun_sebelumnya = $setting_iwkl_tahun_sebelumnya['row_end'];
				$column_iwkl_tahun_sebelumnya = $setting_iwkl_tahun_sebelumnya['col'];
				for ($row = $row_iwkl_tahun_sebelumnya; $row <= $highestRow_iwkl_tahun_sebelumnya; $row++) {
					$nominal_iwkl_tahun_sebelumnya = $worksheet->getCellByColumnAndRow($column_iwkl_tahun_sebelumnya, $row)->getValue();
					$nominal_iwkl_tahun_sebelumnya = str_replace('Rp', '', $nominal_iwkl_tahun_sebelumnya);
					$nominal_iwkl_tahun_sebelumnya = str_replace('.', '', $nominal_iwkl_tahun_sebelumnya);
					$nominal_iwkl_tahun_sebelumnya = str_replace(',', '', $nominal_iwkl_tahun_sebelumnya);
					$nominal_iwkl_tahun_sebelumnya = str_replace('(', '', $nominal_iwkl_tahun_sebelumnya);
					$nominal_iwkl_tahun_sebelumnya = str_replace(')', '', $nominal_iwkl_tahun_sebelumnya);

					$data_iwkl_tahun_sebelumnya[] = array(
						'kode_loket' => $kode_loket_iwkl_tahun_sebelumnya++,
						'nominal'	=> $nominal_iwkl_tahun_sebelumnya,
						'tanggal' => $this->modify_year($this->input->post('tanggal'), '-1 year'),
						'date_created' => date('Y-m-d H:i:s')
					);
				}



				// IWKL 4 tahun sebelumya
				$kode_loket_iwkl_4_tahun_sebelumnya = 1;
				$row_iwkl_4_tahun_sebelumnya = $setting_iwkl_4_tahun_sebelumnya['row_start'];
				$highestRow_iwkl_4_tahun_sebelumnya = $setting_iwkl_4_tahun_sebelumnya['row_end'];
				$column_iwkl_4_tahun_sebelumnya = $setting_iwkl_4_tahun_sebelumnya['col'];
				for ($row = $row_iwkl_4_tahun_sebelumnya; $row <= $highestRow_iwkl_4_tahun_sebelumnya; $row++) {
					$nominal_iwkl_4_tahun_sebelumnya = $worksheet->getCellByColumnAndRow($column_iwkl_4_tahun_sebelumnya, $row)->getValue();
					$nominal_iwkl_4_tahun_sebelumnya = str_replace('Rp', '', $nominal_iwkl_4_tahun_sebelumnya);
					$nominal_iwkl_4_tahun_sebelumnya = str_replace('.', '', $nominal_iwkl_4_tahun_sebelumnya);
					$nominal_iwkl_4_tahun_sebelumnya = str_replace(',', '', $nominal_iwkl_4_tahun_sebelumnya);
					$nominal_iwkl_4_tahun_sebelumnya = str_replace('(', '', $nominal_iwkl_4_tahun_sebelumnya);
					$nominal_iwkl_4_tahun_sebelumnya = str_replace(')', '', $nominal_iwkl_4_tahun_sebelumnya);

					$data_iwkl_4_tahun_sebelumnya[] = array(
						'kode_loket' => $kode_loket_iwkl_4_tahun_sebelumnya++,
						'nominal'	=> $nominal_iwkl_4_tahun_sebelumnya,
						'tanggal' => $this->modify_year($this->input->post('tanggal'), '-4 year'),
						'date_created' => date('Y-m-d H:i:s')
					);
				}
			}






			// OPSI JIKA FILTER MENGGUNAKAN VALIDASI[LEBIH AKURAT DAN RUMIT]
			$cek_data_iwkbu_tahun_sebelumnya = $this->Iw_model->cek_data_iw('iwkbu', $this->modify_year($this->input->post('tanggal'), '-1 year'));


			// Cek apakah tahun sebelumnya sama dengan 2019
			$iwkbu_4_tahun_sebelumnya = $this->modify_year($this->input->post('tanggal'), '-4 year');
			$iwkbu_4_tahun_sebelumnya = substr($iwkbu_4_tahun_sebelumnya, 0, 4);

			// Cek apakah 4 tahun sebelum sama dengan 2019
			if ($iwkbu_4_tahun_sebelumnya == '2019') {
				$cek_data_iwkbu_4_tahun_sebelumnya = $this->Iw_model->cek_data_iw('iwkbu', $this->modify_year($this->input->post('tanggal'), '-4 year'));
			} else {
			}

			// Cek apakah tahun sebelumnya sama dengan 2019
			$iwkl_4_tahun_sebelumnya = $this->modify_year($this->input->post('tanggal'), '-4 year');
			$iwkl_4_tahun_sebelumnya = substr($iwkl_4_tahun_sebelumnya, 0, 4);

			$cek_data_iwkl_tahun_sebelumnya = $this->Iw_model->cek_data_iw('iwkl', $this->modify_year($this->input->post('tanggal'), '-1 year'));
			$cek_data_iwkl_4_tahun_sebelumnya = $this->Iw_model->cek_data_iw('iwkl', $this->modify_year($this->input->post('tanggal'), '-4 year'));


			// Cek apakah 4 tahun sebelum sama dengan 2019
			if ($iwkl_4_tahun_sebelumnya == '2019') {
				$cek_data_iwkl_4_tahun_sebelumnya = $this->Iw_model->cek_data_iw('iwkl', $this->modify_year($this->input->post('tanggal'), '-4 year'));
			} else {
			}


			// Validasi data iwkbu
			if ($cek_data_iwkbu_tahun_sebelumnya && $cek_data_iwkbu_4_tahun_sebelumnya) {
			} else if ($cek_data_iwkbu_tahun_sebelumnya) {

				$this->Iw_model->insert('iwkbu', $data_iwkbu_tahun_sekarang);
			} else if ($iwkbu_4_tahun_sebelumnya == '2019') {
				if ($cek_data_iwkbu_4_tahun_sebelumnya) {
				} else {
					$this->Iw_model->insert('iwkbu', $data_iwkbu_tahun_sekarang);
					$this->Iw_model->insert('iwkbu', $data_iwkbu_tahun_sebelumnya);
					$this->Iw_model->insert('iwkbu', $data_iwkbu_4_tahun_sebelumnya);
				}
			} else {

				if ($iwkbu_4_tahun_sebelumnya == '2019') {
					if ($cek_data_iwkbu_4_tahun_sebelumnya) {
						$this->Iw_model->insert('iwkbu', $data_iwkbu_tahun_sekarang);
						$this->Iw_model->insert('iwkbu', $data_iwkbu_tahun_sebelumnya);
					} else {
						$this->Iw_model->insert('iwkbu', $data_iwkbu_tahun_sekarang);
						$this->Iw_model->insert('iwkbu', $data_iwkbu_tahun_sebelumnya);
						$this->Iw_model->insert('iwkbu', $data_iwkbu_4_tahun_sebelumnya);
					}
				} else {
					$this->Iw_model->insert('iwkbu', $data_iwkbu_tahun_sekarang);
					$this->Iw_model->insert('iwkbu', $data_iwkbu_tahun_sebelumnya);
				}
			}


			// Validasi data iwkl
			if ($cek_data_iwkl_tahun_sebelumnya && $cek_data_iwkl_4_tahun_sebelumnya) {
			} else if ($cek_data_iwkl_tahun_sebelumnya) {

				$this->Iw_model->insert('iwkl', $data_iwkl_tahun_sekarang);
			} else if ($iwkl_4_tahun_sebelumnya == '2019') {
				if ($cek_data_iwkl_4_tahun_sebelumnya) {
				} else {
					$this->Iw_model->insert('iwkl', $data_iwkl_tahun_sekarang);
					$this->Iw_model->insert('iwkl', $data_iwkl_tahun_sebelumnya);
					$this->Iw_model->insert('iwkl', $data_iwkl_4_tahun_sebelumnya);
				}
			} else {

				if ($iwkl_4_tahun_sebelumnya == '2019') {
					if ($cek_data_iwkl_4_tahun_sebelumnya) {
						$this->Iw_model->insert('iwkl', $data_iwkl_tahun_sekarang);
						$this->Iw_model->insert('iwkl', $data_iwkl_tahun_sebelumnya);
					} else {
						$this->Iw_model->insert('iwkl', $data_iwkl_tahun_sekarang);
						$this->Iw_model->insert('iwkl', $data_iwkl_tahun_sebelumnya);
						$this->Iw_model->insert('iwkl', $data_iwkl_4_tahun_sebelumnya);
					}
				} else {
					$this->Iw_model->insert('iwkl', $data_iwkl_tahun_sekarang);
					$this->Iw_model->insert('iwkl', $data_iwkl_tahun_sebelumnya);
				}
			}

			$this->session->set_flashdata('message', "Berhasil menyimpan data");
			redirect('pengentry/iw');
		} else {
			$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
			redirect('pengentry/iw');
		}
	}

	public function cek_data_iw($table, $date)
	{
		$data = $this->Iw_model->cek_data_iw($table, $date);
		if ($data) {
			$response = array(
				'status' => 'success',
				'code' => 200,
				'message' => 'Data ada',
				'data' => $data
			);

			echo json_encode($response);
		} else {
			$response = array(
				'status' => 'error',
				'code' => 404,
				'message' => 'Data tidak ditemukan',
				'data' => $data
			);
			echo json_encode($response);
		}
	}

	public function update_data_iwkbu()
	{
		$data = array(
			array(
				'iwkbu_id' => $this->input->post('id_iwkbu_1'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_1')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkbu_id' => $this->input->post('id_iwkbu_2'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_2')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkbu_id' => $this->input->post('id_iwkbu_3'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_3')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkbu_id' => $this->input->post('id_iwkbu_4'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_4')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkbu_id' => $this->input->post('id_iwkbu_5'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_5')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkbu_id' => $this->input->post('id_iwkbu_6'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_6')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkbu_id' => $this->input->post('id_iwkbu_7'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_7')),
				'date_created' => date('Y-m-d H:i:s')
			),
			array(
				'iwkbu_id' => $this->input->post('id_iwkbu_8'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_8')),
				'date_created' => date('Y-m-d H:i:s')
			)

		);

		$this->Iw_model->update_data_batch($data, 'iwkbu_id', 'iwkbu');
		$this->session->set_flashdata('message', 'Data IW berhasil diperbaharui');
		redirect('pengentry/iw');
	}


	public function update_data_iwkl()
	{
		$data = array(
			array(
				'iwkl_id' => $this->input->post('id_iwkl_1'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_1')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkl_id' => $this->input->post('id_iwkl_2'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_2')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkl_id' => $this->input->post('id_iwkl_3'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_3')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkl_id' => $this->input->post('id_iwkl_4'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_4')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkl_id' => $this->input->post('id_iwkl_5'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_5')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkl_id' => $this->input->post('id_iwkl_6'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_6')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'iwkl_id' => $this->input->post('id_iwkl_7'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_7')),
				'date_created' => date('Y-m-d H:i:s')
			),
			array(
				'iwkl_id' => $this->input->post('id_iwkl_8'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_8')),
				'date_created' => date('Y-m-d H:i:s')
			)

		);

		$this->Iw_model->update_data_batch($data, 'iwkl_id', 'iwkl');
		$this->session->set_flashdata('message', 'Data IW berhasil diperbaharui');
		redirect('pengentry/iw');
	}

	public function replace_string($nominal)
	{
		$nominal = str_replace('Rp', '', $nominal);
		$nominal = str_replace('.', '', $nominal);
		$nominal = str_replace(',', '', $nominal);
		return $nominal;
	}

	public function modify_year($year, $total)
	{
		$tahun_lalu = date($year);
		$tahun_lalu = date('Y-m-d', strtotime($total, strtotime($tahun_lalu)));
		return $tahun_lalu;
	}

	public function update_batch_setting_iwkbu()
	{
		$data = array(
			array(
				'id' => $this->input->post('id_1'),
				'col' => $this->input->post('col_1'),
				'row_end' => $this->input->post('row_end_1'),
				'row_start' => $this->input->post('row_start_1')
			),
			array(
				'id' => $this->input->post('id_2'),
				'col' => $this->input->post('col_2'),
				'row_end' => $this->input->post('row_end_2'),
				'row_start' => $this->input->post('row_start_2')
			),
			array(
				'id' => $this->input->post('id_3'),
				'col' => $this->input->post('col_3'),
				'row_end' => $this->input->post('row_end_3'),
				'row_start' => $this->input->post('row_start_3')
			),
		);

		$this->Excel_model->update_data_batch($data, 'id', 'excel_iwkbu_setting');
		$this->session->set_flashdata('message', 'Data berhasil diperbaharui');
		redirect('pengentry/iw');
	}

	public function update_batch_setting_iwkl()
	{
		$data = array(
			array(
				'id' => $this->input->post('id_1'),
				'col' => $this->input->post('col_1'),
				'row_end' => $this->input->post('row_end_1'),
				'row_start' => $this->input->post('row_start_1')
			),
			array(
				'id' => $this->input->post('id_2'),
				'col' => $this->input->post('col_2'),
				'row_end' => $this->input->post('row_end_2'),
				'row_start' => $this->input->post('row_start_2')
			),
			array(
				'id' => $this->input->post('id_3'),
				'col' => $this->input->post('col_3'),
				'row_end' => $this->input->post('row_end_3'),
				'row_start' => $this->input->post('row_start_3')
			),
		);

		$this->Excel_model->update_data_batch($data, 'id', 'excel_iwkl_setting');
		$this->session->set_flashdata('message', 'Data berhasil diperbaharui');
		redirect('pengentry/iw');
	}
	public function anggaran_iw()
	{
		$data['loket'] = $this->Loket_model->get_all_loket();
		$data['loket_iwkl'] = $this->Loket_model->get_all_loket();
		$this->load->view('pengentry/iw/v_entry_anggaran_iw', $data);
	}


	public function cek_anggaran_data_iw($table, $date)
	{
		$data = $this->Iw_model->cek_anggaran_data_iw($table, $date);
		if ($data) {
			$response = array(
				'status' => 'success',
				'code' => 200,
				'message' => 'Data ada',
				'data' => $data
			);

			echo json_encode($response);
		} else {
			$response = array(
				'status' => 'error',
				'code' => 404,
				'message' => 'Data tidak ditemukan',
				'data' => $data
			);
			echo json_encode($response);
		}
	}

	public function update_anggaran_iwkbu()
	{
		$data = array(
			array(
				'anggaran_id' => $this->input->post('id_iwkbu_1'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_1')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkbu_2'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_2')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkbu_3'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_3')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkbu_4'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_4')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkbu_5'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_5')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkbu_6'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_6')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkbu_7'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_7')),
				'date_created' => date('Y-m-d H:i:s')
			),
			array(
				'anggaran_id' => $this->input->post('id_iwkbu_8'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkbu_8')),
				'date_created' => date('Y-m-d H:i:s')
			)

		);

		$this->Iw_model->update_data_batch($data, 'anggaran_id', 'anggaran_iwkbu');
		$this->session->set_flashdata('message', 'Anggaran IW berhasil diperbaharui');
		redirect('pengentry/iw/anggaran_iw');
	}

	public function update_anggaran_iwkl()
	{
		$data = array(
			array(
				'anggaran_id' => $this->input->post('id_iwkl_1'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_1')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkl_2'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_2')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkl_3'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_3')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkl_4'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_4')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkl_5'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_5')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkl_6'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_6')),
				'date_created' => date('Y-m-d H:i:s')
			),

			array(
				'anggaran_id' => $this->input->post('id_iwkl_7'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_7')),
				'date_created' => date('Y-m-d H:i:s')
			),
			array(
				'anggaran_id' => $this->input->post('id_iwkl_8'),
				'nominal' => $this->replace_string($this->input->post('nominal_iwkl_8')),
				'date_created' => date('Y-m-d H:i:s')
			)

		);

		$this->Iw_model->update_data_batch($data, 'anggaran_id', 'anggaran_iwkl');
		$this->session->set_flashdata('message', 'Anggaran IW berhasil diperbaharui');
		redirect('pengentry/iw/anggaran_iw');
	}
	public function insert_batch_anggaran_iwkbu()
	{
		for ($i = 1; $i <= 8; $i++) {
			$data[] = array(
				'loket_id' => $i,
				'tahun' => $this->input->post('tahun_iwkbu'),
				'nominal' => $this->replace_string($this->input->post('entry_nominal_iwkbu_' . $i)),
				'date_created' => date('Y-m-d H:i:s')
			);
		}
		$this->Iw_model->insert_batch('anggaran_iwkbu', $data);
		$this->session->set_flashdata('message', 'Anggaran IW berhasil ditambahkan');
		redirect('pengentry/iw/anggaran_iw');
	}

	public function insert_batch_anggaran_iwkl()
	{
		for ($i = 1; $i <= 8; $i++) {
			$data[] = array(
				'loket_id' => $i,
				'tahun' => $this->input->post('tahun_iwkl'),
				'nominal' => $this->replace_string($this->input->post('entry_nominal_iwkl_' . $i)),
				'date_created' => date('Y-m-d H:i:s')
			);
		}
		$this->Iw_model->insert_batch('anggaran_iwkl', $data);
		$this->session->set_flashdata('message', 'Anggaran IW berhasil ditambahkan');
		redirect('pengentry/iw/anggaran_iw');
	}

	public function siklikal_iw()
	{

		$this->load->view('pengentry/iw/v_entry_siklikal_iw');
	}

	public function cek_siklikal_data_iw($table, $date)
	{
		$data = $this->Iw_model->cek_siklikal_data_iw($table, $date);
		if ($data) {
			$response = array(
				'status' => 'success',
				'code' => 200,
				'message' => 'Data ada',
				'data' => $data
			);

			echo json_encode($response);
		} else {
			$response = array(
				'status' => 'error',
				'code' => 404,
				'message' => 'Data tidak ditemukan',
				'data' => $data
			);
			echo json_encode($response);
		}
	}

	public function insert_batch_siklikal_iwkbu()
	{
		for ($i = 1; $i <= 8; $i++) {
			$data[] = array(
				'kode_loket' => $i,
				'date' => $this->input->post('tahun_siklikal_iwkbu'),
				'nominal' => $this->replace_string($this->input->post('jumlah_siklikal_iwkbu')),
				'date_created' => date('Y-m-d H:i:s')
			);
		}
		$this->Iw_model->insert_batch('siklikal_iwkbu', $data);
		$this->session->set_flashdata('message', 'Siklikal IW berhasil ditambahkan');
		redirect('pengentry/iw/siklikal_iw');
	}



	public function insert_batch_siklikal_iwkl()
	{
		for ($i = 1; $i <= 8; $i++) {
			$data[] = array(
				'kode_loket' => $i,
				'date' => $this->input->post('tahun_siklikal_iwkl'),
				'nominal' => $this->replace_string($this->input->post('jumlah_siklikal_iwkl')),
				'date_created' => date('Y-m-d H:i:s')
			);
		}
		$this->Iw_model->insert_batch('siklikal_iwkl', $data);
		$this->session->set_flashdata('message', 'Siklikal IW berhasil ditambahkan');
		redirect('pengentry/iw/siklikal_iw');
	}


	public function update_siklikal_iwkbu()
	{
		$data = array(
			'nominal' => $this->replace_string($this->input->post('jumlah_siklikal_iwkbu')),
			'date_created' => date('Y-m-d H:i:s')

		);

		$this->Siklikal_model->update_siklikal_by_id('siklikal_iwkbu', $this->input->post('tahun_siklikal_iwkbu'), $data);
		$this->session->set_flashdata('message', 'Siklikal IW berhasil diperbaharui');
		redirect('pengentry/iw/siklikal_iw');
	}

	public function update_siklikal_iwkl()
	{
		$data = array(

			'nominal' => $this->replace_string($this->input->post('jumlah_siklikal_iwkl')),
			'date_created' => date('Y-m-d H:i:s')

		);


		$this->Siklikal_model->update_siklikal_by_id('siklikal_iwkl', $this->input->post('tahun_siklikal_iwkl'), $data);
		$this->session->set_flashdata('message', 'Siklikal IW berhasil diperbaharui');
		redirect('pengentry/iw/siklikal_iw');
	}
}
