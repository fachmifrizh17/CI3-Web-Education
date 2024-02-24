<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('caridataaktif_model');
        $this->load->model('master_data/Buku_model');
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
            $nama = 0;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $nama = $row->$value;
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                            $sub_array[] = '<a href="javascript:edit(\'' . $nama . '\')" class="btn btn-xs btn-danger" title="Edit"><i class="ti-pencil mx-2"></i></a>
                            <a href="javascript:status(\'' . $nama . '\')" class="btn btn-xs btn-success" title="Ubah Status"><i class="ti-power-off mx-2"></i></a>';
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
                            $sub_array[] = '<a href="javascript:pilihkelas(\'' . $kode . '\')" class="btn btn-sm btn-danger" title="Pilih">Pilih <i class="ti-arrow-circle-right"></i></a>';
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

        $nama = $this->input->post('nama');

        if ($nama) {
            $kelas = $this->Buku_model->get_buku_by_kode($nama);

            $data = [
                "kode"  => $kelas->kode,
                "nama"  => $kelas->nama,
                "penerbit"  => $kelas->penerbit,
                "bab"  => $kelas->bab,
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
		$CekKode = $this->Buku_model->CekKode($kode);
        $data_siswa = $this->Buku_model->get_buku_by_kode($kode);

        if (empty($CekKode)) {
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);
            $ambilnomor = "BUKU". $data_siswa;
			$get["kode"] = $this->Buku_model->GetMaxNomor($ambilnomor);
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
                "nama"          => $this->input->post("nama"),
                "penerbit"          => $this->input->post("penerbit"),
                "bab"          => $this->input->post("bab"),
                "aktif"         => true,
                "tglsimpan"     => date("Y-m-d H:i:s"),
                "pemakai"    => $this->session->userdata("myusername")
            ];

            $this->db->insert('glbm_buku', $data);

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

    public function update()
    {
        $this->_cek_login();

        $nama = $this->input->post("nama");
        $data_user = $this->Buku_model->get_buku_by_kode($nama);

        if ($data_user != null) {
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $data = [
                // "kode"          => $kode,
                "nama"          => $this->input->post("nama"),
                "penerbit"          => $this->input->post("penerbit"),
                "bab"          => $this->input->post("bab"),
                "aktif"         => true,
                "tglsimpan"     => date("Y-m-d H:i:s"),
                "pemakai"    => $this->session->userdata("myusername")
            ];

            $this->db->update('glbm_buku', $data, ["nama" => $nama]);

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["success" => false, "msg" => "Terjadi kesalahan"]);
                $this->db->trans_rollback();
            } else {
                echo json_encode(["success" => true, "msg" => "Data berhasil diperbarui"]);
                $this->db->trans_commit();
            }
        } else {
            echo json_encode(["success" => false, "msg" => "Data tidak ditemukan"]);
        }
    }

    public function status()
    {
        $this->_cek_login();

        $nama = $this->input->post("nama");
        $data_kelas = $this->Buku_model->get_buku_by_kode($nama);

        if ($data_kelas != null) {
            if ($data_kelas->aktif == "t") {
                $aktif = false;
            } else {
                $aktif = true;
            }

            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $data = [
                "aktif" => $aktif,
            ];

            $this->db->update('glbm_buku', $data, ["nama" => $nama]);

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
