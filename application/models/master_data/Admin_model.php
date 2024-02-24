<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    function get_user()
    {
        return $this->db->get("glbm_login")->result();
    }

    function get_user_by_username($email = "")
    {
        return $this->db->get_where("glbm_login", ["email" => $email])->row();
    }
}
