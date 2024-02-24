<?php

class Global_model extends CI_Model
{
    function getData($table = "", $where = array())
    {
        $this->db->where($where);
        return $this->db->get($table)->result();
    }

    function insertData($table = "", $data = array())
    {
        return $this->db->insert($table, $data);
    }

    function updateData($table = "", $data = array(), $where = array())
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    function deleteData($table = "", $where = array())
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function queryData($query)
    {
        return $this->db->query($query)->result();
    }

    function queryUpdateData($query)
    {
        $this->db->query($query);
    }
}
