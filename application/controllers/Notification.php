<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('session');
    }

    public function index()
    {
        $kodebuku = $this->session->userdata("mykodebuku");
        $email = $this->session->userdata("myusername");
        $start_date = date('Y-m-d', strtotime('yesterday'));
        $end_date = date('Y-m-d');

        $notification = [];
        $totalpr = 0;
        $totalnotif = 0;

        $readsiswa = $this->db->query("SELECT
        *
        FROM
         stpm_generatedetail 
         WHERE status_baca ='false' and emailsiswa='$email' and tanggal BETWEEN '$start_date' AND '$end_date'")->result();

        $totalpr += sizeof($readsiswa);

        $totalnotif += $totalpr;
        $notification += ["approvemanager" => $totalpr];

        $newread = $this->_approveFunctional($kodebuku);
        $notification += ["approvefunctional" => $newread];
        $totalnotif += $newread;

        $notification += ["totalnotif" => $totalnotif];

        echo json_encode($notification);
    }

    private function _approveFunctional($emailsiswa)
    {
        $query = $this->db->get_where("stpm_generatedetail", [
            "emailsiswa" => $emailsiswa,
            "status_baca" => false
        ]);
        return $query->num_rows();
    }
}
