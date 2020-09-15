<?php

class M_pemilih extends CI_Model
{

	function show_pemilih()
	{
		$hasil = $this->db->query("SELECT * FROM pemilih");
		return $hasil;
	}


	function insert_data()
	{
		$field = array(
			'id' => date("yyyyMMddHHmmss"),
			'nim' => $this->db->escape_str($this->input->post('nim', true)),
			'password' => md5($this->db->escape_str($this->input->post('password', true))),
			'nama' => $this->db->escape_str($this->input->post('nama', true)),
			'kelas' => $this->db->escape_str($this->input->post('kelas', true)),
			'suara' => '0',
			'aktivasi' => '0'

		);
		$this->db->insert('pemilih', $field);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function deletepemilih($id)
	{
		$hasil = $this->db->query("SELECT suara  FROM pemilih where id='$id'");
		foreach ($hasil->result_array() as $i) :
			$k = $i['suara'];

			$hasil2 = $this->db->query("SELECT vote  FROM calon where id='$k'");
			foreach ($hasil2->result_array() as $i) :
				$l = $i['vote'];
				$l = $l - 1;

				$this->db->query("UPDATE calon set vote='$l' where id='$k'");
			endforeach;
		endforeach;

		$this->db->where('id', $id);
		$this->db->delete('pemilih');


		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	// untuk update pemilih
	public function editpemilih($id)
	{
		$this->db->where('id', $id);
		$field = array(
			'nama' => $this->db->escape_str($this->input->post('nama', true)),
			'kelas' => $this->db->escape_str($this->input->post('kelas', true)),
		);
		$this->db->update('pemilih', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	//untuk aktivasi pemilih
	public function editaktivasi($id)
	{
		$pengaw = $this->session->userdata('id');
		$field = array(
			'aktivasi' => $id
		);

		$this->db->where('id', $id);
		$this->db->update('pemilih', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function editaktivasibatal($id)
	{
		$this->db->where('id', $id);
		$field = array(
			'aktivasi' => '0'
		);
		$this->db->update('pemilih', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function reset($id)
	{

		$hasil = $this->db->query("SELECT suara  FROM pemilih where id='$id'");
		foreach ($hasil->result_array() as $i) :
			$k = $i['suara'];

			$hasil2 = $this->db->query("SELECT vote  FROM calon where id='$k'");
			foreach ($hasil2->result_array() as $i) :
				$l = $i['vote'];
				$l = $l - 1;

				$this->db->query("UPDATE calon set vote='$l' where id='$k'");
			endforeach;
		endforeach;

		$this->db->where('id', $id);
		$field = array(
			'suara' => '0',
		);
		$this->db->update('pemilih', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
