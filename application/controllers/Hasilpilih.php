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

		$this->load->library("l_session");
		if ($this->l_session->admin()) {
			redirect('welcome');
		}
	}

	public function index()
	{
		$candidates = $this->candidateModel->gets();
		$cleanVote = $this->voteModel->getCleanVote();
		$recapVote = $this->voteModel->getRecapVote();
		$voterCount = $this->voterModel->getCount();

		$vote = [];
		$voteAlpha = [];
		$total = 0;

		foreach ($cleanVote as $item) {
			$total++;
			if (isset($vote[$item['vote']])) {
				$vote[$item['vote']]++;
			} else {
				$vote[$item['vote']] = 1;
			}
		}

		foreach ($recapVote as $item) {
			$itemRecaps = explode(",", $item['recaps']);
			$itemVotes = explode(',', $item['votes']);
			$count = count($itemRecaps);

			for ($i = 0; $i < $count; $i++) {
				if ($itemRecaps[$i] == 'CLEAN') {
					$total++;
					if (isset($voteAlpha[$itemVotes[$i]])) {
						$voteAlpha[$itemVotes[$i]]++;
					} else {
						$voteAlpha[$itemVotes[$i]] = 1;
					}
				}
			}
		}

		$candidateCount = count($candidates);
		for ($i = 0; $i < $candidateCount; $i++) {
			$id = $candidates[$i]['id'];

			if (isset($vote[$id])) {
				$candidates[$i]['votes'] = $vote[$id];
			}

			if (isset($voteAlpha[$id])) {
				if (!isset($candidates[$i]['votes'])) {
					$candidates[$i]['votes'] = $voteAlpha[$id];
				} else {
					$candidates[$i]['votes'] += $voteAlpha[$id];
				}
			}
		}

		$data = [
			'candidates' => $candidates,
			'total' => $total,
			'voterCount' => $voterCount
		];
		$this->load->view('hasilpemilihan', $data);
	}

	public function export()
	{
		$calon = $this->candidateModel->show_calon();
		$cleanVote = $this->voteModel->getCleanVote();
		$recapVote = $this->voteModel->getRecapVote();
		$voterCount = $this->voterModel->getCount();

		$candidates = $calon->result_array();
		$vote = [];
		$voteAlpha = [];
		$total = 0;

		foreach ($cleanVote as $item) {
			$total++;
			if (isset($vote[$item['vote']])) {
				$vote[$item['vote']]++;
			} else {
				$vote[$item['vote']] = 1;
			}
		}

		foreach ($recapVote as $item) {
			$itemRecaps = explode(",", $item['recaps']);
			$itemVotes = explode(',', $item['votes']);
			$count = count($itemRecaps);

			for ($i = 0; $i < $count; $i++) {
				if ($itemRecaps[$i] == 'CLEAN') {
					$total++;
					if (isset($voteAlpha[$itemVotes[$i]])) {
						$voteAlpha[$itemVotes[$i]]++;
					} else {
						$voteAlpha[$itemVotes[$i]] = 1;
					}
				}
			}
		}

		$candidateCount = count($candidates);
		for ($i = 0; $i < $candidateCount; $i++) {
			$id = $candidates[$i]['id'];

			if (isset($vote[$id])) {
				$candidates[$i]['votes'] = $vote[$id];
			}

			if (isset($voteAlpha[$id])) {
				if (!isset($candidates[$i]['votes'])) {
					$candidates[$i]['votes'] = $voteAlpha[$id];
				} else {
					$candidates[$i]['votes'] += $voteAlpha[$id];
				}
			}
		}

		$data = [
			'candidates' => $candidates,
			'total' => $total,
			'voterCount' => $voterCount
		];
		$this->load->view('hasilpemilihanexport', $data);
	}

	public function testexport()
	{
		$calon = $this->candidateModel->show_calon();
		$cleanVote = $this->voteModel->getCleanVote();
		$recapVote = $this->voteModel->getRecapVote();
		$voterCount = $this->voterModel->getCount();

		$candidates = $calon->result_array();
		$vote = [];
		$voteAlpha = [];
		$total = 0;

		foreach ($cleanVote as $item) {
			$total++;
			if (isset($vote[$item['vote']])) {
				$vote[$item['vote']]++;
			} else {
				$vote[$item['vote']] = 1;
			}
		}

		foreach ($recapVote as $item) {
			$itemRecaps = explode(",", $item['recaps']);
			$itemVotes = explode(',', $item['votes']);
			$count = count($itemRecaps);

			for ($i = 0; $i < $count; $i++) {
				if ($itemRecaps[$i] == 'CLEAN') {
					$total++;
					if (isset($voteAlpha[$itemVotes[$i]])) {
						$voteAlpha[$itemVotes[$i]]++;
					} else {
						$voteAlpha[$itemVotes[$i]] = 1;
					}
				}
			}
		}

		$candidateCount = count($candidates);
		for ($i = 0; $i < $candidateCount; $i++) {
			$id = $candidates[$i]['id'];

			if (isset($vote[$id])) {
				$candidates[$i]['votes'] = $vote[$id];
			}

			if (isset($voteAlpha[$id])) {
				if (!isset($candidates[$i]['votes'])) {
					$candidates[$i]['votes'] = $voteAlpha[$id];
				} else {
					$candidates[$i]['votes'] += $voteAlpha[$id];
				}
			}
		}

		$data = [
			'candidates' => $candidates,
			'total' => $total,
			'voterCount' => $voterCount
		];

		print_r("data");
		print_r($data);
		// $this->load->view('hasilpemilihanexport', $data);
	}
}
