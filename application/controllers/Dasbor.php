<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dasbor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_calon', 'mc');
		$this->load->model('M_pemilih', 'mp');
		$this->load->library("l_session");
		if ($this->l_session->admin()) {
			redirect('welcome_admin');
		}
	}

	public function index()
	{
		$data = [
			'totalcalon'	=> $this->mc->jumlah_calon(),
			'data'      	=> $this->mc->show_calon(),
			'datapemilih1'	=> $this->mp->show_pemilih()
		];

		$this->load->view('dashboard', $data);
	}
	function update_realtime()
	{
		$pemilih = $this->mp->jumlah_pemilih();
		$calon = $this->mc->jumlah_calon();
		$suara_masuk = $this->mp->suara_masuk();
		$sisa = $pemilih - $suara_masuk;

		$result = array(
			'pemilih' => $pemilih,
			'calon' => $calon,
			'pilihan' => $suara_masuk,
			'sisa' => $sisa
		);
		echo $result = json_encode($result, JSON_PRETTY_PRINT);
	}
}
