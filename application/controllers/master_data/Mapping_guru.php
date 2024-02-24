<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapping_guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        // $this->load->model('caridataaktif_model');
        $this->load->model('Caridata_model');
        $this->load->model('master_data/Mapping_guru_model');
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

        $fetch_data = $this->Caridata_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $namakelas = 0;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $namakelas = $row->$value;
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                            $sub_array[] = '
                            <a href="javascript:status(\'' . $namakelas . '\')" class="btn btn-xs btn-success" title="Ubah Status"><i class="ti-power-off mx-2"></i></a>';
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
            "recordsTotal"      => $this->Caridata_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"   => $this->Caridata_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
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
            $id = 0;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $id = $row->$value;
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                            $sub_array[] = '<a href="javascript:pilihguru(\'' . $id . '\')" class="btn btn-sm btn-danger" title="Pilih">Pilih <i class="ti-arrow-circle-right"></i></a>';
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

        $namakelas = $this->input->post('namakelas');

        if ($namakelas) {
            $guru = $this->Mapping_guru_model->get_mapping_guru_by_kode($namakelas);

            $data = [
                "kode"  => $guru->kode,
                "kodekelas"  => $guru->kodekelas,
                "namakelas"  => $guru->namakelas,
                "kodeguru"  => $guru->kodeguru,
                "email"  => $guru->email,
                "namaguru"  => $guru->namaguru,
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
        $email = $this->input->post('email');
		$CekKode = $this->Mapping_guru_model->CekKode($kode);
        $data_mapping_guru = $this->Mapping_guru_model->get_mapping_guru_by_kode($kode);

        if (empty($CekKode)) {
			$this->db->trans_start();
			$this->db->trans_strict(FALSE);
			$ambilnomor = "MG". $data_mapping_guru;
			$get["kode"] = $this->Mapping_guru_model->GetMaxNomor($ambilnomor);
			if (!$get["kode"]) {
				$kode = "000001";
			} else {
				$lastNomor = $get['kode']->kode;
				$lastNoUrut = substr($lastNomor, 7,13);

				// nomor urut ditambah 1
				$nextNoUrut = $lastNoUrut + 1;
				$kode = $ambilnomor . sprintf('%06s', $nextNoUrut);;
				// print_r($kode);
				// die();
			}
            $data = [
                "kode"          => $kode,
                "kodekelas"          => $this->input->post("kodekelas"),
                "namakelas"          => $this->input->post("namakelas"),
                "kodeguru"          => $this->input->post("kodeguru"),
                "email"          => $this->input->post("email"),
                "namaguru"          => $this->input->post("namaguru"),
                "aktif"         => true,
                "tglsimpan"     => date("Y-m-d H:i:s"),
                "pemakai"    => $this->session->userdata("myusername")
            ];
            $this->db->insert('glbm_mapping_guru', $data);
            
            $datas = [
                "kodekelas"          => $this->input->post("kodekelas")
            ];

            $this->db->where("email", $email);
            $this->db->update('glbm_login', $datas);

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

    public function status()
    {
        $this->_cek_login();

        $namakelas = $this->input->post("namakelas");
        $data_siswa = $this->Mapping_guru_model->get_mapping_guru_by_kode($namakelas);

        if ($data_siswa != null) {
            if ($data_siswa->aktif == "t") {
                $aktif = false;
            } else {
                $aktif = true;
            }

            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $data = [
                "aktif" => $aktif,
            ];

            $this->db->update('glbm_mapping_guru', $data, ["namakelas" => $namakelas]);

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
