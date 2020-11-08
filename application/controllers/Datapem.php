<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datapem extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pemilih', 'mp');
		$this->load->library("l_session");
		$this->l_session->admin();
	}

	public function index()
	{
		$this->load->view('datapemilih');
	}

	public function show_all()
	{
		$result['data'] = $this->mp->show_pemilih()->result_array();
		header("Content-type:application/json");
		echo json_encode($result, true);
	}

	public function show_detail($id)
	{
		$result['data'] = $this->mp->show_pemilih($id);
		header("Content-type:application/json");
		echo json_encode($result, true);
	}

	public function export()
	{
		$x['data']	=	$this->mp->show_pemilih();
		$this->load->view('datapemilihexport', $x);
	}

	public function import()
	{
		$data = $this->input->post('records');
		$data = json_decode($data, true);
		if (!empty($this->db->get('pemilih')->num_rows())) {
			$query 	= $this->db->query("SELECT * FROM pemilih ORDER BY id DESC LIMIT 1");
			$result = $query->result_array();
			$interval = date("YmdHis") + $result[0]['id'];
		} else {
			$interval = date("YmdHis");
		}
		foreach ($data as $d) {
			$object = [
				'id' => $this->db->escape_str($this->security->xss_clean($interval++)),
				'nim' => $this->db->escape_str($this->security->xss_clean($d['nim'])),
				'password' => $this->db->escape_str($this->security->xss_clean(md5($d['password']))),
				'nama' => $this->db->escape_str($this->security->xss_clean($d['nama'])),
				'kelas' => $this->db->escape_str($this->security->xss_clean($d['kelas'])),
				'suara' => $this->db->escape_str($this->security->xss_clean(0)),
				'aktivasi' => $this->db->escape_str($this->security->xss_clean(0)),
			];
			$persamaan = $this->db->get_where('pemilih', ['nim' => $object['nim']])->row_array();
			if ($persamaan['nim'] == $object['nim']) {
				false;
				// echo json_encode('Data telah diinput!', true);
			} else {
				$this->db->insert('pemilih', $object);
				true;
				// echo json_encode('Berhasil disimpan!', true);
			}
		};
		header("Content-type: application/json");
		echo json_encode('Berhasil disimpan!', true);
	}

	public function insert()
	{
		$result	=	$this->mp->insert_data();
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil ditambah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menambah data');
		}
		redirect(base_url('Datapem'));
	}

	public function edit($id)
	{
		$result	=	$this->mp->editpemilih($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mengubah data');
		}
		redirect(base_url('Datapem'));
	}

	public function delete($id)
	{
		$result	=	$this->mp->deletepemilih($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data');
		}
		redirect(base_url('Datapem'));
	}

	// public function resetpilihan($id)
	// {
	// 	$result	=	$this->mp->reset($id);
	// 	if ($result) {
	// 		$this->session->set_flashdata('success_msg', 'Data pemilih berhasil direset');
	// 	} else {
	// 		$this->session->set_flashdata('error_msg', 'Gagal mereset data pemilih');
	// 	}
	// 	redirect(base_url('Datapem'));
	// }

	public function hapussemua()
	{
		$result	=	$this->mp->truncate();
		redirect(base_url('Datapem'));
	}

	//ambil dari M_pemilih untuk aktivasi
	public function edita($id)
	{
		$result	=	$this->mp->editaktivasi($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mengubah data');
		}
		redirect(base_url('Datapem'));
	}

	public function editbatal($id)
	{
		$result	=	$this->mp->editaktivasibatal($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mengubah data');
		}
		redirect(base_url('Datapem'));
	}
}
