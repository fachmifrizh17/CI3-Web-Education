<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histori_baca_model extends CI_Model
{
    function get_read_aktif()
    {
        return $this->db->get_where("view_baca", ["aktif" => true])->result();
    }

    function get_read_by_kode($kode = "", $username="")
    {
        return $this->db->query("SELECT 
        b.*,
        l.username
        from stpm_baca b
        left JOIN glbm_login l on l.username = b.namasiswa
        WHERE b.aktif ='true'
        and l.username = '$username'
        and b.kode ='$kode'")->result();
    }
}
