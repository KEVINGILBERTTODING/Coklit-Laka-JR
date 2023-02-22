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
		$data['total_md_irms'] = $this->Coklit_model->count_md_irms($irms_id);
		$data['total_md_dasi'] = $this->Coklit_model->count_md_dasi($dasi_id);
		$data['total_ll_irms'] = $this->Coklit_model->count_ll_irms($irms_id);
		$data['total_ll_dasi'] = $this->Coklit_model->count_ll_dasi($dasi_id);

		$data['data_dasi'] = $this->Coklit_model->get_data_dasi($dasi_id);
		$data['data_irms'] = $this->Coklit_model->get_data_irms($irms_id);
		$this->load->view('pengentry/iw/v_result', $data);
	}

	public function import_excel()
	{

		$setting_irms = $this->Excel_model->get_setting_by_id('irms_excel_setting', 1);



		if (isset($_FILES["fileExcelIrms"]["name"])) {
			$path = $_FILES["fileExcelIrms"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			// $uniq_id_irms = md5(uniqid(rand(), true));
			$jam_saat_ini = date('H:i:s');
			$tanggal_saat_ini = date('Y-m-d');
			$random_string = uniqid(rand(), true);

			$irms_id  = $tanggal_saat_ini . $jam_saat_ini . $random_string;
			foreach ($object->getWorksheetIterator() as $worksheet) {
				// $highestRow = $worksheet->getHighestRow();

				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				$row = $setting_irms['row_start'];
				$col_tanggal = $setting_irms['col_tanggal'];
				$col_korban = $setting_irms['col_korban'];
				$col_cidera = $setting_irms['col_cidera'];
				$col_no_lp = $setting_irms['col_no_lp'];


				for ($row = $row; $row <= $highestRow; $row++) {
					$tanggal_irms = $worksheet->getCellByColumnAndRow($col_tanggal, $row)->getValue();
					$korban_irms = $worksheet->getCellByColumnAndRow($col_korban, $row)->getValue();
					$cidera_irms = $worksheet->getCellByColumnAndRow($col_cidera, $row)->getValue();

					$no_lp_irms = $this->get_explode_no_lp($worksheet->getCellByColumnAndRow($col_no_lp, $row)->getValue());

					$data_coklit_irms[] = array(
						'irms_id' => $irms_id,
						'tanggal' => $tanggal_irms,
						'nama_korban' => $korban_irms,
						'cidera' => $cidera_irms,
						'no_lp' => $no_lp_irms
					);
				}
			}

			if (isset($_FILES["fileExcelDasi"]["name"])) {
				$path = $_FILES["fileExcelDasi"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);

				$jam_saat_ini = date('H:i:s');
				$tanggal_saat_ini = date('Y-m-d');
				$random_string = uniqid(rand(), true);

				$dasi_id  = $tanggal_saat_ini . $jam_saat_ini . $random_string;
				foreach ($object->getWorksheetIterator() as $worksheet) {

					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					$setting_dasi = $this->Excel_model->get_setting_by_id('dasi_excel_setting', 1);
					$row = $setting_dasi['row_start'];
					$col_tanggal = $setting_dasi['col_tanggal'];
					$col_korban = $setting_dasi['col_korban'];
					$col_cidera = $setting_dasi['col_cidera'];
					$col_no_lp = $setting_dasi['col_no_lp'];


					for ($row = $row; $row <= $highestRow; $row++) {
						$tanggal_dasi = $worksheet->getCellByColumnAndRow($col_tanggal, $row)->getValue();
						$korban_dasi = $worksheet->getCellByColumnAndRow($col_korban, $row)->getValue();
						$cidera_dasi = $worksheet->getCellByColumnAndRow($col_cidera, $row)->getValue();

						$no_lp_dasi = $this->get_explode_no_lp($worksheet->getCellByColumnAndRow($col_no_lp, $row)->getValue());


						$data_coklit_dasi[] = array(
							'dasi_id' => $dasi_id,
							'tanggal' => $tanggal_dasi,
							'nama_korban' => $korban_dasi,
							'cidera' => $cidera_dasi,
							'no_lp' => $no_lp_dasi
						);
					}
				}


				$this->Coklit_model->insert('dasi', $data_coklit_dasi);
				$this->Coklit_model->insert('irms', $data_coklit_irms);
				$this->session->set_flashdata('message', "Berhasil menyimpan data");
				redirect('pengentry/Coklit/index/' . $irms_id . '/' . $dasi_id);
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
