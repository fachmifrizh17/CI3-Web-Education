<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template
{
    private $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    function view($directory, $data = null, $returnhtml = false)
    {
        $data['content'] = $directory;
        $viewdata = (empty($data)) ? $data : $data;
        $view_html = $this->CI->load->view('layouts/index', $viewdata, $returnhtml);
        if (!$returnhtml) return $view_html;
    }

    function auth($directory, $data = null, $returnhtml = false)
    {
        $data['content'] = $directory;
        $viewdata = (empty($data)) ? $data : $data;
        $view_html = $this->CI->load->view('layouts/auth/index', $viewdata, $returnhtml);
        if (!$returnhtml) return $view_html;
    }
}
/* End of file Template.php */
