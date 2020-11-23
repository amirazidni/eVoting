<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengawas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pemilih', 'mp');
		$this->load->library("l_session");
		if($this->l_session->pengawas()) {
			redirect('welcome_admin');
		}
	}

	public function index()
	{
		$this->load->view('viewpengawas');
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

	public function edit($id)
	{
		$result	=	$this->mp->editpemilih($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mengubah data');
		}
		redirect(base_url('pengawas'));
	}

	public function edita($id)
	{
		$result	=	$this->mp->editaktivasi($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mengubah data');
		}
		redirect(base_url('pengawas'));
	}

	public function resetpilihan($id)
	{
		$result	=	$this->mp->reset($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data pemilih berhasil direset');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mereset data pemilih');
		}
		redirect(base_url('pengawas'));
	}

	public function editbatal($id)
	{
		$result = $this->mp->editaktivasibatal($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mengubah data');
		}
		redirect(base_url('pengawas'));
	}

	public function hasilpemilihan()
	{
		$this->load->model('M_calon', 'mc');
		$x = [
			'data' 			=> $this->mc->show_calon(),
			'datapemilih'	=> $this->mp->show_pemilih()
		];
		$this->load->view('hasilpemilihanpeng', $x);
	}
}
