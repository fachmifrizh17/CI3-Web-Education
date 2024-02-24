<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
	}

	public function index()
	{
		if (true == $this->session->has_userdata('myusername')) {
			redirect('main/dashboard');
		} else {
			redirect('auth/login');
		}
	}

	public function dashboard()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Dashboard";
			$data['submenu']   = "";
			$data['title']  = "Dashboard";
			$data['script'] = "menu/dashboard/js";
			$this->template->view('menu/dashboard/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function ganti()
	{

		$level =	$this->input->post('level');
		$email =	$this->input->post('email');
		$password	 = $this->input->post('passwordbaru');
		$konfirmasi = $this->input->post('konfirmasi');

		$enkrip = base64_encode($password);
		if ($password != $konfirmasi) {
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			if ($level == '2') {

				$this->db->query("UPDATE glbm_guru set aktif='TRUE',password='$enkrip' where email='$email'");
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$this->db->query("UPDATE glbm_siswa set aktif='TRUE',password='$enkrip' where email='$email'");
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	//LAPORAN//
	public function laporan()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Laporan";
			$data['submenu']   = "";
			$data['title']  = "Laporan";
			$data['script'] = "menu/laporan/laporan/js";
			$this->template->view('menu/laporan/laporan/index', $data);
		} else {
			redirect('auth/login');
		}
	}
	//END LAPORAN//

	//MASTERDATA//

	public function guru()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Master Data";
			$data['submenu']   = "";
			$data['title']  = "Guru";
			$data['script'] = "menu/master_data/guru/js";
			$this->template->view('menu/master_data/guru/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function siswa()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Master Data";
			$data['submenu']   = "";
			$data['title']  = "Siswa";
			$data['script'] = "menu/master_data/siswa/js";
			$this->template->view('menu/master_data/siswa/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function kelas()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Master Data";
			$data['submenu']   = "";
			$data['title']  = "Kelas";
			$data['script'] = "menu/master_data/kelas/js";
			$this->template->view('menu/master_data/kelas/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function buku()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Master Data";
			$data['submenu']   = "";
			$data['title']  = "Buku";
			$data['script'] = "menu/master_data/buku/js";
			$this->template->view('menu/master_data/buku/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function mapping_guru()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Mapping Guru";
			$data['submenu']   = "";
			$data['title']  = "Mapping Guru";
			$data['script'] = "menu/master_data/mapping_guru/js";
			$this->template->view('menu/master_data/mapping_guru/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function mapping_siswa()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Mapping Siswa";
			$data['submenu']   = "";
			$data['title']  = "Mapping Siswa";
			$data['script'] = "menu/master_data/mapping_siswa/js";
			$this->template->view('menu/master_data/mapping_siswa/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function admin()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Profile";
			$data['submenu']   = "";
			$data['title']  = "Profile";
			$data['script'] = "menu/master_data/admin/js";
			$this->template->view('menu/master_data/admin/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function mapping_buku()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Mapping Buku";
			$data['submenu']   = "";
			$data['title']  = "Mapping Buku";
			$data['script'] = "menu/master_data/mapping_buku/js";
			$this->template->view('menu/master_data/mapping_buku/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	//END MASTERDATA//

	//READING//

	public function ubah_data()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Ubah Data";
			$data['submenu']   = "";
			$data['title']  = "Ubah Data";
			$data['script'] = "menu/read/ubah_data/js";
			$this->template->view('menu/read/ubah_data/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function read()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Read";
			$data['submenu']   = "";
			$data['title']  = "Read";
			$data['script'] = "menu/read/read_siswa/js";
			$this->template->view('menu/read/read_siswa/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function histori_baca_siswa()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Histori Baca Siswa";
			$data['submenu']   = "";
			$data['title']  = "Histori Baca Siswa";
			$data['script'] = "menu/read/histori_baca_siswa/js";
			$this->template->view('menu/read/histori_baca_siswa/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function histori_baca_guru()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Histori Baca";
			$data['submenu']   = "";
			$data['title']  = "Histori Baca";
			$data['script'] = "menu/read/histori_baca_guru/js";
			$this->template->view('menu/read/histori_baca_guru/index', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function auto_read_siswa()
	{
		if (true == $this->session->has_userdata('myusername')) {
			$data['menu']   = "Generate Buku";
			$data['submenu']   = "";
			$data['title']  = "Generate Buku";
			$data['script'] = "menu/read/auto_read_siswa/js";
			$this->template->view('menu/read/auto_read_siswa/index', $data);
		} else {
			redirect('auth/login');
		}
	}
}
