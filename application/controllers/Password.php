<?php defined('BASEPATH') or exit('No direct script access allowed');

class Password extends CI_Controller
{
    protected $enc;
    protected $val;

    public function __construct()
    {
        parent::__construct();
        $this->load->library("l_encrypt");
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
        return $this->db->escape_str(urlencode($encode->encrypt()));
    }

    public function getEnc() {
        return $this->enc();
    }

    private function dec()
    {
        $val = $this->val;
        $enc = $this->enc;
        $decode = new L_encrypt(urldecode($val), $enc, 256, 'CBC');
        return $this->db->escape_str(base64_decode($decode->decrypt()));
    }

    public function getDec() {
        return $this->dec();
    }

    public function try() {
        $this->setVal("Google");
        $this->setEnc("123");
        echo $this->getEnc();
    }

    // cara makainya seperti ini
    // jika memakai <function>/<encryption>?val=<value>
}
