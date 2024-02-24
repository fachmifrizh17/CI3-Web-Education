<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('caridataaktif_model');
        $this->load->model('master_data/user_model');
        $this->load->model('master_data/Siswa_model');
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
                            $sub_array[] = '<a href="javascript:edit(\'' . $id . '\')" class="btn btn-xs btn-danger" title="Edit"><i class="ti-pencil mx-2"></i></a>
                            <a href="javascript:status(\'' . $id . '\')" class="btn btn-xs btn-success" title="Ubah Status"><i class="ti-power-off mx-2"></i></a>';
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
            $user = $this->user_model->get_user_by_username($email);

            $data = [
                "email"      => $user->email,
                "password"      => base64_decode($user->password),
                "kodecabang"    => $user->kodecabang,
                "kodecompany"   => $user->kodecompany,
                "image"         => $user->image,
            ];

            echo json_encode($data);
        } else {
            echo json_encode(["success" => false, "msg" => "Data tidak ditemukan"]);
        }
    }

    public function tambah()
    {
        $this->_cek_login();

        $email = $this->input->post("email");
        $data_user = $this->user_model->get_user_by_username($email);
        $config['upload_path'] = './assets/img/fotosiswa/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['file_name'] = "foto_" . date("YmdHis");
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        $config['max_width']            = 1080;
        $config['max_height']           = 1080;

        $this->load->library('upload', $config);

        // lakukan upload
        if (!$this->upload->do_upload('image')) {
            // saat gagal, tampilkan pesan error
            $data['error'] = $this->upload->display_errors();
        } else {
            // saat berhasil ambil datanya
            $uploaded_data = $this->upload->data();

        if ($data_user == null) {
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $data = [
                "email"          => $email,
                "password"          => base64_encode($this->input->post("password")),
                "kodecabang"        => $this->input->post("kodecabang"),
                "kodecompany"       => $this->input->post("kodecompany"),
                "roleid"       => $this->input->post("roleid"),
                'image' => $uploaded_data['file_name'],
                "aktif"             => true,
                "tglsimpan"         => date("Y-m-d H:i:s"),
                "usersimpan"        => $this->session->userdata("myusername")
            ];

            $this->db->insert('glbm_login', $data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["success" => false, "msg" => "Terjadi kesalahan"]);
                $this->db->trans_rollback();
                $this->_unlinkimg($email);
            } else {
                echo json_encode(["success" => true, "msg" => "Data berhasil ditambahkan"]);
                $this->db->trans_commit();
            }
        } else {
            echo json_encode(["success" => false, "msg" => "email telah terdaftar"]);
        }
    }}

    private function _unlinkimg($email)
	{
		$host = $this->Guru_model->get_user_by_username($email);
		if (file_exists("assets/img/fotosiswa/" . $host->image)) {
			unlink("assets/img/fotosiswa/" . $host->image);
		} else {
			echo json_encode(["success" => true, "msg" => "Gambar tidak ditemukan"]);
		}
	}

    public function update()
    {
        $this->_cek_login();

        $email = $this->input->post("email");
        $data_user = $this->user_model->get_kelas_by_kode($kode);

        if ($data_user != null) {
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $data = [
                "email"          => $email,
                "password"          => base64_encode($this->input->post("password")),
                "kodecabang"        => $this->input->post("kodecabang"),
                "kodecompany"       => $this->input->post("kodecompany"),
                "tglsimpan"         => date("Y-m-d H:i:s"),
                "usersimpan"        => $this->session->userdata("myusername")
            ];

            $this->db->update('glbm_login', $data, ["email" => $email]);

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

        $email = $this->input->post("email");
        $data_user = $this->user_model->get_user_by_username($email);

        if ($data_user != null) {
            if ($data_user->aktif == "t") {
                $aktif = false;
            } else {
                $aktif = true;
            }

            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $data = [
                "aktif" => $aktif,
            ];

            $this->db->update('glbm_login', $data, ["email" => $email]);

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

    public function cek_password_lama()
    {
        $this->_cek_login();

        $passwordlama = $this->input->post("passwordlama");
        $email = $this->session->userdata("myusername");
        $data_user = $this->user_model->get_user_by_username($email);

        if ($data_user->password == base64_encode($passwordlama)) {
            echo json_encode(["success" => true, "msg" => "Password cocok"]);
        } else {
            echo json_encode(["success" => false, "msg" => "Password tak cocok"]);
        }
    }

    public function ubah_password()
    {
        $this->_cek_login();

        $passwordlama = $this->input->post("passwordlama");
        $email = $this->session->userdata("myusername");
        $data_user = $this->user_model->get_user_by_username($email);
        $data_user = $this->Siswa_model->get_siswa_by_kode($email);
        $data_user = $this->Guru_model->get_guru_by_kode($email);

        if ($data_user->password != base64_encode($passwordlama)) {
            // echo json_encode(["success" => false, "msg" => "Password lama salah"]);
            echo json_encode(["success" => false, "msg" => $data_user->password . " != " . base64_encode($passwordlama)]);
        } else {
            $this->db->trans_start();
            $this->db->trans_strict(FALSE);

            $data = [
                "password" => base64_encode($this->input->post("passwordbaru")),
            ];

            $this->db->update('glbm_login', $data, ["email" => $email]);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                echo json_encode(["success" => false, "msg" => "Terjadi kesalahan"]);
                $this->db->trans_rollback();
            } else {
                echo json_encode(["success" => true, "msg" => "Password berhasil diubah"]);
                $this->db->trans_commit();
            }
        }
        print_r($data);
        die('ok');
    }
}
