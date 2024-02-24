<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auto_read_model extends CI_Model
{
    function get_read_aktif()
    {
        return $this->db->get_where("stpm_generate", ["aktif" => true])->result();
    }

    function get_read_by_kode($kode = "")
    {
        return $this->db->get_where("stpm_generate", ["kode" => $kode])->row();
    }

    function CekKode($kode = "")
    {
        return $this->db->query("SELECT *FROM stpm_generate WHERE kode = '" . $kode . "'")->result();
    }

    public function GetMaxNomor($kode = "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,4)", $kode);
        return $this->db->get("stpm_generate")->row();
    }

    function SaveData($data = "")
	{
		return $this->db->insert('stpm_generate', $data);
	}

    function SaveDataDetail($data = "")
	{
		return $this->db->insert('stpm_generatedetail', $data);
	}
}
