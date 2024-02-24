<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ubah_data_model extends CI_Model
{
    function get_read_aktif()
    {
        return $this->db->get_where("stpm_generate", ["aktif" => true])->result();
    }

    function get_read_by_kode($kode = "")
    {
        return $this->db->get_where("stpm_generatedetail", ["kode" => $kode])->row();
    }

    function CekKode($kode = "")
    {
        return $this->db->query("SELECT *FROM stpm_generate WHERE kode = '" . $kode . "'")->result();
    }

    function check_status_baca($kode = "")
    {
        return $this->db->get_where("stpm_generatedetail", ["kode" => $kode, "status_baca" => true])->row();
    }

    public function GetMaxNomor($kode = "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,4)", $kode);
        return $this->db->get("stpm_generate")->row();
    }

    function SaveDataDetail($data = "")
	{
		return $this->db->insert('stpm_generatedetail', $data);
	}
}
