<?php

namespace App\Controllers;

use App\Models\VoteModel;
use Gregwar\Captcha\CaptchaBuilder;

class Vote extends BaseController
{
    private $deviceParentname   = '_SYS_PR_';
    private $deviceCookieName   = '_SYS_DV_';

    private $deviceCaptchaName  = '_SYS_CP_';
    private $deviceUserName     = '_SYS_US_';
    private $devicePhotoName    = '_SYS_PO_';

    private VoteModel $voteModel;

    public function __construct()
    {
        $this->voteModel = new VoteModel();
    }

    private function refresh()
    {
        return $this->response->redirect(base_url('vote'));
    }

    public function index()
    {
        return redirect()->to(base_url('vote/setup'));
    }

    public function setup()
    {
        // $index = 0;
        $parentCookie = $this->getCookie($this->deviceParentname);;
        $tokenCookie = $this->getCookie($this->deviceCookieName);
        $captchaCookie = $this->getCookie($this->deviceCaptchaName);
        $userCookie = $this->getCookie($this->deviceUserName);
        $photoCookie = $this->getCookie($this->devicePhotoName);
        $comitteeName = '';

        ///     LEVEL 0         ///
        ///     LEVEL GUIDE     ///
        // If Parent Not Token Exist
        if (!$parentCookie) {
            $this->clearCookies([
                $this->deviceCookieName,
                $this->deviceCaptchaName,
                $this->deviceUserName,
                $this->devicePhotoName
            ]);
            $deviceToken = generateID();
            $ip = $this->request->getIPAddress();
            $parentToken = generateID();

            $this->setCookie($this->deviceCookieName, $deviceToken);
            $this->setCookie($this->deviceParentname, $parentToken);
            $this->voteModel->insertDeviceToken($ip, $parentToken, $deviceToken);

            return $this->refresh();
        }

        $parents = $this->voteModel->getByParent($parentCookie);

        if (count($parents) == 0) {
            $this->clearCookies([$this->deviceParentname]);
            return $this->refresh();
        }

        if (!$tokenCookie) {
            $deviceToken = generateID();
            $ip = $this->request->getIPAddress();
            $this->setCookie($this->deviceCookieName, $deviceToken);
            $this->voteModel->insertDeviceToken($ip, $parentCookie, $deviceToken);
            return $this->refresh();
        }

        $devices = $this->voteModel->getByToken($tokenCookie);
        if (count($devices) == 0) {
            $this->clearCookies([$this->deviceCookieName]);
            return $this->refresh();
        }

        $device = $devices[0];
        // render guide if not isGuided
        if (!$device['isGuided']) {
            $isGuided = isset($_POST['guided']);

            if ($isGuided) {
                $this->voteModel->setGuided($tokenCookie, true);
                return $this->refresh();
            }

            return $this->guide();
        }

        ///     LEVEL 1           ///
        ///     LEVEL CAPTCHA     ///
        // Is Captcha Exist
        if (!$captchaCookie) {
            // Also Check is he submitting captcha
            $isCaptchaPost = isset($_POST['captcha']);
            $error = '';

            if ($isCaptchaPost) {
                $captchaPost = $_POST['captcha'];

                if ($captchaPost == $device['captchaToken']) {
                    $this->setCookie($this->deviceCaptchaName, $captchaPost);
                    return $this->refresh();;
                } else {
                    $error = "Captcha yang anda masukan salah.\n Coba Lagi!.";
                }
            }

            $newCaptcha = base_convert(rand(), 10, 36);
            $this->voteModel->insertCaptchaToken($tokenCookie, $newCaptcha);
            return $this->captcha($newCaptcha, '', $error);
        }

        if ($captchaCookie != $device['captchaToken']) {
            $this->clearCookies([$this->deviceCaptchaName]);
            return $this->refresh();
        }

        if (!$userCookie) {
            $isUserInput = isset($_POST['nim']);

            if ($isUserInput) {
                $nim = $_POST['nim'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $users = $this->voteModel->getUserByNim($nim);

                if (count($users)) {
                    return $this->user($comitteeName, "User belum terdaftar");
                }
            }
        }
    }

    public function voting()
    {
        return view('Pages/Vote/Voting');
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

    // VIEW //
    private function guide()
    {
        return view('Pages/Vote/VoteGuide', [
            'step' => 0,
            'comitteeName' => ""
        ]);
    }

    private function captcha(string $captcha, string $comitteeName, string $error)
    {
        $builder = new CaptchaBuilder($captcha);
        $cap = $builder->build()->inline();

        return view('Pages/Vote/VoteCaptcha', [
            'captcha' =>  $cap,
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

    // private function voting(array $candidates, string $comitteeName)
    // {
    //     $this->load->view('pages/vote/VoteVoting', [
    //         'step' => 4,
    //         'candidates' => $candidates,
    //         'comitteeName' => $comitteeName
    //     ]);
    // }

    private function finish(array $device)
    {
        $this->load->view('pages/vote/VoteFinish', [
            'device' => $device
        ]);
    }
}
