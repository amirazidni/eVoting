<?php defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->session->userdata();
    }

    public function index()
    {
        return redirect(base_url('operator/verify'));
    }

    public function verify()
    {
        return $this->load->view('pages/operator/Verify');
    }
}
