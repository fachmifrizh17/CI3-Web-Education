<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('laporan/Laporan_model');
		// $this->load->model('masterdata/Customer_model');
		$this->load->model('Caridataaktif_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function loadreport()
    {
        $username = $this->session->userdata('myusername');
        $user = $this->db->get_where("glbm_login", ["username" => $username])->row();
        $data = $this->db->query("SELECT r.id, r.modul, r.fieldreport, r.namareport FROM stpm_reportrole ro LEFT JOIN stpm_report r ON r.id = ro.reportid WHERE ro.roleid = $user->roleid")->result();
        echo json_encode($data);
    }

	//DATA SISWA//

	public function DataSiswa($param = "")
	{
		$params = explode(":", urldecode($param));
		// print_r($params);
		// die();
		$filename = 'Laporan Data Siswa';

		// if (!empty($tanggal)){

		$paper = 'A4';
		$orientation = 'landscape';

		// menggunakan class dompdf
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetDataSiswa();
		// print_r($data);
		// die();

		$this->pdf->load_view('menu/cetak_pdf/r_data_siswa', $data, $filename, $paper, $orientation);

		// (Opsional) Mengatur ukuran kertas dan orientasi kertas
		$this->pdf->setPaper('F4', 'landscape');

		// Menjadikan HTML sebagai PDF
		$this->pdf->render();

		// Output akan menghasilkan PDF (1 = download dan 0 = preview)
		$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

		exit(0);
		// }
	}

	public function PreviewDataSiswa($param = "")
	{	
		$filename = 'Laporan Data Siswa';
		$paper = 'A4';
		$orientation = 'landscape';
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetDataSiswa();

		ini_set("memory_limit", "256");
		set_time_limit(300);
		$this->load->view('menu/cetak_pdf/r_data_siswa', $data, $filename, $paper, $orientation);
	}

	public function ExportDataSiswa($param = "")
	{
		$filename = 'Laporan Data Siswa';

		$paper = 'A4';
		$orientation = 'landscape';

		$data['reportrow'] = $this->Laporan_model->GetDataSiswa();
		$this->load->view('menu/cetak_pdf/excel_data_siswa', $data, $filename, $paper, $orientation);
	}

	//END DATA SISWA//
	//DATA BUKU//

	public function DataBuku($param = "")
	{
		$params = explode(":", urldecode($param));
		// print_r($params);
		// die();
		$filename = 'Laporan Data Buku';

		// if (!empty($tanggal)){

		$paper = 'A4';
		$orientation = 'landscape';

		// menggunakan class dompdf
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetDataBuku();
		// print_r($data);
		// die();

		$this->pdf->load_view('menu/cetak_pdf/r_data_buku', $data, $filename, $paper, $orientation);

		// (Opsional) Mengatur ukuran kertas dan orientasi kertas
		$this->pdf->setPaper('F4', 'landscape');

		// Menjadikan HTML sebagai PDF
		$this->pdf->render();

		// Output akan menghasilkan PDF (1 = download dan 0 = preview)
		$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

		exit(0);
		// }
	}

	public function PreviewDataBuku($param = "")
	{
		$filename = 'Laporan Data Buku';
		$paper = 'A4';
		$orientation = 'landscape';
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetDataSiswa();

		ini_set("memory_limit", "256");
		set_time_limit(300);
		$this->load->view('menu/cetak_pdf/r_data_buku', $data, $filename, $paper, $orientation);
	}

	public function ExportDatBuku($param = "")
	{
		$filename = 'Laporan Data Buku';

		$paper = 'A4';
		$orientation = 'landscape';

		$data['reportrow'] = $this->Laporan_model->GetDataBuku();
		$this->load->view('menu/cetak_pdf/excel_data_buku', $data, $filename, $paper, $orientation);
	}

	//END DATA BUKU//
	//DATA GURU//

	public function DataGuru($param = "")
	{
		$params = explode(":", urldecode($param));
		// print_r($params);
		// die();
		$filename = 'Laporan Data Guru';

		// if (!empty($tanggal)){

		$paper = 'A4';
		$orientation = 'landscape';

		// menggunakan class dompdf
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetDataGuru();
		// print_r($data);
		// die();

		$this->pdf->load_view('menu/cetak_pdf/r_data_guru', $data, $filename, $paper, $orientation);

		// (Opsional) Mengatur ukuran kertas dan orientasi kertas
		$this->pdf->setPaper('F4', 'landscape');

		// Menjadikan HTML sebagai PDF
		$this->pdf->render();

		// Output akan menghasilkan PDF (1 = download dan 0 = preview)
		$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

		exit(0);
		// }
	}

	public function PreviewDataGuru($param = ""){
		$filename = 'Laporan Data Buku';
		$paper = 'A4';
		$orientation = 'landscape';
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetDataGuru();

		ini_set("memory_limit", "256");
		set_time_limit(300);
		$this->load->view('menu/cetak_pdf/r_data_guru', $data, $filename, $paper, $orientation);
	}

	public function ExportDataGuru($param = "")
	{
		$filename = 'Laporan Data Guru';

		$paper = 'A4';
		$orientation = 'landscape';

		$data['reportrow'] = $this->Laporan_model->GetDataBuku();
		$this->load->view('menu/cetak_pdf/excel_data_buku', $data, $filename, $paper, $orientation);
	}

	//END DATA GURU//
	//DATA MAPPING GURU//

	public function MappingGuru($param = "")
	{
		$params = explode(":", urldecode($param));
		// print_r($params);
		// die();
		$filename = 'Laporan Mapping Guru';

		// if (!empty($tanggal)){

		$paper = 'A4';
		$orientation = 'landscape';

		// menggunakan class dompdf
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetMappingGuru();
		// print_r($data);
		// die();

		$this->pdf->load_view('menu/cetak_pdf/r_data_mapping_guru', $data, $filename, $paper, $orientation);

		// (Opsional) Mengatur ukuran kertas dan orientasi kertas
		$this->pdf->setPaper('F4', 'landscape');

		// Menjadikan HTML sebagai PDF
		$this->pdf->render();

		// Output akan menghasilkan PDF (1 = download dan 0 = preview)
		$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

		exit(0);
		// }
	}

	public function PreviewMappingGuru($param = ""){
		$filename = 'Laporan Mapping Guru';
		$paper = 'A4';
		$orientation = 'landscape';
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetMappingGuru();

		ini_set("memory_limit", "256");
		set_time_limit(300);
		$this->load->view('menu/cetak_pdf/r_data_mapping_guru', $data, $filename, $paper, $orientation);
	}

	public function ExportMappingGuru($param = "")
	{
		$filename = 'Laporan Mapping Guru';

		$paper = 'A4';
		$orientation = 'landscape';

		$data['reportrow'] = $this->Laporan_model->GetMappingGuru();
		$this->load->view('menu/cetak_pdf/excel_mapping_guru', $data, $filename, $paper, $orientation);
	}

	//END MAPPING GURU//
	//MAPPING SISWA//
	
	public function MappingSiswa($param = "")
	{
		$params = explode(":", urldecode($param));
		// print_r($params);
		// die();
		$filename = 'Laporan Mapping Siswa';

		// if (!empty($tanggal)){

		$paper = 'A4';
		$orientation = 'landscape';

		// menggunakan class dompdf
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetMappingSiswa();
		// print_r($data);
		// die();

		$this->pdf->load_view('menu/cetak_pdf/r_data_mapping_siswa', $data, $filename, $paper, $orientation);

		// (Opsional) Mengatur ukuran kertas dan orientasi kertas
		$this->pdf->setPaper('F4', 'landscape');

		// Menjadikan HTML sebagai PDF
		$this->pdf->render();

		// Output akan menghasilkan PDF (1 = download dan 0 = preview)
		$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

		exit(0);
		// }
	}

	public function PreviewMappingSiswa($param = ""){
		$filename = 'Laporan Mapping Siswa';
		$paper = 'A4';
		$orientation = 'landscape';
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetMappingSiswa();

		ini_set("memory_limit", "256");
		set_time_limit(300);
		$this->load->view('menu/cetak_pdf/r_data_mapping_siswa', $data, $filename, $paper, $orientation);
	}

	public function ExportMappingSiswa($param = "")
	{
		$filename = 'Laporan Mapping Siswa';

		$paper = 'A4';
		$orientation = 'landscape';

		$data['reportrow'] = $this->Laporan_model->GetMappingSiswa();
		$this->load->view('menu/cetak_pdf/excel_mapping_siswa', $data, $filename, $paper, $orientation);
	}

	//END MAPPING SISWA//
	//HISTORI BACA//

	public function HistoriBaca($param = "")
	{
		$params = explode(":", urldecode($param));
		// print_r($params);
		// die();
		$filename = 'Laporan Histori Baca';

		// if (!empty($tanggal)){

		$paper = 'A4';
		$orientation = 'landscape';

		// menggunakan class dompdf
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetDataHistoriBaca();
		// print_r($data);
		// die();

		$this->pdf->load_view('menu/cetak_pdf/r_histori_baca', $data, $filename, $paper, $orientation);

		// (Opsional) Mengatur ukuran kertas dan orientasi kertas
		$this->pdf->setPaper('F4', 'landscape');

		// Menjadikan HTML sebagai PDF
		$this->pdf->render();

		// Output akan menghasilkan PDF (1 = download dan 0 = preview)
		$this->pdf->stream("welcome.pdf", array("Attachment" => 0));

		exit(0);
		// }
	}

	public function PreviewHistoriBaca($param = "") {
		$filename = 'Laporan Histori Baca';
		$paper = 'A4';
		$orientation = 'landscape';
		$this->load->library('pdf');

		$data['reportrow'] = $this->Laporan_model->GetDataHistoriBaca();

		ini_set("memory_limit", "256");
		set_time_limit(300);
		$this->load->view('menu/cetak_pdf/r_histori_baca', $data, $filename, $paper, $orientation);
	}

	
	public function ExportHistoriBaca($param = "")
	{
		$filename = 'Laporan History Baca';
		
		$paper = 'A4';
		$orientation = 'lanscaper';

		$data['reportrow'] = $this->Laporan_model->GetDataHistoriBaca();
		$this->load->view('menu/cetak_pdf/excel_histori_baca', $data, $filename, $paper, $orientation);
	}

	//END HISTORI BACA//
}
