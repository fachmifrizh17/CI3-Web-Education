<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    function get_siswa_aktif()
    {
        return $this->db->get_where("glbm_siswa", ["aktif" => true])->result();
    }

    function get_siswa_by_kode($email = "")
    {
        return $this->db->get_where("glbm_siswa", ["email" => $email])->row();
    }

    function CekKode($kode = "")
	{
		return $this->db->query("SELECT *FROM glbm_siswa WHERE kode = '" . $kode . "'")->result();
	}
	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,2)",$kode);
        return $this->db->get("glbm_siswa")->row();
    }
}
