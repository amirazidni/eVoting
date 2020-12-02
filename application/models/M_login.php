<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{
	function cek_login($a, $where)
	{
		return $this->db->get_where($a, $where);
	}
}
