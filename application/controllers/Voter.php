<?php defined('BASEPATH') or exit('No direct script access allowed');

class Voter extends CI_Controller
{
    private $deviceCookieName   = '_SYS_DV_';
    private $deviceCaptchaName  = '_SYS_CP_';
    private $deviceUserName     = '_SYS_US_';
    private $devicePhotoName    = '_SYS_PO_';
    private $deviceParentname   = '_SYS_PR_';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('VoteModel', 'voteModel');
        $this->load->model('M_Calon', 'cadidateModel');
        $this->load->helper('cookie');
        $this->load->library('l_password');
    }

    public function index()
    {
        return redirect(base_url('voter/vote'));
    }

    public function vote()
    {
        // Setup //
        // Check Token
        // Check Captcha
        // Check User Login
        // Check Foto
        // Check Vote
        // User Vote Action (re-choose)

        // CREATE REVERSE CHECKING ENGINEER //
        // $index = 0;
        $isParentSet = isset($_COOKIE[$this->deviceParentname]);
        $isTokenSet = isset($_COOKIE[$this->deviceCookieName]);
        $isCaptchaSet = isset($_COOKIE[$this->deviceCaptchaName]);
        $isUserSet = isset($_COOKIE[$this->deviceUserName]);
        $isFotoSet = isset($_COOKIE[$this->devicePhotoName]);

        ///     LEVEL 0         ///
        ///     LEVEL GUIDE     ///
        // If Parent Token Exist
        if (!$isParentSet) {
            $this->clearCookies([
                $this->deviceCookieName,
                $this->deviceCaptchaName,
                $this->deviceUserName,
                $this->devicePhotoName,
                $this->deviceVoteName
            ]);
            $deviceToken = $this->generateID();
            $ip = $this->input->ip_address();
            $parentToken = $this->generateID();

            $this->setCookie($this->deviceCookieName, $deviceToken);
            $this->setCookie($this->deviceParentname, $parentToken);
            $this->voteModel->insertDeviceToken($ip, $parentToken, $deviceToken);

            return $this->guide();
        }

        // Check if Parents Exist in database
        $parentToken = $_COOKIE[$this->deviceParentname];
        $parents = $this->voteModel->getByParent($parentToken);

        if (count($parents) == 0) {
            $this->clearCookies([$this->deviceParentname]);
            return $this->refresh();
        }

        // Check if Device Exist
        if (!$isTokenSet) {
            $deviceToken = $this->generateID();
            $ip = $this->input->ip_address();
            $this->setCookie($this->deviceCookieName, $deviceToken);
            $this->voteModel->insertDeviceToken($ip, $parentToken, $deviceToken);
            return $this->guide();
        }

        // Check if Device Exist in database
        $deviceToken = $_COOKIE[$this->deviceCookieName];
        $devices = $this->voteModel->getByToken($deviceToken);

        if (count($devices) == 0) {
            $this->clearCookies([$this->deviceCookieName]);
            return $this->refresh();
        }


        ///     LEVEL 1           ///
        ///     LEVEL CAPTCHA     ///
        // Is Captcha Exist
        $device = $devices[0];
        if (!$isCaptchaSet) {
            // Also Check is he submitting captcha
            $isCaptchaPost = isset($_POST['captcha']);
            $error = '';

            if ($isCaptchaPost) {
                $captchaPost = $_POST['captcha'];

                if ($captchaPost == $device['captchaToken']) {
                    $this->setCookie($this->deviceCaptchaName, $captchaPost);
                    return redirect(base_url('voter/vote'));
                } else {
                    $error = "Captcha yang anda masukan salah.\n Coba Lagi!.";
                }
            }

            $newCaptcha = base_convert(rand(), 10, 36);
            $this->voteModel->insertCaptchaToken($deviceToken, $newCaptcha);
            return $this->captcha($newCaptcha, $error);
        }

        $captcha = $_COOKIE[$this->deviceCaptchaName];
        if ($captcha != $device['captchaToken']) {
            $this->clearCookies([$this->deviceCaptchaName]);
            return $this->refresh();
        }

        ///     LEVEL 2     ///
        ///     LEVEL user  ///
        if (!$isUserSet) {
            $isUserInput = isset($_POST['nim']);

            if ($isUserInput) {
                $nim = $_POST['nim'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];

                $nim = $this->db->escape_str($nim);
                $password = $this->db->escape_str($password);
                $phone = $this->db->escape_str($phone);

                $this->l_password->setEnc($nim);
                $this->l_password->setVal($password);

                $pass = $this->l_password->getEnc();
                $users = $this->voteModel->checkUserExist($nim, $pass);

                if (count($users) == 0) {
                    return $this->user("User belum terdaftar");
                }

                $user = $users[0];
                $usersVoted = $this->voteModel->checkUserVoted($user['id']);

                // TODO: Check if User really voted
                if (count($usersVoted) > 0) {
                    return $this->user("User sudah melakukan voting.\n Hubungi Operator jika merasa belum pernah melakukan voting");
                }

                $this->voteModel->insertUser($deviceToken, $user['id'], $phone);
                $this->setCookie($this->deviceUserName, $user['id']);
                return $this->refresh();
            }

            return $this->user();
        }

        $userId = $_COOKIE[$this->deviceUserName];
        if ($userId != $device['userId']) {
            $this->clearCookies([$this->deviceUserName]);
            return $this->refresh();
        }

        ///     LEVEL 3      ///
        ///     LEVEL Photo  ///
        // Should Have Captcha, Token, User Login
        if (!$isFotoSet) {
            return $this->photo();
        }
        $photo = $_COOKIE[$this->devicePhotoName];
        if ($photo != substr($device['photoPath'], 0, strlen($photo))) {
            $this->clearCookies([$this->devicePhotoName]);
            return $this->refresh();
        }

        // Vote Level 4 //
        // Voting
        // Should Have Captcha, Token, User Login, Foto
        $vote = $device['vote'];
        if (!$vote) {
            $isVoting = isset($_POST['voteId']);

            if ($isVoting) {
                $voting = $_POST['voteId'];

                $this->voteModel->setVote($deviceToken, $voting);
                return $this->refresh();
            }

            $res = $this->cadidateModel->getsCadidate();
            return $this->voting($res);
        }

        // Vote Level 5 //
        // Finish
        // Should Have Captcha, Token, User Login, Foto, Vote
        // Use same device immediately
        return $this->finish();
    }

    // BECAUSE USING JAVACRIPT
    // Return a JSON instead
    public function uploadPhoto()
    {
        $isTokenSet = isset($_COOKIE[$this->deviceCookieName]);

        if (!$isTokenSet) {
            return $this->refresh();
        }

        $baseName = $this->generateID();
        $imgName = $baseName . '.png';
        $img = $_FILES['image'];

        if ($img['error'] == UPLOAD_ERR_OK) {
            $tmpName = $img['tmp_name'];

            move_uploaded_file($tmpName, "assets/voter/$imgName");
            $this->voteModel->updatePhoto($_COOKIE[$this->deviceCookieName], $imgName);
            $this->setCookie($this->devicePhotoName, $baseName);
        } else {
            // TODO: When error occured
            // Do Something
        }

        header('Content-Type: application/json');
        echo json_encode([
            'ok' => true,
            'data' => [
                'image' => $imgName
            ]
        ]);
    }

    private function refresh()
    {
        return redirect(base_url('voter/vote'));
    }

    private function setCookie(string $key, string $value)
    {
        setcookie($key, $value, [
            'expires' => $this->getExpires(),
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Strict',
            'secure' => false, // TODO: Set to true when using https
            'domain' => '',
        ]);
    }

    private function clearCookies(array $cookies)
    {
        foreach ($cookies as $key => $item) {
            delete_cookie($item);
        }
    }

    private function getOneDay()
    {
        return 3600 * 24 * 7;
    }

    private function getExpires()
    {
        return time() + $this->getOneDay();
    }

    private function generateID()
    {
        $version =  1;
        $random = base_convert(rand(), 10, 36);
        $unique = uniqid();

        return $unique . $version . $random;
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

    private function captcha(string $captcha, string $error)
    {
        $this->load->helper('captcha');
        $vals = array(
            'word'          => $captcha,
            'img_path'      => './assets/captcha/',
            'img_url'       => base_url('assets/captcha/'),
            'img_width'     => '300',
            'img_height'    => 100,
            'expiration'    => $this->getOneDay(),
            'word_length'   => strlen($captcha),
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
            'captcha' => $cap,
            'error' => $error
        ]);
        $this->load->view('pages/vote/Footer');
    }

    private function user(string $error = "")
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper', [
            'step' => 2
        ]);
        $this->load->view('pages/vote/VoteUser', [
            "error" => $error
        ]);
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

    private function voting(array $candidates)
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteStepper', [
            'step' => 4,
            'candidates' => $candidates
        ]);
        $this->load->view('pages/vote/VoteVoting');
        $this->load->view('pages/vote/Footer');
    }

    private function finish()
    {
        $this->load->view('pages/vote/Header');
        $this->load->view('pages/vote/VoteFinish');
        $this->load->view('pages/vote/Footer');
    }
}
