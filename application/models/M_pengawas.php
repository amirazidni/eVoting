
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengawas extends CI_Model
{
	private $table = 'operator';
	private $delete_at;

	public function __construct()
	{
		$this->delete_at = date('Y-m-d H:i:s');
		$this->load->library('l_password');
	}

	public function getOperator(string $id)
	{
		$res = $this->db->where('id', $id)->from($this->table)->get();
		return $res->result_array();
	}

	public function getOperators()
	{
		$res = $this->db->where('level', 'operator')->from($this->table)->get();
		return $res->result_array();
	}

	function show_pengawas()
	{
		$hasil = $this->db->query("SELECT * FROM operator WHERE delete_at IS NULL");
		return $hasil;
	}

	function insert_data()
	{
		$this->l_password->setEnc($this->db->escape_str($this->input->post('username', true)));
		$this->l_password->setVal($this->db->escape_str($this->input->post('password', true)));
		$password = $this->l_password->getEnc();
		$field = array(
			'id' => generateID(),
			'username' => $this->db->escape_str($this->input->post('username', true)),
			'password' => $password,
			'namapengawas' => $this->db->escape_str($this->input->post('namapengawas', true)),
			'level' => $this->db->escape_str($this->input->post('level', true)),
			'phone' => $this->db->escape_str($this->input->post('phone', true)),
		);
		$this->db->insert('operator', $field);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletepengawas($id)
	{
		$this->db->where('id', $id);
		$this->db->update('operator', ['delete_at' => $this->delete_at]);


		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function editpengawas($id)
	{
		$this->l_password->setEnc($this->db->escape_str($this->input->post('username', true)));
		$this->l_password->setVal($this->db->escape_str($this->input->post('password', true)));
		$password = $this->l_password->getEnc();
		$this->db->where('id', $id);
		$field = array(
			'username' => $this->db->escape_str($this->input->post('username', true)),
			'password' => $password,
			'namapengawas' => $this->db->escape_str($this->input->post('namapengawas', true)),
			'level' => $this->db->escape_str($this->input->post('level', true)),
			'phone' => $this->db->escape_str($this->input->post('phone', true)),
		);
		$this->db->update('operator', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
