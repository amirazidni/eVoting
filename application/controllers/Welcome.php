<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	protected $data_id;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
		$this->load->library("session");
		$this->load->library('l_password');
		$this->data_id = $this->session->userdata();
	}

	private function index()
	{
		switch ($this->data_id['status']) {
			case "loginmahasiswa":
				redirect("form");
				break;
			case "loginadmin":
				redirect("dashboard");
				break;
			case "loginoperator":
				redirect("pengawas");
				break;
			case "loginpengawas":
				redirect("pengawas2");
				break;
			default:
				redirect("welcome/login");
				break;
		}
	}

	private function login()
	{
		$this->load->view('login');
	}

	private function aksi_login()
	{
		$username = $this->db->escape_str($this->input->post('username', true));
		$password = $this->db->escape_str($this->input->post('password', true));

		$this->l_password->setEnc($username);
		$this->l_password->setVal($password);

		$password = $this->l_password->getEnc();

		$where2 = [
			'nim' => $username,
			'password' => $password
		];
		$cek2 = $this->M_login->cek_login("pemilih", $where2)->num_rows();
		$cek_delete2 = $this->M_login->cek_login("pemilih", $where2)->row_array();
		if ($cek2 > 0) {
			$this->data_id = $this->session->userdata();
			$hasil = $this->db->query("SELECT *  FROM pemilih where nim='$username'");
			foreach ($hasil->result_array() as $i) :
				$k	=	$i['suara'];
				$ab	=	$i['aktivasi'];
				if ($ab != '0' && $k == 0) {
					$data_session = [
						'nim' => $username,
						'nama' => $i['nama'],
						'status' => "loginmahasiswa",
						'aktivasi' => $ab,
						'suara' => $k
					];
					$this->session->set_userdata($data_session);
					redirect(base_url("Form"));
				} else if ($k == 0 && $ab == 0) {
					redirect("welcome/login?pesan=belumabsen");
				} else if ($k != '0' && $ab != '0') {
					redirect("welcome/login?pesan=sudahmemilih");
				} else {
					redirect("welcome/login?pesan=gagal");
				}
			endforeach;
		} else if ($cek_delete2['delete_at'] == null) {
			redirect('welcome/login?pesan=hapus');
		} else {
			redirect('welcome/login?pesan=gagal');
		}
	}

	private function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome/login?pesan=logout');
	}
}
