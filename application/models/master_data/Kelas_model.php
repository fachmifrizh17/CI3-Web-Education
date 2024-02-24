<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    function get_kelas_aktif()
    {
        return $this->db->get_where("glbm_kelas", ["aktif" => true])->result();
    }

    function get_kelas_by_kode($nama = "")
    {
        return $this->db->get_where("glbm_kelas", ["nama" => $nama])->row();
    }

    function CekKode($kode = "")
	{
		return $this->db->query("SELECT *FROM glbm_kelas WHERE kode = '" . $kode . "'")->result();
	}
	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,3)",$kode);
        return $this->db->get("glbm_kelas")->row();
    }
}
