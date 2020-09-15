<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dasbor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_calon', 'mc');
		$this->load->model('M_pemilih', 'mp');
	}

	public function index()
	{
		$data = [
			'totalcalon'	=> $this->mc->jumlah_calon(),
			'data'      	=> $this->mc->show_calon(),
			'datapemilih1'	=> $this->mp->show_pemilih()
		];

		$this->load->view('Dashboard', $data);
	}
}
