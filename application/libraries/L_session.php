<?php defined("BASEPATH") or exit("No direct script access allowed!");

class L_session
{

  protected $CI;
  protected $data_id;

  public function __construct()
  {
    $this->CI = &get_instance();
    $this->data_id = $this->CI->session->userdata();
  }

  public function isAuth()
  {
    return isset($this->data_id["status"]);
  }

  public function admin()
  {
    if (
      $this->data_id["status"] != "loginadmin" &&
      $this->data_id["id"] != "admin1"
    ) {
      return true;
    }
  }

  public function mahasiswa()
  {
    if (
      $this->data_id["status"] != "loginmahasiswa" &&
      $this->data_id["aktivasi"] == 0 ||
      $this->data_id["suara"] != 0
    ) {
      return true;
    }
  }

  public function pengawas()
  {
    if (
      $this->data_id["status"] != "loginoperator"
    ) {
      return true;
    }
  }

  public function pengawas2()
  {
    if (
      $this->data_id["status"] != "loginpengawas"
    ) {
      return true;
    }
  }
}
