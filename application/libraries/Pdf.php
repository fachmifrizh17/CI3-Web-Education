<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/dompdf/autoload.inc.php');

class Pdf extends Dompdf\Dompdf
{
	/**
	 * Get an instance of CodeIgniter
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function ci()
	{
		return get_instance();
	}

	/**
	 * Load a CodeIgniter view into domPDF
	 *
	 * @access	public
	 * @param	string	$view The view to load
	 * @param	array	$data The view data
	 * @return	void
	 */
	public function load_view($view, $data = array(), $namareport, $paper, $orientation)
	{
		$html = $this->ci()->load->view($view, $data, TRUE);
		// $loadci = $this->ci();
		// $html = $loadci->load->view($view, $data, TRUE);
		$this->set_option("isPhpEnabled", true);
		$this->load_html($html);
		$this->setPaper($paper, $orientation);
		$this->render();
		// $this->stream($namareport . ".pdf", array("Attachment" => false));

		// $file = $lokassimpan . $namareport . '.pdf';
		// file_put_contents($file, $this->output());

		// $this->render();
		$this->stream($namareport . ".pdf", array("Attachment" => false));
	}
}
