<?php
@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
$time = 60000 * 60; // 1jam
@ini_set('max_execution_time', $time); // saya rubah eksekusi menjadi time PHP jadi 1jam lebih lama dari sebelumnya
defined('BASEPATH') or exit('No direct script access allowed');

class Datapem extends CI_Controller
{
	private $table = 'pemilih';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pemilih', 'mp');
		$this->load->library("l_session");
		$this->load->library('l_password');
		if ($this->l_session->admin()) {
			redirect('welcome_admin');
		}
	}

	public function index()
	{
		$this->load->view('datapemilih');
	}

	public function show_all()
	{
		$result = $this->mp->show_pemilih(null, 'pemilih', [
			'id', 'nim', 'nama', 'kelas', 'suara', 'aktivasi'
		]);
		header("Content-type:application/json");
		echo $result;
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

	private function existData(array $data, string $nim)
	{
		$count = count($data);
		for ($i = 0; $i < $count; $i++) {
			$item = $data[$i];

			if ($item['nim'] == $nim) {
				return true;
			}
		}

		return false;
	}

	public function import()
	{
		$data = $this->input->post('records');
		$data = json_decode($data, true);
		$oldData = $this->db->select("nim")->from($this->table)->get()->result_array();

		foreach ($data as $item) {
			$nim = $this->db->escape_str($this->security->xss_clean($item['nim']));
			$isExist = $this->existData($oldData, $nim);

			// Insert when empty
			if (!$isExist) {
				$this->l_password->setEnc($item['nim']);
				$this->l_password->setVal($this->db->escape_str($this->security->xss_clean($item['password'])));

				$pass = $this->l_password->getEnc();
				$user = [
					'id' => $this->db->escape_str($this->security->xss_clean(generateID())),
					'nim' => $nim,
					'password' => $pass,
					'nama' => $this->db->escape_str($this->security->xss_clean($item['nama'])),
					'kelas' => $this->db->escape_str($this->security->xss_clean($item['kelas'])),
					'suara' => $this->db->escape_str($this->security->xss_clean(0)),
					'aktivasi' => $this->db->escape_str($this->security->xss_clean(0)),
				];
				$this->db->insert($this->table, $user);
			}
		}

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
