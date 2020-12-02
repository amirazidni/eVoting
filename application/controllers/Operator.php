<?php defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();

        // Model
        $this->load->model('UserOverlapModel', 'userOverlapModel');
        $this->load->model('VoteModel', 'voteModel');

        // Session
        $this->user = $this->session->userdata();
    }

    public function index()
    {
        return redirect(base_url('operator/verify'));
    }

    public function verify()
    {
        $lastSearch = $this->session->flashdata('lastSearch');
        return $this->load->view('pages/operator/Verify', [
            'lastSearch' => $lastSearch
        ]);
    }

    public function dashboard()
    {
        return $this->load->view('pages/operator/Dashboard');
    }

    public function test(string $phone = "")
    {
        $data = $this->userOverlapModel->getData($phone);

        print_r("data");
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
}
