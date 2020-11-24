<?php defined('BASEPATH') or exit('No direct script access allowed');

class Vote extends CI_Controller
{
    public function index(int $index)
    {
        if (!$index) {
            $index = 0;
        }
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
        // $this->load->helper('captcha');
        // $config = array(
        //     'img_url' => base_url() . 'image_for_captcha/',
        //     'img_path' => 'image_for_captcha/',
        //     'img_height' => 45,
        //     'word_length' => 5,
        //     'img_width' => '45',
        //     'font_size' => 10
        // );
        // $captcha = create_captcha($config);

        // var_dump($captcha);

        // $vals = array(
        //     'word'          => 'Random word',
        //     'img_path'      => './assets/captcha/',
        //     'img_url'       => base_url('assets/captcha/'),
        //     'img_width'     => '200',
        //     'img_height'    => 50,
        //     'expiration'    => 7200,
        //     'word_length'   => strlen('Random word'),
        //     'font_size'     => 20,
        //     'color'        => array(
        //         'background' => array(255, 255, 255),
        //         'border' => array(255, 255, 255),
        //         'text' => array(0, 0, 0),
        //         'grid' => array(255, 40, 40)
        //     )
        // );

        // $cap = create_captcha($vals);
        // var_dump($cap);
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper', [
            'step' => 1
        ]);
        $this->load->view('pages/vote/VoteCaptcha');
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
        $this->load->view('pages/vote/Footer');
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
