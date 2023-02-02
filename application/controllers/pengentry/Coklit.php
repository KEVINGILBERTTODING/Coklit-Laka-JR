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

		$data['setting_dasi'] = $this->Excel_model->get_setting_by_id('dasi_excel_setting', 1);
		$data['setting_irms'] = $this->Excel_model->get_setting_by_id('irms_excel_setting', 1);

		$this->load->view('pengentry/iw/v_entry_coklit', $data);
	}
	public function index($irms_id, $dasi_id)
	{

		$data['result'] = $this->Coklit_model->formula_coklit($irms_id, $dasi_id);
		$data['irms_id'] = $irms_id;
		$data['dasi_id'] = $dasi_id;
		$this->load->view('pengentry/iw/v_result', $data);
	}

	public function import_excel()
	{
		// Load setting excel iwkbu
		// $setting_iwkbu_tahun_sekarang = $this->Excel_model->get_setting_excel_by_id('excel_iwkbu_setting', 1);
		// $setting_iwkbu_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkbu_setting', 2);
		// $setting_iwkbu_4_tahun_sebelumnya = $this->Excel_model->get_setting_excel_by_id('excel_iwkbu_setting', 3);



		if (isset($_FILES["fileExcelIrms"]["name"])) {
			$path = $_FILES["fileExcelIrms"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			$uniq_id_irms = md5(uniqid(rand(), true));
			foreach ($object->getWorksheetIterator() as $worksheet) {
				// $highestRow = $worksheet->getHighestRow();

				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();

				for ($row = 3; $row <= $highestRow; $row++) {
					$tanggal_dasi = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$korban_dasi = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$cidera_dasi = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$no_lp_dasi = $this->get_explode_no_lp($worksheet->getCellByColumnAndRow(6, $row)->getValue());

					$data_coklit_irms[] = array(
						'irms_id' => $uniq_id_irms,
						'tanggal' => $tanggal_dasi,
						'nama_korban' => $korban_dasi,
						'cidera' => $cidera_dasi,
						'no_lp' => $no_lp_dasi
					);
				}
			}

			if (isset($_FILES["fileExcelDasi"]["name"])) {
				$path = $_FILES["fileExcelDasi"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				$uniq_id_dasi = md5(uniqid(rand(), true));
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


						$data_coklit_dasi[] = array(
							'dasi_id' => $uniq_id_dasi,
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
				redirect('pengentry/Coklit/index/' . $uniq_id_irms . '/' . $uniq_id_dasi);
			} else {
				$this->session->set_flashdata('upload_error', 'Gagal mengirim berkas');
				redirect('pengentry/Coklit/insert_data');
			}
		}
	}

	public function delete($irms_id, $dasi_id)
	{
		$this->Coklit_model->delete('irms', 'irms_id', $irms_id);
		$this->Coklit_model->delete('dasi', 'dasi_id', $dasi_id);
		$this->session->set_flashdata('message', "Berhasil menghapus data");
		redirect('pengentry/Coklit/insert_data');
	}

	public function update_setting()
	{
		$data = array(
			'row_start' => $this->input->post('row_start'),
			'col_tanggal' => $this->input->post('col_tanggal'),
			'col_korban' => $this->input->post('col_korban'),
			'col_cidera' => $this->input->post('col_cidera'),
			'col_no_lp' => $this->input->post('col_no_lp')

		);

		$this->Excel_model->update_setting($this->input->post('table'), $data, $this->input->post('id'));
		$this->session->set_flashdata('message', "Berhasil mengubah setting");
		redirect('pengentry/Coklit/insert_data');
	}





	public function get_explode_no_lp($no_lp)
	{
		$no_lp = explode('/', $no_lp);
		$no_lp = $no_lp[2];
		return $no_lp;
	}
}
