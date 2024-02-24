<?php

class Login_model extends CI_Model
{
	function login($email = "", $password = "")
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$this->db->where('aktif', true);
		return $this->db->get("glbm_login")->row();
	}

	function mapping_departemen($kodekelas = "")
	{
		return $this->db->query("SELECT
		k.kode,
		k.nama as namakelas,
		g.namaguru
		from glbm_kelas k
		LEFT JOIN glbm_mapping_guru g on g.kodekelas = k.kode
					WHERE kodekelas = '" . $kodekelas . "' AND d.aktif = TRUE")->result();
	}
}
