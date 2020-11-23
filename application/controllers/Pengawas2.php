<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengawas2 extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
		$this->load->model('M_pemilih', 'mp');
		$this->load->library("l_session");
		if($this->l_session->pengawas2()) {
			redirect('welcome_admin');
		}
  }

  public function index()
	{
		$this->load->view('viewpengawas2');
	}

	public function show_all()
	{
		$result = $this->mp->show_pemilih(null, 'pemilih', [
			'id', 'nim', 'nama', 'kelas', 'suara', 'aktivasi'
		]);
		header("Content-type:application/json");
		echo $result;
	}
}
