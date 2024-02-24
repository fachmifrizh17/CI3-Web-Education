<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapping_siswa_model extends CI_Model
{
    function get_mapping_aktif()
    {
        return $this->db->get_where("glbm_mapping_siswa", ["aktif" => true])->result();
    }

    function get_mapping_by_kode($namasiswa = "")
    {
        return $this->db->get_where("glbm_mapping_siswa", ["namasiswa" => $namasiswa])->row();
    }

    function CekKode($kode = "")
	{
		return $this->db->query("SELECT *FROM glbm_mapping_siswa WHERE kode = '" . $kode . "'")->result();
	}
	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,2)",$kode);
        return $this->db->get("glbm_mapping_siswa")->row();
    }
}
