<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasilpilih extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_calon','mc');
		$this->load->model('M_pemilih','mp');
		$this->load->library("l_session");
		$this->l_session->admin();
    }
	
	public function index(){
		$x = [
			'data' 			=> $this->mc->show_calon(),
			'datapemilih' 	=> $this->mp->show_pemilih()
		];
		$this->load->view('hasilpemilihan', $x);
    }
	
	public function export(){
		$x = [
			'data'			=> $this->mc->show_calon(),
			'datapemilih'	=> $this->mp->show_pemilih()
		];
		$this->load->view('hasilpemilihanexport', $x);
    }
}
