<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Read_model extends CI_Model
{
    function get_read_aktif()
    {
        return $this->db->get_where("stpm_generatedetail", ["aktif" => true])->result();
    }

    function get_read_by_kode($kode = "")
    {
        return $this->db->get_where("stpm_generatedetail", ["kode" => $kode])->row();
    }

    function CekKode($kode = "")
    {
        return $this->db->query("SELECT *FROM stpm_generatedetail WHERE kode = '" . $kode . "'")->result();
    }
    public function GetMaxNomor($kode = "")
    {
        $this->db->select_max('kode');
        $this->db->where("left(kode,4)", $kode);
        return $this->db->get("stpm_generatedetail")->row();
    }
    function load_data()
    {
        $this->db->order_by('kode', 'DESC');
        $query = $this->db->get('stpm_generatedetail');
        return $query->result_array();
    }
}
