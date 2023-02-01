<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Coklit_model extends CI_Model
{
	public function insert($jenis, $data)
	{
		$insert = $this->db->insert_batch($jenis, $data);
		if ($insert) {
			return true;
		}
	}

	public function formula_coklit()
	{
		$this->db->select('
		irms.no_lp as irms_no_lp,  irms.tanggal as irms_tanggal, irms.nama_korban as irms_nama_korban, irms.cidera as irms_cidera,
		 dasi.no_lp as dasi_no_lp, dasi.tanggal as dasi_tanggal, dasi.nama_korban as dasi_nama_korban, dasi.cidera as dasi_cidera
		');
		$this->db->from('irms');
		$this->db->join('dasi', 'irms.no_lp = dasi.no_lp and irms.nama_korban like concat("%", dasi.nama_korban, "%")', 'left');
		$query = $this->db->get();
		return $query->result();
	}
}
