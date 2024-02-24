<?php

class Laporan_model extends CI_Model
{
    function GetDataSiswa()
    {
        return $this->db->get("rpt_siswa")->result();
    }

    function GetDataGuru()
    {
        return $this->db->get("rpt_guru")->result();
    }
    
    function GetMappingGuru()
    {
        return $this->db->get("rpt_mapping_guru")->result();
    }
    
    function GetMappingSiswa()
    {
        return $this->db->get("rpt_mapping_siswa")->result();
    }
    
    function GetDataBuku()
    {
        return $this->db->get("rpt_buku")->result();
    }

    function GetDataHistoriBaca()
    {
        return $this->db->get("rpt_baca")->result();
    }
}
