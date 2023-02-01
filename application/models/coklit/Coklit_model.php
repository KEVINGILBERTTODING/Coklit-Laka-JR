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
}
