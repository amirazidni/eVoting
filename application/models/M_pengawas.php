
<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_pengawas extends CI_Model
{
	private $delete_at;

	public function __construct()
	{
		$this->delete_at = date('Y-m-d H:i:s');
	}

	function show_pengawas()
	{
		$hasil = $this->db->query("SELECT * FROM operator WHERE delete_at IS NULL");
		return $hasil;
	}

	function insert_data()
	{
		$field = array(
			'id' => date("YmdHis"),
			'username' => $this->db->escape_str($this->input->post('username', true)),
			'password' => $this->db->escape_str($this->input->post('password', true)),
			'namapengawas' => $this->db->escape_str($this->input->post('namapengawas', true))

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
		$this->db->update('operator', ['delete_at'=> $this->delete_at]);


		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function editpengawas($id)
	{
		$this->db->where('id', $id);
		$field = array(
			'username' => $this->db->escape_str($this->input->post('username', true)),
			'password' => $this->db->escape_str($this->input->post('password', true)),
			'namapengawas' => $this->db->escape_str($this->input->post('namapengawas', true))

		);
		$this->db->update('operator', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
