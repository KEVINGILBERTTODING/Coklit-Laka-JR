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

	public function formula_coklit($irms_id, $dasi_id)
	{
		$this->db->select('
			irms.no_lp as irms_no_lp,  irms.tanggal as irms_tanggal, irms.nama_korban as irms_nama_korban, irms.cidera as irms_cidera,
			dasi.no_lp as dasi_no_lp, dasi.tanggal as dasi_tanggal, dasi.nama_korban as dasi_nama_korban, dasi.cidera as dasi_cidera
		   ');
		$this->db->from('irms');
		$this->db->where('irms_id', $irms_id);
		$this->db->join('dasi', 'soundex(trim(lower(replace(substring_index(irms.nama_korban, "(", 1), "(", "")))) = soundex(trim(lower(replace(substring_index(dasi.nama_korban, "(", 1), "(", "")))) and irms.no_lp = dasi.no_lp', 'left');


		$left_join = $this->db->get_compiled_select();
		$this->db->select('
		   irms.no_lp as irms_no_lp,  irms.tanggal as irms_tanggal, irms.nama_korban as irms_nama_korban, irms.cidera as irms_cidera,
			dasi.no_lp as dasi_no_lp, dasi.tanggal as dasi_tanggal, dasi.nama_korban as dasi_nama_korban, dasi.cidera as dasi_cidera
		   ');
		$this->db->from('irms');
		$this->db->where('dasi_id', $dasi_id);
		$this->db->join('dasi', 'soundex(trim(lower(replace(substring_index(irms.nama_korban, "(", 1), "(", "")))) = soundex(trim(lower(replace(substring_index(dasi.nama_korban, "(", 1), "(", "")))) and irms.no_lp = dasi.no_lp', 'right');
		$right_join = $this->db->get_compiled_select();
		$full_join = $left_join . ' UNION ' . $right_join;
		$query = $this->db->query($full_join);
		$result = $query->result();
		$unique_result = array_unique($result, SORT_REGULAR);
		return $unique_result;

		// 	$result = array();

		// 	// query untuk tabel kiri
		// 	$this->db->select('
		// 		irms.no_lp as irms_no_lp,  irms.tanggal as irms_tanggal, irms.nama_korban as irms_nama_korban, irms.cidera as irms_cidera,
		// 		dasi.no_lp as dasi_no_lp, dasi.tanggal as dasi_tanggal, dasi.nama_korban as dasi_nama_korban, dasi.cidera as dasi_cidera
		// 	   ');
		// 	$this->db->from('irms');
		// 	$this->db->where('irms_id', $irms_id);
		// 	$this->db->join('dasi', 'soundex(trim(lower(replace(substring_index(irms.nama_korban, "(", 1), "(", "")))) = soundex(trim(lower(replace(substring_index(dasi.nama_korban, "(", 1), "(", "")))) and irms.no_lp = dasi.no_lp', 'left');
		// 	$left_join = $this->db->get();

		// 	// query untuk tabel kanan
		// 	$this->db->select('
		// 	irms.no_lp as irms_no_lp,  irms.tanggal as irms_tanggal, irms.nama_korban as irms_nama_korban, irms.cidera as irms_cidera,
		// 	dasi.no_lp as dasi_no_lp, dasi.tanggal as dasi_tanggal, dasi.nama_korban as dasi_nama_korban, dasi.cidera as dasi_cidera
		//    ');
		// 	$this->db->from('irms');
		// 	$this->db->where('dasi_id', $dasi_id);
		// 	$this->db->join('dasi', 'soundex(trim(lower(replace(substring_index(irms.nama_korban, "(", 1), "(", "")))) = soundex(trim(lower(replace(substring_index(dasi.nama_korban, "(", 1), "(", "")))) and irms.no_lp = dasi.no_lp', 'right');
		// 	$right_join = $this->db->get();

		// 	// menggabungkan hasil query dari kedua tabel
		// 	$result = array_merge($left_join->result_array(), $right_join->result_array());

		// 	// menghapus duplikasi data
		// 	$unique = array();
		// 	foreach ($result as $row) {
		// 		$unique[$row['irms_no_lp']] = $row;
		// 	}

		// 	// menampilkan hasil
		// 	$result = array_values($unique);

		// 	return $result;
	}

	public function delete($table, $nama_id, $id)
	{
		$this->db->where($nama_id, $id);
		$this->db->delete($table);
	}




	public function count_md_irms($id)
	{
		$sql = ("SELECT * FROM irms WHERE irms_id = ? AND (cidera = 'MD' OR cidera = 'MD-LL');");
		$query = $this->db->query($sql, array($id));
		$result = $query->num_rows();
		return $result;
	}

	public function count_md_dasi($id)
	{


		$sql = ("SELECT * FROM dasi WHERE dasi_id = ? AND (cidera = 'MD' OR cidera = 'MD-LL');");
		$query = $this->db->query($sql, array($id));
		$result = $query->num_rows();
		return $result;
	}


	public function count_ll_irms($id)
	{
		$this->db->select('*');
		$this->db->from('irms');
		$this->db->where('irms_id', $id);
		$this->db->where('cidera', 'LL');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_ll_dasi($id)
	{
		$this->db->select('*');
		$this->db->from('dasi');
		$this->db->where('dasi_id', $id);
		$this->db->where('cidera', 'LL');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function levenstein_stor($nama_korban, $nama_korban2)
	{
		$nama_korban = strtolower($nama_korban);
		$nama_korban2 = strtolower($nama_korban2);
		$nama_korban = str_replace('(', '', $nama_korban);
		$nama_korban2 = str_replace('(', '', $nama_korban2);
		$nama_korban = str_replace(')', '', $nama_korban);
		$nama_korban2 = str_replace(')', '', $nama_korban2);
		$nama_korban = str_replace(' ', '', $nama_korban);
		$nama_korban2 = str_replace(' ', '', $nama_korban2);
		$nama_korban = str_replace('-', '', $nama_korban);
		$nama_korban2 = str_replace('-', '', $nama_korban2);
		$nama_korban = str_replace('.', '', $nama_korban);
		$nama_korban2 = str_replace('.', '', $nama_korban2);
		$nama_korban = str_replace(',', '', $nama_korban);
		$nama_korban2 = str_replace(',', '', $nama_korban2);
		$nama_korban = str_replace('\'', '', $nama_korban);
		$nama_korban2 = str_replace('\'', '', $nama_korban2);
		$nama_korban = str_replace('’', '', $nama_korban);
		$nama_korban2 = str_replace('’', '', $nama_korban2);
		$nama_korban = str_replace('’', '', $nama_korban);
		$nama_korban2 = str_replace('’', '', $nama_korban2);
		$nama_korban = str_replace('’', '', $nama_korban);
		$nama_korban2 = str_replace('’', '', $nama_korban2);
		$nama_korban = str_replace('’', '', $nama_korban);
		$nama_korban2 = str_replace('’', '', $nama_korban2);
		return levenshtein($nama_korban, $nama_korban2);
	}

	public function get_data_irms($id)
	{
		$this->db->select(
			'
		 irms.no_lp as irms_no_lp, irms.tanggal as irms_tanggal, irms.nama_korban as irms_nama_korban, irms.cidera as irms_cidera'
		);
		$this->db->from('irms');
		$this->db->where('irms_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_dasi($id)
	{
		$this->db->select(
			'
		 dasi.no_lp as dasi_no_lp, dasi.tanggal as dasi_tanggal, dasi.nama_korban as dasi_nama_korban, dasi.cidera as dasi_cidera'
		);
		$this->db->from('dasi');
		$this->db->where('dasi_id', $id);
		$query = $this->db->get();
		return $query->result();
	}
}
