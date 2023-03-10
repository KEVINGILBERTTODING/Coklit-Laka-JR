<?php

defined('BASEPATH') or exit('No direct script access allowed');

use FontLib\Table\Type\post;
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

		$this->load->view('pengentry/coklit/v_entry_coklit', $data);
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
		$this->load->view('pengentry/coklit/v_result', $data);
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


	public function export($irms_id, $dasi_id)
	{

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		$style_col = [
			'font' => ['bold' => true], // Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			],
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, // Set fill type sebagai solid fill
				'startColor' => [
					'argb' => '63B3ED' // Set nilai argb sebagai kode warna (contoh: warna abu-abu)
				]
			],



		];
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]




		];

		$style_empty = [
			'fill' => [
				'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, // Set fill type sebagai solid fill
				'startColor' => [
					'argb' => 'FFFF00' // Set nilai argb sebagai kode warna (contoh: warna abu-abu)
				]
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]

		];




		$sheet->setCellValue('A1', "IRMS")->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
		$sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->mergeCells('G1:K1');
		$sheet->setCellValue('G1', "DASI")->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');

		$sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
		$sheet->getStyle('G1')->getFont()->setBold(true);
		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A3', "NO");
		$sheet->setCellValue('B3', "Tanggal");
		$sheet->setCellValue('C3', "Korban");
		$sheet->setCellValue('D3', "CideraMDL");
		$sheet->setCellValue('E3', "NoLP");


		$sheet->setCellValue('G3', "NO");
		$sheet->setCellValue('H3', "Tanggal");
		$sheet->setCellValue('I3', "Korban");
		$sheet->setCellValue('J3', "CideraMDLLMD-LL");
		$sheet->setCellValue('K3', "NoLP");
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A1:E1')->applyFromArray($style_row);
		$sheet->getStyle('G1:K1')->applyFromArray($style_row);
		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);

		$sheet->getStyle('G3')->applyFromArray($style_col);
		$sheet->getStyle('H3')->applyFromArray($style_col);
		$sheet->getStyle('I3')->applyFromArray($style_col);
		$sheet->getStyle('J3')->applyFromArray($style_col);
		$sheet->getStyle('K3')->applyFromArray($style_col);

		$data_coklit = $this->Coklit_model->formula_coklit($irms_id, $dasi_id);

		$no = 1;
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($data_coklit as $data) { // Lakukan looping pada variabel siswa

			$sheet->setCellValue('A' . $numrow, $no);
			if ($data->irms_tanggal != null) {
				$sheet->setCellValue('B' . $numrow, $data->irms_tanggal);
			} else {
				$sheet->getStyle('B' . $numrow)->applyFromArray($style_empty);
				$sheet->getStyle('A' . $numrow)->applyFromArray($style_empty);
				$sheet->getStyle('F' . $numrow)->applyFromArray($style_empty);
				$sheet->getStyle('F' . $numrow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
			}
			if ($data->irms_nama_korban != null) {
				$sheet->setCellValue('C' . $numrow, $data->irms_nama_korban);
			} else {
				$sheet->getStyle('C' . $numrow)->applyFromArray($style_empty);
			}
			if ($data->irms_cidera != null) {
				$sheet->setCellValue('D' . $numrow, $data->irms_cidera);
			} else {
				$sheet->getStyle('D' . $numrow)->applyFromArray($style_empty);
			}
			if ($data->irms_no_lp != null) {
				$sheet->setCellValue('E' . $numrow, $data->irms_no_lp);
			} else {
				$sheet->getStyle('E' . $numrow)->applyFromArray($style_empty);
			}

			$sheet->setCellValue('G' . $numrow, $no);

			if ($data->dasi_tanggal != null) {
				$sheet->setCellValue('H' . $numrow, $data->dasi_tanggal);
			} else {
				$sheet->getStyle('H' . $numrow)->applyFromArray($style_empty);
				$sheet->getStyle('G' . $numrow)->applyFromArray($style_empty);
				$sheet->getStyle('F' . $numrow)->applyFromArray($style_empty);
				$sheet->getStyle('F' . $numrow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF0000');
			}

			if ($data->dasi_nama_korban != null) {
				$sheet->setCellValue('I' . $numrow, $data->dasi_nama_korban);
			} else {
				$sheet->getStyle('I' . $numrow)->applyFromArray($style_empty);
			}

			if ($data->dasi_cidera != null) {
				$sheet->setCellValue('J' . $numrow, $data->dasi_cidera);
			} else {
				$sheet->getStyle('J' . $numrow)->applyFromArray($style_empty);
			}

			if ($data->dasi_no_lp != null) {
				$sheet->setCellValue('K' . $numrow, $data->dasi_no_lp);
			} else {
				$sheet->getStyle('K' . $numrow)->applyFromArray($style_empty);
			}


			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);

			$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('K' . $numrow)->applyFromArray($style_row);

			$no++; // Tambah 1 setiap kali looping

			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(8); // Set width kolom A
		$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('C')->setWidth(40); // Set width kolom C
		$sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(10); // Set width kolom E

		$sheet->getColumnDimension('G')->setWidth(8); // Set width kolom A
		$sheet->getColumnDimension('H')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('I')->setWidth(40); // Set width kolom C
		$sheet->getColumnDimension('J')->setWidth(20); // Set width kolom D
		$sheet->getColumnDimension('K')->setWidth(10); // Set width kolom E

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$sheet->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$sheet->setTitle("Coklit_result");
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Coklit_result.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}
}
