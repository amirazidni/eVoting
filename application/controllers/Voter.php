<?php defined('BASEPATH') or exit('No direct script access allowed');

class Voter extends CI_Controller
{
    public function index()
    {
        $this->guide();
    }

    private function guide()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper');
        $this->load->view('pages/vote/VoteGuide');
        $this->load->view('pages/vote/Footer');
    }

    private function captcha()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper');
        $this->load->view('pages/vote/VoteCaptcha');
        $this->load->view('pages/vote/Footer');
    }

    private function user()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper');
        $this->load->view('pages/vote/VoteUser');
        $this->load->view('pages/vote/Footer');
    }

    private function photo()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper');
        $this->load->view('pages/vote/VotePhoto');
        $this->load->view('pages/vote/Footer');
    }

    private function voting()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper');
        $this->load->view('pages/vote/VoteVoting');
        $this->load->view('pages/vote/Footer');
    }
}
