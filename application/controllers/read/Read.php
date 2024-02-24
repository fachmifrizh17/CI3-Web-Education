<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Read extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('caridataaktif_model');
        $this->load->model('read/Read_model');
        $this->load->library('session');
    }

    private function _cek_login()
    {
        if (!$this->session->has_userdata('myusername')) {
            redirect('auth/login');
        }
    }

    public function data()
    {
        $this->_cek_login();

        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $kode = 0;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $kode = $row->$value;
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                        } else {
                            $sub_array[] = $row->$value;
                        }
                    }
                }
                $i++;
            }
            $data[] = $sub_array;
        }
        $output = array(
            "draw"              => intval($_POST["draw"]),
            "recordsTotal"      => $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"   => $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"              => $data
        );
        echo json_encode($output);
    }

    public function search()
    {
        $this->_cek_login();

        $fetch_data = $this->Caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $kode = 0;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $kode = $row->$value;
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                            $sub_array[] = '<input type="checkbox" kode="' . $kode . '"/>';
                        } else {
                            $sub_array[] = $row->$value;
                        }
                    }
                }
                $i++;
            }
            $data[] = $sub_array;
        }
        $output = array(
            "draw"              => intval($_POST["draw"]),
            "recordsTotal"      => $this->Caridataaktif_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"   => $this->Caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"              => $data
        );
        echo json_encode($output);
    }

    function load_data()
    {
        $data = $this->Read_model->load_data();
        echo json_encode($data); // ubah array jadi json
    }

    public function get_data()
    {
        $this->_cek_login();
        $kode = $this->input->post('kode');
        if ($kode) {
            $data_siswa = $this->Read_model->get_read_by_kode($kode);

            $data = [
                "kode"          => $data_siswa->kode,
                "tanggal"       => $data_siswa->tanggal,
                "bab"           => $data_siswa->bab,
                "namasiswa"     => $data_siswa->namasiswa,
                "nama"          => $data_siswa->nama,
                "tglsimpan"     => $data_siswa->tglsimpan,
                "pemakai"       => $data_siswa->pemakai,
                "aktif"         => $data_siswa->aktif,
                "status_baca"   => $data_siswa->status_baca,
                "note"          => $data_siswa->note,
            ];

            echo json_encode($data);
        } else {
            echo json_encode(["success" => false, "msg" => "Data tidak ditemukan"]);
        }
    }

    public function update()
    {   
        $this->_cek_login();
        $nama = $this->input->post('nama');

        $data = [
            "selesaibaca"   => $this->input->post("selesaibaca"),
            "note"          => $this->input->post("note"),
            "status_baca"   => true,
            "tglsimpan"     => date("Y-m-d H:i:s"),
            "pemakai"       => $this->session->userdata("myusername"),
        ];
        $this->db->where("tanggal", date("Y-m-d"));
        $this->db->where("nama", $nama);
        $this->db->update("stpm_generatedetail", $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            echo json_encode(["success" => false, "msg" => "Gagal Mem-Baca !!!"]);
            $this->db->trans_rollback();
        } else {
            echo json_encode(["success" => true, "msg" => "Terima Kasih Sudah Membaca"]);
            $this->db->trans_commit();
        }
    }
}
