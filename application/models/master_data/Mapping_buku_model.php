<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapping_buku_model extends CI_Model
{
    function get_kelas_aktif()
    {
        return $this->db->get_where("glbm_mapping_buku", ["aktif" => true])->result();
    }

    function get_mapping_buku($kode = "")
    {
        return $this->db->get_where("glbm_mapping_buku", ["kode" => $kode])->row();
    }

    function CekKode($kode = "")
	{
		return $this->db->query("SELECT *FROM glbm_mapping_buku WHERE kode = '" . $kode . "'")->result();
	}
	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,2)",$kode);
        return $this->db->get("glbm_mapping_buku")->row();
    }
}
