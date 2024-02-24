<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapping_guru_model extends CI_Model
{
    function get_mapping_guru_aktif()
    {
        return $this->db->get_where("glbm_mapping_guru", ["aktif" => true])->result();
    }

    function get_mapping_guru_by_kode($namakelas = "")
    {
        return $this->db->get_where("glbm_mapping_guru", ["namakelas" => $namakelas])->row();
    }

    function CekKode($kode = "")
	{
		return $this->db->query("SELECT *FROM glbm_mapping_guru WHERE kode = '" . $kode . "'")->result();
	}
	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,2)",$kode);
        return $this->db->get("glbm_mapping_guru")->row();
    }
}
