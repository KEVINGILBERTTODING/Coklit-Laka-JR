<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Excel_model extends CI_Model
{


	public function get_setting($table)
	{
		$this->db->select('*');
		$this->db->from($table);
		return $this->db->get()->result();
	}

	public function update_data_batch($data, $id, $table)
	{
		$this->db->update_batch($table, $data, $id);
	}

	public function get_setting_excel_by_id($table, $id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('id', $id);
		return $this->db->get()->row_array();
	}
}
