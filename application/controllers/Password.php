<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("l_encrypt");
    }

    public function enc($val="", $enc="") {
        $encode = new L_encrypt(base64_encode($val), $enc, 256, 'CBC');
        echo $this->db->escape_str(urlencode($encode->encrypt()));
    }
}
