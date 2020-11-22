<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datacal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_calon', 'mc');
		$this->load->library("l_session");
		if($this->l_session->admin()) {
			redirect('welcome_admin');
		}
	}

	public function index()
	{
		$this->load->view('datacalon');
	}

	public function show_all()
	{
		$result['data'] = $this->mc->show_calon()->result_array();
		header("Content-type:application/json");
		echo json_encode($result, true);
	}

	public function show_detail($id)
	{
		$result['data'] = $this->mc->show_calon($id);
		header("Content-type:application/json");
		echo json_encode($result, true);
	}

	public function insert()
	{
		$result	=	$this->mc->insert_data();
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil ditambah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menambah data');
		}
		redirect(base_url('Datacal'));
	}

	public function edit($id)
	{
		$result	=	$this->mc->editcalon($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil diubah');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal mengubah data');
		}
		redirect(base_url('Datacal'));
	}

	public function delete($id)
	{
		$result	=	$this->mc->deletecalon($id);
		if ($result) {
			$this->session->set_flashdata('success_msg', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('error_msg', 'Gagal menghapus data');
		}
		redirect(base_url('Datacal'));
	}

	public function hapussemua()
	{
		$result	=	$this->mc->truncate();
		redirect(base_url('Datacal'));
	}
}
