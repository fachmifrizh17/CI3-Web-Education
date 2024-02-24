<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Otorisasimenu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('caridata_model');
        $this->load->model('global_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function getmenu() {
        $roleid = $this->input->post('roleid');
        $data = $this->db->query("SELECT m.* FROM stpm_rolemenu r LEFT JOIN stpm_rolemenudetail d ON d.idrole = r.id LEFT JOIN stpm_menu m ON m.id = d.idmenu WHERE r.id = $roleid")->result();
        echo json_encode($data);
    }

    function getreport() {
        $roleid = $this->input->post('roleid');
        $data = $this->db->query("SELECT r.id, r.namareport FROM stpm_reportrole ro LEFT JOIN stpm_report r ON r.id = ro.reportid WHERE ro.roleid = $roleid")->result();
        echo json_encode($data);
    }

    function cekdata()
    {
        $role = $this->input->post('role');
        $username = $this->input->post('username');
        $data = $this->db->get_where("glbm_login", ["username" => $username, "roleid" => $role]);
        echo json_encode($data);
    }

    function save()
    {
        $errorvalidasi = false;
        $nama = $this->input->post('nama');
        $detailmenu = $this->input->post('detailmenu');

        if (empty($detailmenu)) {
            $resultjson = array(
                'nomor' => "",
                'message' => "Silahkan pilih atau checklist menu, pada table menu diatas!"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $datas = array(
            "namarole" => $nama,
            'tglsimpan' => date('Y-m-d H:i:s'),
            'pemakai' => $this->session->userdata('myusername'),
        );
        $this->global_model->insertData('stpm_rolemenu', $datas);
        $insert_id = $this->db->insert_id();

        if ($errorvalidasi == FALSE) {
            foreach ($detailmenu as $key => $value) {
                $datamenu = array(
                    'idrole' => $insert_id,
                    'idmenu' => $value['id'],
                    'tglsimpan' => date('Y-m-d H:i:s'),
                    'pemakai' => $this->session->userdata('myusername'),
                );
                $this->global_model->insertData('stpm_rolemenudetail', $datamenu);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal disimpan"
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'nomor' => $this->db->insert_id(),
                'message' => "Data berhasil disimpan"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode($resultjson);
    }

    function saveuserrole()
    {
        $errorvalidasi = false;
        $role = $this->input->post('role');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $data = array(
            "username" => $username,
            "password" => base64_encode($password),
            "kodecabang" => "ALL",
            "kodecompany" => "PM",
            "aktif" => TRUE,
            'tglsimpan' => date('Y-m-d H:i:s'),
            'usersimpan' => $this->session->userdata('myusername'),
            'kodegrup' => "IT",
            "roleid" => $role,
        );
        $this->global_model->insertData('glbm_login', $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal disimpan"
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'nomor' => $username,
                'message' => "Data berhasil disimpan"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode($resultjson);
    }

    function updateuserrole()
    {
        $errorvalidasi = false;
        $role = $this->input->post('role');
        $username = $this->input->post('username');

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        $data = array(
            'tglsimpan' => date('Y-m-d H:i:s'),
            'usersimpan' => $this->session->userdata('myusername'),
            'roleid' => $role,
        );

        // $this->global_model->updateData('glbm_login', ['username' => $username], $data);
        $this->db->update('glbm_login', $data, "username = '$username'");

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal diupdate"
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'nomor' => $username,
                'message' => "Data berhasil diupdate"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode($resultjson);
    }

    function savereportrole()
    {
        $errorvalidasi = false;
        $role = $this->input->post('role');
        $detailreport = $this->input->post('detailreport');

        if (empty($detailreport)) {
            $resultjson = array(
                'nomor' => "",
                'message' => "Silahkan pilih atau checklist menu, pada table menu diatas!"
            );
            $errorvalidasi = TRUE;
            echo json_encode($resultjson);
            return FALSE;
        }

        $this->db->trans_start(); # Starting Transaction
        $this->db->trans_strict(FALSE);

        if ($errorvalidasi == FALSE) {
            foreach ($detailreport as $key => $value) {
                $datareport = array(
                    'reportid' => $value['id'],
                    'roleid' => $role,
                    'tglsimpan' => date('Y-m-d H:i:s'),
                    'pemakai' => $this->session->userdata('myusername'),
                );
                $this->global_model->insertData('stpm_reportrole', $datareport);
            }
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $resultjson = array(
                'nomor' => "",
                'message' => "Data gagal disimpan"
            );
            # Something went wrong.
            $this->db->trans_rollback();
        } else {
            $resultjson = array(
                'nomor' => $role,
                'message' => "Data berhasil disimpan"
            );
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
        }
        echo json_encode($resultjson);
    }

    function cariuser()
    {
        $fetch_data = $this->caridata_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $id=0;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $key => $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $id = $row->$value;
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                            $sub_array[] = '<button class="btn btn-sm btn-danger cabangok" data-id="' . $id . '" title="Detail">Detail <i class="ti-arrow-circle-right"></i></a>';
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
            "recordsTotal"      => $this->caridata_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"   => $this->caridata_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"              => $data
        );
        echo json_encode($output);
    }

    function carimenu()
    {
        $fetch_data = $this->caridata_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
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
            "recordsTotal"       => $this->caridata_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"    => $this->caridata_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"               => $data
        );
        echo json_encode($output);
    }

    function carirole()
    {
        $fetch_data = $this->caridata_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
        $data = array();
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $i = 1;
            $count = count($this->input->post('field'));
            foreach ($this->input->post('field') as $key => $value) {
                if ($i <= $count) {
                    if ($i == 1) {
                        $id = $row->$value;
                        $sub_array[] = $row->$value;
                    } else {
                        if ($i == $count) {
                            $sub_array[] = $row->$value;
                            $sub_array[] = '<button class="btn btn-sm btn-danger roleok" data-id="' . $id . '" title="Pilih">Pilih <i class="ti-arrow-circle-right"></i></a>';
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
            "recordsTotal"      => $this->caridata_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"   => $this->caridata_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"              => $data
        );
        echo json_encode($output);
    }

    function carireport()
    {
        $fetch_data = $this->caridata_model->make_datatables($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value'));
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
            "recordsTotal"       => $this->caridata_model->get_all_data($this->input->post('nmtb')),
            "recordsFiltered"    => $this->caridata_model->get_filtered_data($this->input->post('field'), $this->input->post('nmtb'), $this->input->post('sort'), $this->input->post('where'), $this->input->post('value')),
            "data"               => $data
        );
        echo json_encode($output);
    }
}
