<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
		$this->load->view('dashboard');
	}

	function updateRealtime()
	{
		$voterCount = $this->voterModel->getCount();
		$candidateCount = $this->candidateModel->getCount();
		$voteCount = $this->voteModel->getVoteCount();
		$recapVote = $this->voteModel->getRecapVoteCount();

		$result = [
			'voterCount' => $voterCount,
			'candidateCount' => $candidateCount,
			'voteCount' => $voteCount,
			'recapVote' => $recapVote
		];

		echo $result = json_encode($result, JSON_PRETTY_PRINT);
	}

	private function getVote(array $cleanVote, string $id)
	{
		$count = count($cleanVote);

		for ($i = 0; $i < $count; $i++) {
			if ($cleanVote[$i]['userId'] == $id) {
				return [
					'userId' => $cleanVote[$i]['vote'],
					'updatedAt' => $cleanVote[$i]['updatedAt'],
					'createdAt' => $cleanVote[$i]['createdAt']
				];
			}
		}

		return null;
	}

	public function getVoteRecap(array $recapVote, string $id)
	{
		$count = count($recapVote);

		for ($i = 0; $i < $count; $i++) {
			if ($recapVote[$i]['userId'] != $id) {
				continue;
			}

			$recaps = explode(',', $recapVote[$i]['recaps']);
			$votes = explode(',', $recapVote[$i]['votes']);
			$createdAts = explode(',', $recapVote[$i]['createdAts']);
			$updatedAts = explode(',', $recapVote[$i]['updatedAts']);
			$recapsCount = count($recaps);

			for ($j = 0; $j < $recapsCount; $j++) {
				if ($recaps[$j] == 'CLEAN') {
					return [
						'userId' => $votes[$j],
						'createdAt' => $createdAts[$j],
						'updatedAt' => $updatedAts[$j],
					];
				}
			}
		}

		return null;
	}

	private function getCandidateNumber(array $candidates, $id)
	{
		if (!$id) {
			return null;
		}

		$count = count($candidates);

		for ($i = 0; $i < $count; $i++) {
			if ($candidates[$i]['id'] == $id) {
				return $candidates[$i]['nomorurut'];
			}
		}
	}

	public function excel()
	{
		// Nim, Nama, Kelas, Vote, Note, Tanggal Voting //
		$spread = new Spreadsheet();
		$sheet = $spread->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Nim');
		$sheet->setCellValue('C1', 'Nama');
		$sheet->setCellValue('D1', 'kelas');
		$sheet->setCellValue('E1', 'Vote');
		$sheet->setCellValue('F1', 'Tanggal Vote');

		$voter = $this->voterModel->gets();
		$candidates = $this->candidateModel->gets();
		$cleanVote = $this->voteModel->getCleanVote();
		$recapVote = $this->voteModel->getRecapVoteExcel();

		$voterCount = count($voter);
		$dateFormat = 'Y-m-d H:i:s';

		for ($i = 0; $i < $voterCount; $i++) {
			$vote = $this->getVote($cleanVote, $voter[$i]['id']);

			if (!$vote) {
				$vote = $this->getVoteRecap($recapVote, $voter[$i]['id']);

				if (!$vote) {
					$voter[$i]['vote'] = null;
					$voter[$i]['updatedAt'] = null;
					$voter[$i]['createdAt'] = null;
					continue;
				}
			}

			$candidateNumber = $this->getCandidateNumber($candidates, $vote['userId']);
			$createdAt = DateTime::createFromFormat($dateFormat, $vote['createdAt']);
			$updatedAt = DateTime::createFromFormat($dateFormat, $vote['updatedAt']);

			$createdAt->modify('+ 7 hour');
			$updatedAt->modify('+ 7 hour');

			$voter[$i]['vote'] = $candidateNumber;
			$voter[$i]['updatedAt'] = $updatedAt->format('H:i:s d F Y');
			$voter[$i]['createdAt'] = $createdAt->format('H:i:s d F Y');
		}

		$index = 1;
		foreach ($voter as $item) {
			$updatedAt = '';

			if (isset($item['updatedAt'])) {
				$updatedAt = $item['updatedAt'];
			}

			$sheet->setCellValue('A' . ($index + 1), $index);
			$sheet->setCellValue('B' . ($index + 1), $item['nim']);
			$sheet->setCellValue('C' . ($index + 1), $item['nama']);
			$sheet->setCellValue('D' . ($index + 1), $item['kelas']);
			$sheet->setCellValue('E' . ($index + 1), $item['vote']);
			$sheet->setCellValue('F' . ($index + 1), $updatedAt);
			$index++;
		}

		$writer = new Xlsx($spread);
		$filename = uniqid();

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}
