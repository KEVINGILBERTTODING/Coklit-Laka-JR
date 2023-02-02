<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Excel_model extends CI_Model
{


	public function get_setting_by_id($table, $id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_setting($table, $data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	}
}
