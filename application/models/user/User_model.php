<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

	public function get_user_detail_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_profile($data, $id)
	{
		$this->db->where('user_id', $id);
		$this->db->update('user', $data);
	}

	public function count_total_user()
	{
		$this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_all_user()
	{
		$this->db->select('*');
		$this->db->from('user');
		$query = $this->db->get();
		return $query->result();
	}
}
