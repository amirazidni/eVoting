<?php

namespace App\Controllers;

use App\Models\VoterModel;
use App\Models\VoteTypeModel;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Voter extends BaseController
{
    private $linkName = 'voter';

    private VoteTypeModel $voteTypeModel;
    private VoterModel $voterModel;

    public function __construct()
    {
        parent::__construct();

        $auth = $this->session->get('dashboard');
        if (!isset($auth) || !$auth['signin'] || !($auth['role'] == "admin")) {
            $this->toAuth();
        }

        $this->voteTypeModel = new VoteTypeModel();
        $this->voterModel = new VoterModel();
    }

    public function index()
    {
        return view('Pages/Voter/Voter', [
            'linkName' => $this->linkName
        ]);
    }

    public function create()
    {
        $res = $this->voteTypeModel->findAll();

        return view('Pages/Voter/VoterCreate', [
            'linkName' => $this->linkName,
            'votetypes' => $res,
            'update' => false
        ]);
    }

    public function update()
    {
        $voterId = $this->request->getGet('voterId');
        $votetypes = $this->voteTypeModel->findAll();
        $voter = $this->voterModel->find($voterId);
        $voterType = $this->voterModel->getVoterType($voterId);

        return view('Pages/Voter/VoterCreate', [
            'update' => true,
            'linkName' => $this->linkName,
            'votetypes' => $votetypes,
            'voter' => $voter,
            'voterType' => $voterType
        ]);
    }

    public function templateExcel()
    {
        $file = 'assets/template_excel.xlsx';

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

    public function createAction()
    {
        $nim = $this->request->getVar('nim');
        $password = $this->request->getVar('password');
        $name = $this->request->getVar('name');
        $class = $this->request->getVar('class');
        $studyprogram = $this->request->getVar('studyprogram');
        $major = $this->request->getVar('major');
        $faculty = $this->request->getVar('faculty');
        $password = $this->createPasswordHash($password);
        $voterId = generateID();

        // Create Voter
        $this->voterModel->insert([
            'id' => $voterId,
            'nim' => $nim,
            'password' => $password,
            'name' => $name,
            'class' => $class,
            'studyprogram' => $studyprogram,
            'major' => $major,
            'faculty' => $faculty
        ]);

        // Create Voter Type
        for ($i = 0; $i < 5; $i++) {
            $votetype = $this->request->getVar('type' . $i);

            $this->voterModel->insertType(generateID(), $voterId, $votetype, $i + 1);
        }

        return redirect()->to(base_url('voter'));
    }

    public function deleteAction()
    {
        $voterId = $this->request->getVar('voterId');

        $this->voterModel->delete($voterId);

        return redirect()->to(base_url('voter'));
    }

    public function updateAction()
    {
        $voterId = $this->request->getGet('voterId');
        $nim = $this->request->getVar('nim');
        $name = $this->request->getVar('name');
        $class = $this->request->getVar('class');
        $studyprogram = $this->request->getVar('studyprogram');
        $major = $this->request->getVar('major');
        $faculty = $this->request->getVar('faculty');
        $password = $this->request->getVar('password');

        $data = [
            'nim' => $nim,
            'name' => $name,
            'class' => $class,
            'studyprogram' => $studyprogram,
            'major' => $major,
            'faculty' => $faculty
        ];

        if ($password) {
            $password = $this->createPasswordHash($password);
            $data['password'] = $password;
        }

        $this->voterModel->update($voterId, $data);

        // Update Voter Type
        $this->voterModel->removeAllVoterType($voterId);
        for ($i = 0; $i < 5; $i++) {
            $votetype = $this->request->getVar('type' . $i);

            $this->voterModel->insertType(generateID(), $voterId, $votetype, $i + 1);
        }

        return redirect()->to(base_url('voter'));
    }

    public function checkValid()
    {
        $res = $this->voterModel->checkVoteType();

        return json_encode([
            'count' => count($res),
            'data' => $res
        ]);
    }

    // PAGINATION
    public function getsPaged()
    {
        $draw = $this->request->getVar('draw');
        $search = $this->request->getVar('search')['value'];
        $limit = $this->request->getVar('length');
        $offset = $this->request->getVar('start');

        $total = $this->voterModel->getTotal();
        $filteredCount = $this->voterModel->getsFilteredTotal($search);
        $data = $this->voterModel->getsFiltered($search, $limit, $offset);

        return json_encode([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filteredCount,
            'data' => $data
        ]);
    }

    public function import()
    {
        if ($this->request->getMethod() != 'post') {
            return print_r("Not supported method");
        }

        $file = $this->request->getFile('dataExcel');

        if (!$file) {
            return print_r("File Not uploaded");
        }

        $fileName = $file->getTempName();
        $reader = IOFactory::createReaderForFile($fileName);
        $reader->setReadDataOnly(true);
        $reader->setReadEmptyCells(false);
        $spread = $reader->load($fileName);
        $worksheet = $spread->getActiveSheet();
        $data = $worksheet->toArray();

        // Remove Header
        array_shift($data);

        foreach ($data as $item) {
            // Insert if voter if not available yet
            $nim = $item[0];
            $exist = $this->voterModel->getByNim($nim);

            // Every User Get 5 Role or Vote Type
            if (!$exist) {
                $voterId = generateID();
                $password = $item[1];
                $name = $item[2];
                $class = $item[3];
                $studyprogram = $item[4];
                $major = $item[5];
                $faculty = $item[6];
                $password = $this->createPasswordHash($password);

                $this->voterModel->insert([
                    'id' => $voterId,
                    'nim' => $nim,
                    'password' => $password,
                    'name' => $name,
                    'class' => $class,
                    'studyprogram' => $studyprogram,
                    'major' => $major,
                    'faculty' => $faculty
                ]);

                // Check if vote type is not exist
                $facultyType = $faculty . '_type';
                $majorType = $major . "_" . $facultyType;
                $studyType = $studyprogram . "_" . $majorType;

                // Insert Party
                $partyType = 'party_type';
                $exist = $this->voteTypeModel->getByType($partyType);
                if (!$exist) {
                    $partyName = 'Pemilihan Partai';
                    $exist = [
                        'id' => generateID(),
                        'type' => $partyType,
                        'name' => $partyName
                    ];

                    $this->voteTypeModel->insert($exist);
                }
                $this->voterModel->insertType(generateID(), $voterId, $exist['id'], 1);

                // Insert President
                $presidentType = 'president_type';
                $exist = $this->voteTypeModel->getByType($presidentType);
                if (!$exist) {
                    $presidentName = 'Pemilihan Presiden';
                    $exist = [
                        'id' => generateID(),
                        'type' => $presidentType,
                        'name' => $presidentName
                    ];

                    $this->voteTypeModel->insert($exist);
                }
                $this->voterModel->insertType(generateID(), $voterId, $exist['id'], 2);

                // Faculty Level
                $exist = $this->voteTypeModel->getByType($facultyType);
                if (!$exist) {
                    $exist = [
                        'id' => generateID(),
                        'type' => $facultyType,
                        'name' => $facultyType
                    ];

                    $this->voteTypeModel->insert($exist);
                }
                $this->voterModel->insertType(generateID(), $voterId, $exist['id'], 3);

                // Major Level
                $exist = $this->voteTypeModel->getByType($majorType);
                if (!$exist) {
                    $exist = [
                        'id' => generateID(),
                        'type' => $majorType,
                        'name' => $majorType
                    ];

                    $this->voteTypeModel->insert($exist);
                }
                $this->voterModel->insertType(generateID(), $voterId, $exist['id'], 4);

                // Study Program Level
                $exist = $this->voteTypeModel->getByType($studyType);
                if (!$exist) {
                    $exist = [
                        'id' => generateID(),
                        'type' => $studyType,
                        'name' => $studyType
                    ];

                    $this->voteTypeModel->insert($exist);
                }
                $this->voterModel->insertType(generateID(), $voterId, $exist['id'], 5);
            }
        }

        return redirect()->to(base_url('voter'));
    }
}
