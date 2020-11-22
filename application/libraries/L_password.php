<?php defined("BASEPATH") or exit("No direct script access allowed!");

class L_password
{
  private $enc;
  private $val;

  public function __construct()
  {
    $this->CI =& get_instance();
    $this->CI->load->library("l_encrypt");
  }

  public function setVal($val)
  {
    $this->val = $val;
  }

  public function setEnc($enc)
  {
    $this->enc = $enc;
  }

  private function enc()
  {
    $val = $this->val;
    $enc = $this->enc;
    $encode = new L_encrypt(base64_encode($val), $enc, 256, 'CBC');
    return $this->CI->db->escape_str(urlencode($encode->encrypt()));
  }

  public function getEnc()
  {
    return $this->enc();
  }

  private function dec()
  {
    $val = $this->val;
    $enc = $this->enc;
    $decode = new L_encrypt(urldecode($val), $enc, 256, 'CBC');
    return $this->CI->db->escape_str(base64_decode($decode->decrypt()));
  }

  public function getDec()
  {
    return $this->dec();
  }
}
