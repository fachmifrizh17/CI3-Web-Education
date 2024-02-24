<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku_model extends CI_Model
{
    function get_buku_aktif()
    {
        return $this->db->get_where("glbm_buku", ["aktif" => true])->result();
    }

    function get_buku_by_kode($nama = "")
    {
        return $this->db->get_where("glbm_buku", ["nama" => $nama])->row();
    }

    function CekKode($kode = "")
	{
		return $this->db->query("SELECT *FROM glbm_buku WHERE kode = '" . $kode . "'")->result();
	}
	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,4)",$kode);
        return $this->db->get("glbm_buku")->row();
    }
}
