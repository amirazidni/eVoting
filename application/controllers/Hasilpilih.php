<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasilpilih extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('VoteModel', 'voteModel');
		$this->load->model('M_calon', 'candidateModel');
		$this->load->model('M_pemilih', 'voterModel');

		$this->load->model('M_calon', 'mc');
		$this->load->model('M_pemilih', 'mp');
		$this->load->library("l_session");
		if ($this->l_session->admin()) {
			redirect('welcome');
		}
	}

	public function index()
	{
		$cleanVote = $this->voteModel->getCleanVote();
		$recapVote = $this->voteModel->getRecapVote();

		print_r("Recap Vote");
		print_r($recapVote);
		print_r("Clean VOte");
		print_r($cleanVote);

		// $x = [
		// 	'data' 			=> $this->mc->show_calon(),
		// 	'datapemilih' 	=> $this->mp->show_pemilih()
		// ];
		// $this->load->view('hasilpemilihan', $x);
	}

	public function export()
	{
		$x = [
			'data'			=> $this->mc->show_calon(),
			'datapemilih'	=> $this->mp->show_pemilih()
		];
		$this->load->view('hasilpemilihanexport', $x);
	}
}
