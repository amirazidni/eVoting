<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pemilih extends CI_Model
{
	private $delete_at;

	public function __construct()
	{
		$this->delete_at = date('Y-m-d H:i:s');
		$this->load->library('l_password');
	}

	public function gets()
	{
		$res = $this->db->select('id, nim, nama, kelas')->from('pemilih')->get()->result_array();
		return $res;
	}

	public function getCount()
	{
		$res = $this->db->query('select count(id) as count from pemilih')->result();
		return $res[0]->count;
	}

	function jumlah_pemilih()
	{
		$totalpemilih = $this->db->query("SELECT * FROM pemilih WHERE delete_at IS NULL");
		if ($totalpemilih->num_rows() > 0) {
			return $totalpemilih->num_rows();
		} else {
			return 0;
		}
	}
	function suara_masuk()
	{
		$totalsuara = $this->db->query("SELECT * FROM pemilih where suara not like '0' AND delete_at IS NULL");
		if ($totalsuara->num_rows() > 0) {
			return $totalsuara->num_rows();
		} else {
			return 0;
		}
	}

	function show_pemilih($where = null, $tables = null, $cari = null)
	{
		if ($where == null) {
			if ($tables == null && $cari == null) {
				$hasil = $this->db->query("SELECT * FROM pemilih WHERE delete_at IS NULL");
				return $hasil;
			} else {
				// Ambil data yang di ketik user pada textbox pencarian
				$search = preg_replace("/[^a-zA-Z0-9.]/", ' ', "{$_POST['search']['value']}");
				// Ambil data limit per page
				$limit = preg_replace("/[^a-zA-Z0-9.]/", ' ', "{$_POST['length']}");
				// Ambil data start
				$start = preg_replace("/[^a-zA-Z0-9.]/", ' ', "{$_POST['start']}");

				$sql = $this->db->get($tables);

				$sql_count = $sql->num_rows();

				$query = $tables;
				$cari = implode(" LIKE '%" . $search . "%' OR ", $cari) . " LIKE '%" . $search . "%'";

				// Untuk mengambil nama field yg menjadi acuan untuk sorting
				$order_field = $_POST['order'][0]['column'];

				// Untuk menentukan order by "ASC" atau "DESC"
				$order_ascdesc = $_POST['order'][0]['dir'];
				$order = " ORDER BY " . $_POST['columns'][$order_field]['data'] . " " . $order_ascdesc;

				$sql_data = $this->db->query("SELECT * FROM " . $query . " WHERE (" . $cari . ")" . $order . " LIMIT " . $limit . " OFFSET " . $start);
				$sql_filter = $this->db->query("SELECT * FROM " . $query);
				$sql_filter_count = $sql_filter->num_rows();
				$data = $sql_data->result_array();

				$callback = array(
					'draw' => $_POST['draw'], // Ini dari datatablenya    
					'recordsTotal' => $sql_count,
					'recordsFiltered' => $sql_filter_count,
					'data' => $data
				);
				return json_encode($callback, true); // Convert array $callback ke json
			}
		} else {
			$hasil = $this->db->get_where('pemilih', ['id' => $where, 'delete_at' => null])->row_array();
			return $hasil;
		}
	}

	function insert_data()
	{
		$this->l_password->setEnc($this->db->escape_str($this->input->post('nim', true)));
		$this->l_password->setVal($this->db->escape_str($this->input->post('password', true)));
		$password = $this->l_password->getEnc();
		$field = array(
			'id' => generateID(),
			'nim' => $this->db->escape_str($this->input->post('nim', true)),
			'password' => $password,
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
		$this->db->update('pemilih', ['delete_at' => $this->delete_at]);


		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	// untuk update pemilih
	public function editpemilih($id)
	{
		$row = $this->db->get_where('pemilih', ['id' => $id])->row_array();
		$this->l_password->setEnc($row['nim']);
		$this->l_password->setVal($this->db->escape_str($this->input->post('password', true)));
		$password = $this->l_password->getEnc();
		$this->db->where('id', $id);
		$field = array(
			'nama' => $this->db->escape_str($this->input->post('nama', true)),
			'kelas' => $this->db->escape_str($this->input->post('kelas', true)),
			'password' => $password,
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
