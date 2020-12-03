<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// MODELS
		$this->load->model('M_calon', 'candidateModel');
		$this->load->model('M_pemilih', 'voterModel');
		$this->load->model('VoteModel', 'voteModel');

		// LIBRARIES
		$this->load->library("l_session");
		if ($this->l_session->admin()) {
			redirect('welcome_admin');
		}
	}

	public function index()
	{
		// $data = [
		// 	'totalcalon'	=> $this->candidateModel->jumlah_calon(),
		// 	'data'      	=> $this->candidateModel->show_calon(),
		// 	'datapemilih1'	=> $this->voterModel->show_pemilih(),
		// ];


		// $candidateCount = $this->candidateModel->getCount();
		// $data = [
		// 	'candidateCount' => $candidateCount,
		// 	''
		// ];

		$this->load->view('dashboard');
	}

	function updateRealtime()
	{
		$voterCount = $this->voterModel->getCount();
		$candidateCount = $this->candidateModel->getCount();
		// $voteCount = $this->voteModel->getCount();
		// $cleanVote = $this->voteModel->getCleanVoteCount();
		// $dirtyVote = $this->voteModel->getDirtyVoteCount();
		// $recapVote = $this->voteModel->getRecapVoteCount();
		// $pemilih = $this->voterModel->getCount();
		// $calon = $this->candidateModel->jumlah_calon();
		// $suara_masuk = $this->voterModel->suara_masuk();
		// $sisa = $pemilih - $suara_masuk;

		$result = [
			'voterCount' => $voterCount,
			'candidateCount' => $candidateCount,
			// 'voteCount' => $voteCount,
			// 'cleanVote' => $cleanVote,
			// 'dirtyVote' => $dirtyVote,
			// 'recapVote' => $recapVote
		];
		// $result = array(
		// 	'pemilih' => $pemilih,
		// 	'calon' => $calon,
		// 	'pilihan' => $suara_masuk,
		// 	'sisa' => $sisa
		// );
		echo $result = json_encode($result, JSON_PRETTY_PRINT);
	}
}
