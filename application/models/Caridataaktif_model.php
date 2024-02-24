<?php defined('BASEPATH') or exit('No direct script access allowed');

class Caridataaktif_model extends CI_Model
{
	function make_query($fieldcari = "", $namatable = "", $sort = "", $where = "", $values = "")
	{
		$count = count($fieldcari);
		$select = "";
		$order_column = "";
		$i = 1;
		foreach ($fieldcari as $value) {
			if ($i < $count) {
				$select .= $value . ",";
				$order_column = $value;
			} else {
				$select .= $value;
			}
			$i++;
		}
		if ($values != "") {
			$this->db->where($values);
		}

		$this->db->group_start();
		$i = 1;
		foreach ($where as $value) {
			if (isset($_POST["search"]["value"])) {
				if ($i == 1) {
					$this->db->like("lower(" . $value . ")", strtolower($_POST["search"]["value"]));
				} else {
					$this->db->or_like("lower(" . $value . ")", strtolower($_POST["search"]["value"]));
				}
			}
			$i++;
		}
		$this->db->group_end();
		$this->db->select($select);
		$this->db->from($namatable);
		if (isset($_POST["order"])) {
			$this->db->order_by($order_column, $_POST['order']['0']['dir']);
		} else {
			$this->db->order_by($sort, 'asc');
		}
	}
	
	function make_datatables($fieldcari = "", $namatable = "", $sort = "", $where = "", $values = "")
	{
		$this->make_query($fieldcari, $namatable, $sort, $where, $values);
		if ($_POST["length"] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function get_filtered_data($fieldcari = "", $namatable = "", $sort = "", $where = "", $values = "")
	{
		$this->make_query($fieldcari, $namatable, $sort, $where, $values);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_all_data($namatable = "")
	{
		$this->db->select("*");
		$this->db->from($namatable);
		return $this->db->count_all_results();
	}
}
