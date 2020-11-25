<?php defined('BASEPATH') or exit('No direct script access allowed');

class Voter extends CI_Controller
{
    private $deviceCookieName = '_SYS_DEVICE_';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('VoteModel', 'voteModel');
    }

    public function vote(int $index = 0)
    {
        // $cookie = array(
        //     'name'   => 'remember_me',
        //     'value'  => 'test',
        //     'expire' => '300',
        //     'secure' => false, // Set true when use HTTPS
        //     'httponly' => true
        // );
        // $this->input->set_cookie($cookie);

        // print_r("Cookie");
        // print_r($this->input->cookie('remember_me'));

        // $cookie_name = "testing";
        // $cookie_value = "John";
        // setcookie($cookie_name, $cookie_value, [
        //     'expires' => time() + 86400,
        //     'path' => '/',
        //     'httponly' => true,
        //     'samesite' => 'Strict',
        //     'secure' => false,
        //     'domain' => '',
        // ]);

        print_r("IP Address");
        print_r($this->input->ip_address());
        print_r($_COOKIE['testing']);

        switch ($index) {
            case 0:
                $this->guide();
                break;
            case 1:
                $this->captcha();
                break;
            case 2:
                $this->user();
                break;
            case 3:
                $this->photo();
                break;
            case 4:
                $this->voting();
                break;
            default:
                $this->guide();
                break;
        }
    }

    private function setupDevice()
    {
        $ip = $this->input->ip_address();
        $device = $_COOKIE[$this->deviceCookieName];
        $votes = $this->voteModel->get($device, $ip);
    }

    // VIEW //
    private function guide()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper', [
            'step' => 0
        ]);
        $this->load->view('pages/vote/VoteGuide');
        $this->load->view('pages/vote/Footer');
    }

    private function captcha()
    {
        $this->load->helper('captcha');
        $vals = array(
            'word'          => 'Randomword',
            'img_path'      => './assets/captcha/',
            'img_url'       => base_url('assets/captcha/'),
            'img_width'     => '300',
            'img_height'    => 100,
            'expiration'    => 4200,
            'word_length'   => 12,
            'font_size'     => 20,
            'color'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
        $cap = create_captcha($vals);
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper', [
            'step' => 1
        ]);
        $this->load->view('pages/vote/VoteCaptcha', [
            'captcha' => $cap
        ]);
        $this->load->view('pages/vote/Footer');
    }

    private function user()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper', [
            'step' => 2
        ]);
        $this->load->view('pages/vote/VoteUser');
        $this->load->view('pages/vote/Footer');
    }

    private function photo()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper', [
            'step' => 3
        ]);
        $this->load->view('pages/vote/VotePhoto');
        $this->load->view('pages/vote/FooterPhoto');
    }

    private function voting()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper', [
            'step' => 4
        ]);
        $this->load->view('pages/vote/VoteVoting');
        $this->load->view('pages/vote/Footer');
    }
}
