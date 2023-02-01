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

		// $data['dasi_setting'] = $this->Excel_model->get_setting('dasi_excel_setting');
		// $data['setting_irms'] = $this->Excel_model->get_setting('irms_excel_setting');

		$this->load->view('pengentry/iw/v_entry_coklit');
	}
	public function index()
	{
		$data['result'] = $this->Coklit_model->formula_coklit();
		$this->load->view('pengentry/iw/v_result', $data);
	}
	public function import_excel()
	{
		// Load setting excel iwkbu
		// $setting_iwkbu_tahun_sekarang = $this->Excel_model->get_setting_excel_by_id('excel_iwkbu_setting', 1);
		// $setting_iwkbu_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkbu_setting', 2);
		// $setting_iwkbu_4_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkbu_setting', 3);

		// load setting excel iwkl
		// $setting_iwkl_tahun_sekarang = $this->Excel_model->get_setting_excel_by_id('excel_iwkl_setting', 1);
		// $setting_iwkl_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkl_setting', 2);
		// $setting_iwkl_4_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkl_setting', 3);

		if (isset($_FILES["fileExcelIrms"]["name"])) {
			$path = $_FILES["fileExcelIrms"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			$kode_loket = 1;
			foreach ($object->getWorksheetIterator() as $worksheet) {
				// $highestRow = $worksheet->getHighestRow();

				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				// IWKBU tahun saat ini
				// $row_iwkbu_tahun_sekarang = $setting_iwkbu_tahun_sekarang['row_start'];
				// $highestRow_iwkbu_tahun_sekarang = $setting_iwkbu_tahun_sekarang['row_end'];
				// $column_iwkbu_tahun_sekarang = $setting_iwkbu_tahun_sekarang['col'];
				for ($row = 3; $row <= $highestRow; $row++) {
					$tanggal_dasi = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$korban_dasi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$cidera_dasi = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$no_lp_dasi = $this->get_explode_no_lp($worksheet->getCellByColumnAndRow(6, $row)->getValue());




					$data_coklit_dasi[] = array(
						'tanggal' => $tanggal_dasi,
						'nama_korban' => $korban_dasi,
						'cidera' => $cidera_dasi,
						'no_lp' => $no_lp_dasi
					);
				}
			}

			if (isset($_FILES["fileExcelIrms"]["name"])) {
				$path = $_FILES["fileExcelIrms"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				$kode_loket = 1;
				foreach ($object->getWorksheetIterator() as $worksheet) {
					// $highestRow = $worksheet->getHighestRow();

					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();

					// IWKBU tahun saat ini
					// $row_iwkbu_tahun_sekarang = $setting_iwkbu_tahun_sekarang['row_start'];
					// $highestRow_iwkbu_tahun_sekarang = $setting_iwkbu_tahun_sekarang['row_end'];
					// $column_iwkbu_tahun_sekarang = $setting_iwkbu_tahun_sekarang['col'];
					for ($row = 3; $row <= $highestRow; $row++) {
						$tanggal_irms = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$korban_irms = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						$cidera_irms = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
						$no_lp_irms = $this->get_explode_no_lp($worksheet->getCellByColumnAndRow(6, $row)->getValue());




						$data_coklit_irms[] = array(
							'tanggal' => $tanggal_irms,
							'nama_korban' => $korban_irms,
							'cidera' => $cidera_irms,
							'no_lp' => $no_lp_irms
						);
					}
				}


				$this->Coklit_model->insert('dasi', $data_coklit_dasi);
				$this->Coklit_model->insert('irms', $data_coklit_irms);
				$this->session->set_flashdata('message', "Berhasil menyimpan data");
				redirect('pengentry/Coklit');
			} else {
				$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
				redirect('pengentry/Coklit');
			}
		}
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

	public function get_explode_no_lp($no_lp)
	{
		$no_lp = explode('/', $no_lp);
		$no_lp = $no_lp[2];
		return $no_lp;
	}
}
