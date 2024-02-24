<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auto_read extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('caridataaktif_model');
        $this->load->model('read/Auto_read_model');
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
            "recordsTotal"      => $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"   => $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"              => $data
        );
        echo json_encode($output);
    }

    function carimenu()
    {
        $fetch_data = $this->caridataaktif_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $key => $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $msearch = $row->$value;
                        $sub_array[] = '<input type="checkbox" id="' . $msearch . '"/>';
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
            "draw"               => intval($_POST["draw"]),
            "recordsTotal"       => $this->caridataaktif_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"    => $this->caridataaktif_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"               => $data
        );
        echo json_encode($output);
    }

    public function get_data()
    {
        $this->_cek_login();
        $kode = $this->input->post('kode');
        if ($kode) {
            $data_generate = $this->Auto_read_model->get_read_by_kode($kode);

            $data = [
                "kode"  => $data_generate->kode,
                "tanggal"  => $data_generate->tanggal,
                "kodebuku"  => $data_generate->kodebuku,
                "name"  => $data_generate->name,
                "bab"  => $data_generate->bab,
                "penerbit"  => $data_generate->penerbit,
                "status_baca"  => $data_generate->status_baca,
                "kodesiswa"  => $data_generate->kodesiswa,
                "tglsimpan"  => $data_generate->tglsimpan,
                "pemakai"  => $data_generate->pemakai,
                "aktif"  => $data_generate->aktif,
                "note"  => $data_generate->note,
                "jambaca"  => $data_generate->jambaca,
            ];

            echo json_encode($data);
        } else {
            echo json_encode(["success" => false, "msg" => "Data tidak ditemukan"]);
        }
    }

    public function tambah()
    {
        $this->_cek_login();
        $kodekelas = $this->input->post('kodekelas');
        $kode = $this->input->post('kode');
        $datadetail = $this->input->post('datadetail');
        $CekKode = $this->Auto_read_model->CekKode($kode);
        $data_siswa = $this->Auto_read_model->get_read_by_kode($kode);

        if (empty($CekKode)) {
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            $ambilnomor = "GENE" . $data_siswa;
            $get["kode"] = $this->Auto_read_model->GetMaxNomor($ambilnomor);
            if (!$get["kode"]) {
                $kode = "000001";
            } else {
                $lastNomor = $get['kode']->kode;
                $lastNoUrut = substr($lastNomor, 7, 13);

                // nomor urut ditambah 1
                $nextNoUrut = $lastNoUrut + 1;
                $kode = $ambilnomor . sprintf('%06s', $nextNoUrut);
            }
            // print_r($datadetail);
            // die('ok');
            if (!empty($datadetail)) {

                foreach ($datadetail as $key => $value) {

                    $datadetailitem = [
                        'kode' => $kode,
                        'tanggal' => $value['tanggalmulaibaca'],
                        'kodebuku' =>  $value['kode'],
                        'nama' =>  $value['namabuku'],
                        'bab' => $value['bacaharian'],
                        'penerbit' =>  $value['penerbit'],
                        'emailsiswa' =>  $value['emailsiswa'],
                        'emailsiswa' =>  $value['emailsiswa'],
                        'namasiswa' =>  $value['namasiswa'],
                        'tglsimpan' => date("Y-m-d H:i:s"),
                        'status_baca' => false,
                        'pemakai' => $this->session->userdata("myusername"),
                        'aktif' => TRUE
                    ];
                    $this->Auto_read_model->SaveDataDetail($datadetailitem);
                }

                $data = [
                    'kode' => $kode,
                    'kodekelas' => $kodekelas,
                    'namakelas' => $this->input->post("namakelas"),
                    'tglsimpan' => date("Y-m-d H:i:s"),
                    'pemakai' => $this->session->userdata("myusername"),
                    'aktif' => TRUE
                ];
                $this->Auto_read_model->SaveData($data);
            }
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["success" => false, "msg" => "Terjadi kesalahan"]);
                $this->db->trans_rollback();
            } else {
                echo json_encode(["success" => true, "msg" => "Data berhasil ditambah"]);
                $this->db->trans_commit();
            }
        }
    }
}