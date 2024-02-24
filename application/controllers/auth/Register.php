<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('auth/Register_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function Save()
	{
		$pemakai =  $this->session->userdata('myuserusername');

		$this->db->trans_start(); # Starting Transaction
		$this->db->trans_strict(FALSE);

		$data = array(
			'username' 		=> $this->input->post('username'),
			'nama' 			=> $this->input->post('nama'),
			'password'      => base64_encode($this->input->post('password')),
			'kodecabang'	=> $this->input->post('kodecabang'),
			'tglsimpan' 	=> date('Y-m-d'),
			'pemakai' 		=> $pemakai,
		);
		$this->Register_model->SaveData($data);

		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$resultjson = array(
				'id' => "",
				'message' => "Data gagal disimpan, ID sudah pernah digunakan"
			);
			# Something went wrong.
			$this->db->trans_rollback();
		} else {
			$resultjson = array(
				'id' => $this->input->post('username'),
				'message' => "Data berhasil disimpan"
			);
			# Everything is Perfect. 
			# Committing data to the database.
			$this->db->trans_commit();
		}
		echo json_encode($resultjson);
	}

	function Username_exists()
	{
		$username = $this->input->post('username');
		$exists = $this->Register_model->Username_exists($username);

		$count = count($exists);
		// echo $count 

		if (empty($count)) {
			return true;
		} else {
			return false;
		}
	}
}
