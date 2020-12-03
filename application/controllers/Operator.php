<?php defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Model
        $this->load->model('UserOverlapModel', 'userOverlapModel');
        $this->load->model('VoteModel', 'voteModel');

        // Libraries
        $user = $this->session->userdata();
        $status = $user['status'];

        if (!$status) {
            return redirect('welcome_admin');
        }

        if ($status != 'loginoperator' && $status != 'loginadmin') {
            return redirect('welcome_admin');
        }
    }

    public function index()
    {
        return redirect(base_url('operator/verify'));
    }

    public function dashboard()
    {
        return $this->load->view('pages/operator/Dashboard');
    }

    public function verify()
    {
        $lastSearch = $this->session->flashdata('lastSearch');
        return $this->load->view('pages/operator/Verify', [
            'lastSearch' => $lastSearch
        ]);
    }

    public function user(string $userId = '')
    {
        if ($userId) {
            $res = $this->voteModel->getByUserID($userId);
            return $this->load->view('pages/operator/UserDetail', [
                'users' => $res,
                'userId' => $userId
            ]);
        }

        $lastSearch = $this->session->flashdata('lastSearch');
        return $this->load->view('pages/operator/User', [
            'lastSearch' => $lastSearch
        ]);
    }

    public function token(string $deviceToken = '')
    {
        if ($deviceToken) {
            # code...
        }

        $lastSearch = $this->session->flashdata('lastSearch');
        return $this->load->view('pages/operator/Token', [
            'lastSearch' => $lastSearch
        ]);
    }

    public function test(string $search = "")
    {
        $count = $this->voteModel->getRecapCount($search);
        $countAll = $this->voteModel->getRecapCountAll();
        $data = $this->voteModel->getRecapData($search);

        print_r($count);
        print_r($countAll);
        print_r($data);
    }

    public function note()
    {
        $note = $_POST['note'];
        $lastSearch = $_POST['lastSearch'];
        $deviceToken = $_POST['deviceToken'];

        $this->voteModel->setNote($deviceToken, $note);
        $this->session->set_flashdata('lastSearch', $lastSearch);

        return redirect(base_url('operator/verify'));
    }

    public function setRecap()
    {
        $deviceToken = $_POST['deviceToken'];
        $recap = $_POST['recap'];
        $userId = $_POST['userId'];

        $this->voteModel->setRecap($deviceToken, $recap);

        return redirect(base_url('operator/user/' . $userId));
    }

    public function setVerify()
    {
        $deviceToken = $_POST['deviceToken'];
        $lastSearch = $_POST['lastSearch'];

        $this->voteModel->setVerify($deviceToken);
        $this->session->set_flashdata('lastSearch', $lastSearch);

        return redirect(base_url('operator/verify'));
    }

    public function getsVerify()
    {
        $search = $_POST['search']['value'];
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $draw = $_POST['draw'];
        $count = $this->userOverlapModel->getCount($search);
        $countAll = $this->userOverlapModel->getCountAll();
        $data = $this->userOverlapModel->getData($search, $offset, $limit);

        header('Content-type: application/json');
        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $countAll,
            'recordsFiltered' => $count,
            'data' => $data
        ]);
    }

    public function getsRecapUser()
    {
        $search = $_POST['search']['value'];
        $limit = $_POST['length'];
        $offset = $_POST['start'];
        $draw = $_POST['draw'];
        $count = $this->voteModel->getRecapCount($search);
        $countAll = $this->voteModel->getRecapCountAll();
        $data = $this->voteModel->getRecapData($search, $offset, $limit);

        header('Content-type: application/json');
        echo json_encode([
            'draw' => $draw,
            'recordsTotal' => $countAll,
            'recordsFiltered' => $count,
            'data' => $data
        ]);
    }
}
