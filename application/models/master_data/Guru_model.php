<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    function get_guru_aktif()
    {
        return $this->db->get_where("glbm_guru", ["aktif" => true])->result();
    }

    function get_guru_by_kode($email = "")
    {
        return $this->db->get_where("glbm_guru", ["email" => $email])->row();
    }

    function CekKode($kode = "")
	{
		return $this->db->query("SELECT *FROM glbm_guru WHERE kode = '" . $kode . "'")->result();
	}
	public function GetMaxNomor($kode= "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,4)",$kode);
        return $this->db->get("glbm_guru")->row();
    }
}
