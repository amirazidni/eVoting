<?php

namespace App\Controllers;

use App\Models\CandidateModel;
use App\Models\VoteTypeModel;

class Candidate extends BaseController
{
    private $linkName = 'candidate';

    private VoteTypeModel $voteTypeModel;
    private CandidateModel $candidateModel;

    public function __construct()
    {
        parent::__construct();

        $auth = $this->session->get('dashboard');
        if (!isset($auth) || !$auth['signin'] || !($auth['role'] == 'admin')) {
            $this->toAuth();
        }

        $this->voteTypeModel = new VoteTypeModel();
        $this->candidateModel = new CandidateModel();
    }

    public function index()
    {
        $data = $this->candidateModel->gets();

        return view('Pages/Candidate/Candidate', [
            'linkName' => $this->linkName,
            'data' => $data
        ]);
    }

    public function create()
    {
        $votetypes = $this->voteTypeModel->findAll();

        return view('Pages/Candidate/CandidateCreate', [
            'linkName' => $this->linkName,
            'votetypes' => $votetypes,
            'update' => false
        ]);
    }

    public function update()
    {
        $id = $this->request->getGet('candidateId');
        $votetypes = $this->voteTypeModel->findAll();
        $candidate = $this->candidateModel->find($id);

        return view('Pages/Candidate/CandidateCreate', [
            'linkName' => $this->linkName,
            'votetypes' => $votetypes,
            'update' => true,
            'candidate' => $candidate
        ]);
    }

    public function createAction()
    {
        $photo = $this->request->getFile('photo');

        if ($photo->getError() != UPLOAD_ERR_OK) {
            return print_r('Error when uploading image<br>Go back to previous page');
        }

        if ($photo->getSize() > 500000) {
            return print_r("Image Size To big(Limit 500KB)<br>Go back to previous page");
        }

        $photoName = generateID() . '.' . explode('/', $photo->getMimeType())[1];
        move_uploaded_file($photo->getTempName(), "assets/candidate/$photoName");

        $id = generateID();
        $candidateOrder = $this->request->getPost('candidateOrder');
        $name = $this->request->getPost('name');
        $desc = $this->request->getPost('description');
        $voteType = $this->request->getPost('voteType');

        $this->candidateModel->insert([
            'id' => $id,
            'votetype' => $voteType,
            'candidateOrder' => $candidateOrder,
            'name' => $name,
            'description' => $desc,
            'photoName' => $photoName
        ]);

        return redirect()->to(base_url('candidate'));
    }

    public function updateAction()
    {
        $id = $this->request->getGet('candidateId');
        $candidateOrder = $this->request->getPost('candidateOrder');
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        $voteType = $this->request->getPost('voteType');
        $photo = $this->request->getFile('photo');
        $data = [
            'votetype' => $voteType,
            'candidateOrder' => $candidateOrder,
            'name' => $name,
            'description' => $description,
        ];

        if ($photo->getError() == UPLOAD_ERR_OK) {
            if ($photo->getSize() > 500000) {
                return print_r("Image Size To big(Limit 500KB)<br>Go back to previous page");
            }

            $photoName = generateID() . '.' . explode('/', $photo->getMimeType())[1];
            move_uploaded_file($photo->getTempName(), "assets/candidate/$photoName");

            $data['photoName'] = $photoName;
        }

        $this->candidateModel->update($id, $data);

        return redirect()->to(base_url('candidate/update?candidateId=' . $id));
    }

    public function delete()
    {
        $id = $this->request->getGet('candidateId');

        $this->candidateModel->delete($id);

        return redirect()->to(base_url('candidate'));
    }

    public function templateExcel()
    {
        $file = 'assets/template_candidate_excel.xlsx';

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header("Content-Type: application/vnd.ms-excel; charset=utf-8");
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            echo readfile($file);
            exit;
        }
        print_r("Error when trying to send a template file");
    }
}
