<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datapem extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_pemilih','mp');
	}
	
	public function index(){
		$x['data']	=	$this->mp->show_pemilih();
		$this->load->view('datapemilih',$x);
    }
	
	public function export(){
		$x['data']	=	$this->mp->show_pemilih();
		$this->load->view('datapemilihexport',$x);
    }

	public function insert(){
		$result	=	$this->mp->insert_data();
		if($result){
			$this->session->set_flashdata('success_msg','Data berhasil ditambah');
		}else{
			$this->session->set_flashdata('error_msg','Gagal menambah data');
		}
		redirect(base_url('Datapem'));
	}

	public function edit($id){
		$result	=	$this->mp->editpemilih($id);
		if($result){
			$this->session->set_flashdata('success_msg','Data berhasil diubah');
		}else{
			$this->session->set_flashdata('error_msg','Gagal mengubah data');
		}
		redirect(base_url('Datapem'));
	}

	public function delete($id){
		$result	=	$this->mp->deletepemilih($id);
		if($result){
			$this->session->set_flashdata('success_msg','Data berhasil dihapus');
		}else{
			$this->session->set_flashdata('error_msg','Gagal menghapus data');
		}
		redirect(base_url('Datapem'));
	}

	public function resetpilihan($id){
		$result	=	$this->mp->reset($id);
		if($result){
			$this->session->set_flashdata('success_msg','Data pemilih berhasil direset');
		}else{
			$this->session->set_flashdata('error_msg','Gagal mereset data pemilih');
		}
		redirect(base_url('Datapem'));
	}

	public function hapussemua(){
		$result	=	$this->mp->truncate();
		redirect(base_url('Datapem'));
	}

	//ambil dari M_pemilih untuk aktivasi
	public function edita($id){
		$result	=	$this->mp->editaktivasi($id);
		if($result){
			$this->session->set_flashdata('success_msg','Data berhasil diubah');
		}else{
			$this->session->set_flashdata('error_msg','Gagal mengubah data');
		}
		redirect(base_url('Datapem'));
	}

	public function editbatal($id){
		$result	=	$this->mp->editaktivasibatal($id);
		if($result){
			$this->session->set_flashdata('success_msg','Data berhasil diubah');
		}else{
			$this->session->set_flashdata('error_msg','Gagal mengubah data');
		}
		redirect(base_url('Datapem'));
	}
}
