<?php defined('BASEPATH') or exit('No direct script access allowed');

class Voter extends CI_Controller
{
    private $deviceParentname   = '_SYS_PR_';
    private $deviceCookieName   = '_SYS_DV_';

    private $deviceCaptchaName  = '_SYS_CP_';
    private $deviceUserName     = '_SYS_US_';
    private $devicePhotoName    = '_SYS_PO_';

    private $forceKeyName       = '_forceKey_';

    public function __construct()
    {
        parent::__construct();

        $hour = (int)date('H');
        $timeVote = $hour >= 8 && $hour < 18;
        if (uri_string() != 'voter/notyet') {
            if (!$timeVote) {
                header('Location: ' . base_url('voter/notyet'));
                exit();
            }
        }

        // Models
        $this->load->model('VoteModel', 'voteModel');
        $this->load->model('M_calon', 'cadidateModel');
        $this->load->model('ComitteeModel', 'comitteeModel');
        $this->load->model('M_pengawas', 'operatorModel');
        $this->load->model('UserOverlapModel', 'userOverlapModel');

        // Helper
        $this->load->helper('cookie');

        // Library
        $this->load->library('l_password');
    }

    public function index()
    {
        return redirect(base_url('voter/vote'));
    }

    public function notyet()
    {
        $hour = (int)date('H');
        $timeVote = $hour >= 8 && $hour < 18;

        if ($timeVote) {
            return $this->refresh();
        }
        return $this->load->view('pages/NotYet');
    }

    public function testTime()
    {
        $hour = date('H');
        $zone = date('e');
        $day = date('j');
        $month = date('m');
        $year = date('Y');

        echo $hour;
        echo $zone;
        echo $day;
        echo $month;
        echo $year;
    }

    public function force(string $key)
    {
        $forceKey = $this->getForceKey();

        if ($forceKey == $key) {
            $this->setCookie($this->forceKeyName, $forceKey);
        }

        return $this->refresh();
    }

    public function vote()
    {
        // CREATE REVERSE CHECKING ENGINEER //
        // $index = 0;
        $isParentSet = isset($_COOKIE[$this->deviceParentname]);
        $isTokenSet = isset($_COOKIE[$this->deviceCookieName]);
        $isCaptchaSet = isset($_COOKIE[$this->deviceCaptchaName]);
        $isUserSet = isset($_COOKIE[$this->deviceUserName]);
        $isFotoSet = isset($_COOKIE[$this->devicePhotoName]);

        ///     LEVEL 0         ///
        ///     LEVEL GUIDE     ///
        // If Parent Not Token Exist
        if (!$isParentSet) {
            $this->clearCookies([
                $this->deviceCookieName,
                $this->deviceCaptchaName,
                $this->deviceUserName,
                $this->devicePhotoName
            ]);
            $deviceToken = generateID();
            $ip = $this->input->ip_address();
            $parentToken = generateID();

            $this->setCookie($this->deviceCookieName, $deviceToken);
            $this->setCookie($this->deviceParentname, $parentToken);
            $this->voteModel->insertDeviceToken($ip, $parentToken, $deviceToken);

            return $this->refresh();
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
            $deviceToken = generateID();
            $ip = $this->input->ip_address();
            $this->setCookie($this->deviceCookieName, $deviceToken);
            $this->voteModel->insertDeviceToken($ip, $parentToken, $deviceToken);
            return $this->refresh();
        }

        // Check if Device Exist in database
        $deviceToken = $_COOKIE[$this->deviceCookieName];
        $devices = $this->voteModel->getByToken($deviceToken);
        $device = $devices[0];

        if (count($devices) == 0) {
            $this->clearCookies([$this->deviceCookieName]);
            return $this->refresh();
        }

        // Set Comittee Name
        $comitteeName = '';
        if (isset($device['comitteeCode'])) {
            $comitteeName = $this->getComitteeName($device['comitteeCode']);
        }

        // render guide if not isGuided
        if (!$device['isGuided']) {
            $isGuided = isset($_POST['guided']);

            if ($isGuided) {
                $this->voteModel->setGuided($deviceToken, true);
                return $this->refresh();
            }

            return $this->guide($comitteeName);
        }

        ///     LEVEL 1           ///
        ///     LEVEL CAPTCHA     ///
        // Is Captcha Exist
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
            return $this->captcha($newCaptcha, $comitteeName, $error);
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

                $users = $this->voteModel->getUserByNim($nim);

                if (count($users) == 0) {
                    return $this->user($comitteeName, "User belum terdaftar");
                }

                // $users = $this->voteModel->checkUserExist($nim, $pass);
                $this->l_password->setEnc($nim);
                $this->l_password->setVal($password);

                $pass = $this->l_password->getEnc();
                $count = count($users);
                $found = false;
                $user = '';

                for ($i = 0; $i < $count; $i++) {
                    if (!$found) {
                        $item = $users[$i];
                        if ($item['password'] == $pass) {
                            $found = true;
                            $user = $item;
                        }
                    }
                }

                if (!$found) {
                    return $this->user($comitteeName, "Password yang anda masukan salah");
                }

                if (!$device['isVerify']) {
                    $usersVoted = $this->voteModel->checkUserVoted($user['id']);

                    if (count($usersVoted) > 0) {

                        $this->voteModel->setPhone($deviceToken, $phone);
                        $this->userOverlapModel->insertUserOverlap($deviceToken, $user['id'], $phone);

                        return $this->user($comitteeName, "User sudah melakukan voting.\n Hubungi Operator jika merasa belum pernah melakukan voting!.");
                    }
                }

                $this->voteModel->insertUser($deviceToken, $user['id'], $phone);
                $this->setCookie($this->deviceUserName, $user['id']);
                return $this->refresh();
            }

            return $this->user($comitteeName);
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
            return $this->photo($comitteeName);
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
            return $this->voting($res, $comitteeName);
        }

        // Vote Level 5 //
        // Finish
        // Should Have Captcha, Token, User Login, Foto, Vote
        // Use same device immediately
        return $this->finish($device);
    }

    public function newVote()
    {
        $this->clearCookies([
            $this->deviceCaptchaName,
            $this->devicePhotoName,
            $this->deviceUserName
        ]);

        $deviceToken = generateID();
        $parentToken = $_COOKIE[$this->deviceParentname];
        $ip = $this->input->ip_address();

        $this->setCookie($this->deviceCookieName, $deviceToken);
        $this->voteModel->insertDeviceToken($ip, $parentToken, $deviceToken);

        return $this->refresh();
    }

    public function voteWithComittee(string $param = '')
    {
        $comitteeKey = $this->cache->get('comitteeKey');
        if (!$comitteeKey) {
            $file = fopen('comittee_key', 'r');
            $content = fread($file, filesize('comittee_key'));
            fclose($file);

            $comitteeKey = $content;
            $this->setCache('comitteeKey', $content);
        }

        if ($param != $comitteeKey) {
            return $this->load->view('pages/ErrorComittee', [
                'error' => 'Different Param Key'
            ]);
        }

        $isKey = isset($_GET['key']);
        if (!$isKey) {
            return $this->load->view('pages/ErrorComittee', [
                'error' => 'Key Value is not setted'
            ]);
        }

        $comitteeCode = $_GET['key'];
        $comittee = $this->comitteeModel->getByKey($comitteeCode);
        if (count($comittee) == 0) {
            return $this->load->view('pages/ErrorComittee', [
                'error' => 'Key Value is wrong'
            ]);
        }

        $comittee = $comittee[0];
        $ip = $this->input->ip_address();
        if (!$comittee['registerIp']) {
            $this->clearCookies([
                $this->deviceCaptchaName,
                $this->deviceUserName,
                $this->devicePhotoName
            ]);

            $parentToken = generateID();
            $deviceToken = generateID();

            $this->setCookie($this->deviceCookieName, $deviceToken);
            $this->setCookie($this->deviceParentname, $parentToken);

            $this->comitteeModel->registerIp($comitteeCode, $ip);
            $this->voteModel->insertDeviceTokenWithComittee($ip, $parentToken, $deviceToken, $comitteeCode);

            return $this->refresh();
        }

        if ($comittee['registerIp'] == $ip) {
            // Clear Some Cookie
            // And Add Comittee Code
            $this->clearCookies([
                $this->deviceCaptchaName,
                $this->deviceUserName,
                $this->devicePhotoName
            ]);

            $isParentSet = isset($_COOKIE[$this->deviceParentname]);

            $parentToken = '';
            $deviceToken = '';

            if ($isParentSet) {
                $parentToken = $_COOKIE[$this->deviceParentname];
                $deviceToken = generateID();

                $this->setCookie($this->deviceCookieName, $deviceToken);
            } else {
                $deviceToken = generateID();
                $parentToken = generateID();

                $this->setCookie($this->deviceCookieName, $deviceToken);
                $this->setCookie($this->deviceParentname, $parentToken);
            }

            $this->voteModel->insertDeviceTokenWithComittee($ip, $parentToken, $deviceToken, $comitteeCode);

            return $this->refresh();
        }

        return $this->load->view('pages/ErrorComittee', [
            'error' => 'Key Value already registered with different device'
        ]);
    }

    public function comitteeMessage()
    {
        $isTokenSet = isset($_COOKIE[$this->deviceCookieName]);

        if (!$isTokenSet) {
            echo ("<p style='text-align: center; margin-top: 42px;'>Error: cannot call operator</p>");
            return;
        }

        $deviceToken = $_COOKIE[$this->deviceCookieName];
        $device = $this->voteModel->getByToken($deviceToken)[0];
        $operatorId = '';

        // Set Operator
        if (!isset($device['operatorId'])) {
            $operators = $this->operatorModel->getOperators();
            $index = rand() % count($operators);
            $operator = $operators[$index];
            $operatorId = $operator['id'];

            $this->voteModel->setOperatorId($deviceToken, $operator['id']);
        } else {
            $operatorId = $device['operatorId'];
        }

        $operator = $this->operatorModel->getOperator($operatorId)[0];
        $text = "Halo akun saya sudah digunakan untuk voting oleh orang lain.%0ANomor saya : " . $device['phone'];

        redirect("https://api.whatsapp.com/send?phone=" . $operator['phone'] . "&text=$text");
    }

    public function reGuide()
    {
        $isParentSet = isset($_COOKIE[$this->deviceParentname]);
        $isTokenSet = isset($_COOKIE[$this->deviceCookieName]);

        if ($isParentSet && $isTokenSet) {
            $deviceToken = $_COOKIE[$this->deviceCookieName];
            $this->voteModel->setGuided($deviceToken, false);
        }
        return $this->refresh();
    }

    public function insecureissues()
    {
        return $this->load->view('pages/Insecure');
    }

    // UPLOAD IMAGE FROM DESKTOP BROWSER //
    // BECAUSE USING JAVACRIPT
    // Return a JSON instead
    public function uploadPhoto()
    {
        $isTokenSet = isset($_COOKIE[$this->deviceCookieName]);

        if (!$isTokenSet) {
            return $this->refresh();
        }

        $baseName = generateID();
        $imgName = $baseName . '.png';
        $img = $_FILES['image'];

        header('Content-Type: application/json');

        if ($img['error'] == UPLOAD_ERR_OK) {
            $tmpName = $img['tmp_name'];

            move_uploaded_file($tmpName, "assets/voter/$imgName");
            $this->voteModel->updatePhoto($_COOKIE[$this->deviceCookieName], $imgName);
            $this->setCookie($this->devicePhotoName, $baseName);
        } else {
            echo json_encode([
                'ok' => false,
                'message' => 'Error when uploading photo.'
            ]);

            return;
        }

        echo json_encode([
            'ok' => true,
            'data' => [
                'image' => $imgName
            ]
        ]);
    }

    // UPLOAD IMAGE FROM MOBILE BROWSER //
    public function uploadPhotoMobile()
    {
        $isTokenSet = isset($_COOKIE[$this->deviceCookieName]);

        if (!$isTokenSet) {
            return $this->refresh();
        }

        $baseName = generateID();
        $imgName = $baseName . '.png';
        $img = $_FILES['image'];

        if ($img['error'] == UPLOAD_ERR_OK) {
            $tmpName = $img['tmp_name'];

            move_uploaded_file($tmpName, "assets/voter/$imgName");

            $this->voteModel->updatePhoto($_COOKIE[$this->deviceCookieName], $imgName);
            $this->setCookie($this->devicePhotoName, $baseName);
        }

        $this->refresh();
    }

    public function getForceKey()
    {
        $forceKey = $this->getCache("forcekey");
        if (!$forceKey) {
            $file = fopen('force_key', 'r');
            $forceKey = fread($file, filesize('comittee_key'));
            fclose($file);
        }

        return $forceKey;
    }

    private function getComitteeName(string $comitteeCode): string
    {
        if (!$comitteeCode) {
            return '';
        }

        $cachedComitteeName = $this->getCache($comitteeCode);
        if ($cachedComitteeName) {
            return $cachedComitteeName;
        }

        $res = $this->comitteeModel->getByKey($comitteeCode);
        $newComitteeName = $res[0]['comitteeName'];

        $this->setCache($comitteeCode, $newComitteeName);

        return $newComitteeName;
    }

    private function refresh()
    {
        return redirect(base_url('voter/vote'));
    }

    private function getCache(string $key)
    {
        return $this->cache->get($key);
    }

    private function setCache(string $key, string $value, int $time = 60 * 60 * 24 * 7)
    {
        $this->cache->save($key, $value, $time);
    }

    private function setCookie(string $key, string $value)
    {
        setcookie($key, $value, [
            'expires' => time() + 3600 * 24 * 7,
            'path' => '/',
            'httponly' => true,
            'samesite' => 'Strict',
            'secure' => false, // TODO: Set to true when using https
            'domain' => '',
        ]);
    }

    private function clearCookies(array $cookies)
    {
        foreach ($cookies as $item) {
            if (isset($_COOKIE[$item])) {
                delete_cookie($item);
            }
        }
    }

    // VIEW //
    private function guide(string $comitteeName)
    {
        $this->load->view('pages/vote/VoteGuide', [
            'step' => 0,
            'comitteeName' => $comitteeName
        ]);
    }

    private function captcha(string $captcha, string $comitteeName, string $error)
    {
        $this->load->helper('captcha');
        $vals = array(
            'word'          => $captcha,
            'img_path'      => './assets/captcha/',
            'img_url'       => base_url('assets/captcha/'),
            'img_width'     => '250',
            'img_height'    => 150,
            'word_length'   => strlen($captcha),
            'font_path'     => FCPATH . 'assets/font/Roboto-MediumItalic.ttf',
            'font_size'     => 42,
            'color'         => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
        $cap = create_captcha($vals);

        $this->load->view('pages/vote/VoteCaptcha', [
            'captcha' => $cap,
            'error' => $error,
            'step' => 1,
            'comitteeName' => $comitteeName
        ]);
    }

    private function user(string $comitteeName, string $error = "")
    {
        $this->load->view('pages/vote/VoteUser', [
            "error" => $error,
            'step' => 2,
            'comitteeName' => $comitteeName
        ]);
    }

    private function photo(string $comitteeName)
    {
        $this->load->library('user_agent');
        $this->load->view('pages/vote/VotePhoto', [
            'step' => 3,
            'comitteeName' => $comitteeName,
            'isMobile' => $this->agent->is_mobile()
        ]);
    }

    private function voting(array $candidates, string $comitteeName)
    {
        $this->load->view('pages/vote/VoteVoting', [
            'step' => 4,
            'candidates' => $candidates,
            'comitteeName' => $comitteeName
        ]);
    }

    private function finish(array $device)
    {
        $this->load->view('pages/vote/VoteFinish', [
            'device' => $device
        ]);
    }
}
