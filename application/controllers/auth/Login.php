<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('auth/login_model');
		$this->load->library('session');
	}

	public function index()
	{
		if ($this->session->userdata('myusername') != '') {
			redirect('main/dashboard');
		}

		$data['title'] 	= "Login";
		$data['script'] = "auth/login/js";
		$this->template->auth('auth/login/index', $data);
	}

	public function cek_login()
	{
		$email = $this->input->post('email');
		$password = base64_encode($this->input->post('password'));

		$level =	$this->input->post('level');

		if ($level == '1') {
			$user = $this->login_model->login($email, $password);

			if (!empty($user)) {
				if ($user->kodekelas == "KLS000001") {
					echo json_encode(["success" => true, "message" => "email dan Password terdaftar", "redirect" => false]);
				} else {
					$this->session->set_userdata('myusername', $email);
					$this->session->set_userdata('kodekelas', $user->kodekelas);
					$this->session->set_userdata('myroleid', $user->roleid);

					echo json_encode(["success" => true, "message" => "Username dan Password terdaftar", "redirect" => true]);
				}
			} else {
				echo json_encode(["success" => false, "message" => "Username atau Password Salah"]);
			}
		} else if ($level == '2') {
			$cek_guru = $this->db->query("SELECT count(kode) as hasil FROM glbm_guru where email='$email' and password='$password'")->row()->hasil;
			if (!empty($cek_guru)) {
				$this->session->set_userdata('myusername', $email);
				$this->session->set_userdata('kodekelas', $user->kodekelas);
				$this->session->set_userdata('myroleid', $user->roleid);

				echo json_encode(["success" => true, "message" => "Username dan Password terdaftar", "redirect" => true]);
			} else {
				echo json_encode(["success" => false, "message" => "Username atau Password Salah"]);
			}
		} else if (!empty($cek_siswa)) {
			$cek_siswa = $this->db->query("SELECT count(kode) as hasil FROM glbm_siswa where email='$email' and password='$password'")->row()->hasil;
			$this->session->set_userdata('myusername', $email);
			$this->session->set_userdata('kodekelas', $user->kodekelas);
			$this->session->set_userdata('myroleid', '3');

			echo json_encode(["success" => true, "message" => "Username and password are correct", "redirect" => true]);
		} else {
			echo json_encode(["success" => false, "message" => "Incorrect username or password"]);
		}
	}

	public function view_cabang()
	{
		$data["role"] = $this->db->get_where("cari_grup")->result();
		return $this->load->view('auth/login/view_cabang', $data);
	}

	public function cek_cabang()
	{
		$email = $this->input->post('email');
		$level = $this->input->post('level');

		$this->session->set_userdata('myusername', $email);
		$this->session->set_userdata('level', $level);

		echo json_encode(["success" => true, "message" => "Login Berhasil!"]);
	}

	public function get_departemen()
	{
		$key = $this->input->post("level");

		if ($key) {
			$query = $this->login_model->mapping_departemen($key);

			echo json_encode($query);
		} else {
			echo json_encode(["success" => false, "msg" => "Data tidak ditemukan"]);
		}
	}
}
