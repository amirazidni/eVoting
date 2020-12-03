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
    $this->load->library('l_password');
    $this->session_id = $this->session->userdata();
  }

  public function index()
  {
    switch ($this->session_id['status']) {
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

    $this->l_password->setEnc($username);
    $this->l_password->setVal($password);

    $password = $this->l_password->getEnc();
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
        'id' => $session['id'],
        'username' => $session['username'],
        'nama' => $session['nama'],
        'email' => $session['email'],
        'status' => "loginadmin",
      ];
      $this->session->set_userdata($session_admin);
      redirect(base_url("dashboard"));
    } else if ($cek1 > 0) {
      $session = $this->m_login->cek_login('operator', $where)->row_array();
      if ($session['level'] == 'operator') {
        $session_operator = [
          'id' => $session['id'],
          'username' => $session['username'],
          'nama' => $session['namapengawas'],
          'status' => "loginoperator",
        ];
        $this->session->set_userdata($session_operator);
        redirect(base_url("pengawas"));
      } else if ($session['level'] == 'pengawas') {
        $session_operator = [
          'id' => $session['id'],
          'username' => $session['username'],
          'nama' => $session['namapengawas'],
          'status' => "loginpengawas",
        ];
        $this->session->set_userdata($session_operator);
        redirect(base_url("pengawas2"));
      }
    } else if ($cek_delete['delete_at'] != null || $cek_delete1['delete_at'] == null) {
      redirect('welcome_admin/login?pesan=hapus');
    } else {
      redirect('welcome_admin/login?pesan=gagal');
    }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect('welcome_admin/login?pesan=logout');
  }
}
