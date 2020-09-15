<?php defined("BASEPATH") or exit("No direct script access allowed!");

class L_session {
    
    protected $CI;
    protected $data_id;

    public function __construct() {
        $this->CI =& get_instance();
        $this->data_id = $this->CI->session->userdata();
    }
    
    public function admin() {
        if($this->data_id["status"] != "loginadmin" &&
			$this->data_id["id"] != "admin1") {
			redirect("welcome");
		}
    }

    public function mahasiswa() {
		if($this->data_id["status"] != "loginmahasiswa" && 
			$this->data_id["status"] == 0 ||
			$this->data_id["suara"] != 0) {
			redirect("welcome");
		}
    }

    public function pegawai() {
        if($this->data_id["status"] != "loginpengawas") {
			redirect("welcome");
		}
    }
}
