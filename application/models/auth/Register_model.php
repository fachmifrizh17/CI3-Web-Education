<?php

class Register_model extends CI_Model
{

	function DataKode()
	{
		return $this->db->query("SELECT * FROM glbm_kodecabang ORDER BY kode")->result();
	}

	function Username_exists($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('stpm_user');

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	function SaveData($id = "")
	{
		return $this->db->insert('stpm_user', $id);
	}

	function UpdateData($data = "", $id = "")
	{
		$this->db->where('id', $id);
		return $this->db->update('glbm_tipe', $data);
	}
}
