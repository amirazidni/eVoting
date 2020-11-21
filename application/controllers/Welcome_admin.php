<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome_admin extends CI_Controller
{
  protected $session_id;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_login');
    $this->load->library('session');
    $this->session_id = $this->session->userdata();
  }

  public function index()
  {
    switch ($this->session_id['status']) {
      case "loginmahasiswa":
        redirect("form");
        break;
      case "loginadmin":
        redirect("dasbor");
        break;
      case "loginpengawas":
        redirect("pengawas");
        break;
      default:
        redirect("welcome_admin/login");
        break;
    }
  }

  public function login()
  {
    $this->load->view('login_admin');
  }

  public function aksi_login()
  {
    $username = $this->db->escape_str($this->input->post('username', true));
    $password = $this->db->escape_str($this->input->post('password', true));
    $where = [
      'username' => $username,
      'password' => $password
    ];
    $cek = $this->m_login->cek_login("admin", $where)->num_rows();
    $cek_delete = $this->m_login->cek_login("admin", $where)->row_array();
    $cek1 = $this->m_login->cek_login("operator", $where)->num_rows();
    $cek_delete1 = $this->m_login->cek_login("operator", $where)->row_array();
    if ($cek > 0) {
      $session = $this->m_login->cek_login('admin', $where)->row_array();
      $session_admin = [
        'id' => date("YmdHis") + $session['id'],
        'username' => $session['username'],
        'nama' => $session['nama'],
        'email' => $session['email'],
        'status' => "loginadmin",
      ];
      $this->session->set_userdata($session_admin);
      redirect(base_url("Dasbor"));
    } else if ($cek1 > 0) {
      $session = $this->m_login->cek_login('operator', $where)->row_array();
      $session_operator = [
        'id' => date("YmdHis") + $session['id'],
        'username' => $session['username'],
        'nama' => $session['namapengawas'],
        'status' => "loginpengawas",
      ];
      $this->session->set_userdata($session_operator);
      redirect(base_url("Pengawas"));
    } else if($cek_delete['delete_at'] != null || $cek_delete1['delete_at'] == null) {
      redirect('welcome/login?pesan=hapus');
    } else {
      redirect('welcome/login?pesan=gagal');
    }
  }
}
