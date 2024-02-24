<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('caridataaktif_model');
        $this->load->model('master_data/Guru_model');
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
            $email = 0;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $email = $row->$value;
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                            $sub_array[] = '<a href="javascript:edit(\'' . $email . '\')" class="btn btn-xs btn-danger" title="Edit"><i class="ti-pencil mx-2"></i></a>
                            <a href="javascript:status(\'' . $email . '\')" class="btn btn-xs btn-success" title="Ubah Status"><i class="ti-power-off mx-2"></i></a>';
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
                            $sub_array[] = '<a href="javascript:pilihguru(\'' . $kode . '\')" class="btn btn-sm btn-danger" title="Pilih">Pilih <i class="ti-arrow-circle-right"></i></a>';
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

    public function get_data()
    {
        $this->_cek_login();

        $email = $this->input->post('email');

        if ($email) {
            $guru = $this->Guru_model->get_guru_by_kode($email);

            $data = [
                "kode"      => $guru->kode,
                "email"     => $guru->email,
                "nama"      => $guru->nama,
                "jenkel"    => $guru->jenkel,
                "grup"      => $guru->grup,
                "namagrup"  => $guru->namagrup,
                "usia"      => $guru->usia,
                "alamat"    => $guru->alamat,
                "image"     => $guru->image,
            ];

            echo json_encode($data);
        } else {
            echo json_encode(["success" => false, "msg" => "Data tidak ditemukan"]);
        }
    }

    public function tambah()
    {
        $this->_cek_login();
        $kode = $this->input->post('kode');
        $CekKode = $this->Guru_model->CekKode($kode);
        $data_guru = $this->Guru_model->get_guru_by_kode($kode);

        if ($this->input->method() === 'post') {
            // the user id contain dot, so we must remove it
            $config['upload_path'] = './assets/img/foto/';
            $config['file_name'] = "foto_guru_" . date("YmdHis");
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['overwrite']            = true;
            $config['max_size']             = 1024; // 1MB
            $config['max_width']            = 1080;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $uploaded_data = $this->upload->data();
                if (empty($CekKode)) {
                    $this->db->trans_start();
                    $this->db->trans_strict(FALSE);
                    $ambilnomor = "GURU" . $data_guru;
                    $get["kode"] = $this->Guru_model->GetMaxNomor($ambilnomor);
                    if (!$get["kode"]) {
                        $kode = "000001";
                    } else {
                        $lastNomor = $get['kode']->kode;
                        $lastNoUrut = substr($lastNomor, 7, 13);

                        // nomor urut ditambah 1
                        $nextNoUrut = $lastNoUrut + 1;
                        $kode = $ambilnomor . sprintf('%06s', $nextNoUrut);;
                        // print_r($kode);
                        // die();
                    }
                    $data = [
                        "kode"             => $kode,
                        "email"            => $this->input->post("email"),
                        "nama"             => $this->input->post("nama"),
                        "jenkel"           => $this->input->post("jenkel"),
                        "usia"             => $this->input->post("usia"),
                        "namagrup"         => $this->input->post("namagrup"),
                        "alamat"           => $this->input->post("alamat"),
                        "grup"             => $this->input->post("grup"),
                        "image"            => $uploaded_data["file_name"],
                        "aktif"            => FALSE,
                        "tglsimpan"        => date("Y-m-d H:i:s"),
                        "pemakai"          => $this->session->userdata("myusername"),
                        "password"        => base64_encode('1')
                    ];

                    $datas = [

                        "email"           => $this->input->post("email"),
                        "password"        =>  base64_encode('1'),
                        "kodekelas"       => 'KLS000001',
                        "aktif"           => TRUE,
                        "tglsimpan"       =>  date("Y-m-d H:i:s"),
                        "usersimpan"      => 'admin',
                        "roleid"          => $this->input->post("grup"),
                        "image"           => $uploaded_data["file_name"],
                        "nama"            =>  $this->input->post("nama")
                    ];

                    $this->db->insert('glbm_guru', $data);
                    $this->db->insert('glbm_login', $datas);
                    $this->db->trans_complete();

                    if ($this->db->trans_status() === FALSE) {
                        echo json_encode(["success" => false, "msg" => "Terjadi kesalahan"]);
                        $this->db->trans_rollback();
                    } else {
                        echo json_encode(["success" => true, "msg" => "Data berhasil ditambah"]);
                        $this->db->trans_commit();
                    }
                } else {
                    echo json_encode(["success" => false, "msg" => "Data tidak ditemukan"]);
                }
            }
        }
        // print_r($datas);
        // die('ok');
    }


    public function update()
    {
        $this->_cek_login();

        $email = $this->input->post("email");
        $data_user = $this->Guru_model->get_guru_by_kode($email);
        if ($this->input->method() === 'post') {
            // the user id contain dot, so we must remove it
            $config['upload_path'] = './assets/img/foto/';
            $config['file_name'] = "foto_siswa_" . date("YmdHis");
            $config['allowed_types']        = 'gif|jpg|jpeg|png';
            $config['overwrite']            = true;
            $config['max_size']             = 1024; // 1MB
            $config['max_width']            = 1080;
            $config['max_height']           = 1080;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $uploaded_data = $this->upload->data();
                if ($data_user != null) {
                    $this->db->trans_start();
                    $this->db->trans_strict(FALSE);

                    $data = [
                        // "kode"        => $kode,
                        "email"          => $this->input->post("email"),
                        "nama"           => $this->input->post("nama"),
                        "jenkel"         => $this->input->post("jenkel"),
                        "usia"           => $this->input->post("usia"),
                        "alamat"         => $this->input->post("alamat"),
                        "namagrup"       => $this->input->post("namagrup"),
                        "image"         => $uploaded_data["file_name"],
                        "aktif"          => true,
                        "tglsimpan"      => date("Y-m-d H:i:s"),
                        "pemakai"        => $this->session->userdata("myusername")
                    ];

                    $datas = [

                        "email"          => $this->input->post("email"),
                        "password"          =>  base64_encode('1'),
                        "kodekelas"          => 'KLS000001',
                        "aktif"          => TRUE,
                        "tglsimpan"       =>  date("Y-m-d H:i:s"),
                        "usersimpan"         => 'admin',
                        "roleid"     => '3',
                        "image"         => $uploaded_data["file_name"],
                        "nama"    =>  $this->input->post("nama")
                    ];

                    $this->db->update('glbm_guru', $data, ["email" => $email]);
                    $this->db->update('glbm_login', $datas, ["email" => $email]);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === FALSE) {
                        echo json_encode(["success" => false, "msg" => "Terjadi kesalahan"]);
                        $this->db->trans_rollback();
                    } else {
                        echo json_encode(["success" => true, "msg" => "Data berhasil diubah"]);
                        $this->db->trans_commit();
                    }
                } else {
                    echo json_encode(["success" => false, "msg" => "Data tidak ditemukan"]);
                }
            }
        }
    }

    public function status()
    {
        $this->_cek_login();

        $email = $this->input->post("email");
        $data_guru = $this->Guru_model->get_guru_by_kode($email);

        if ($data_guru != null) {
            if ($data_guru->aktif == "t") {
                $aktif = false;
            } else {
                $aktif = true;
            }

            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $data = [
                "aktif" => $aktif,
            ];

            $this->db->update('glbm_guru', $data, ["email" => $email]);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["success" => false, "msg" => "Terjadi kesalahan"]);
                $this->db->trans_rollback();
            } else {
                echo json_encode(["success" => true, "msg" => "Status berhasil diubah"]);
                $this->db->trans_commit();
            }
        } else {
            echo json_encode(["success" => false, "msg" => "Data tidak ditemukan"]);
        }
    }
}
