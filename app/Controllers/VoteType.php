<?php

namespace App\Controllers;

use App\Models\VoteTypeModel;

class VoteType extends BaseController
{
    private $linkName = 'votetype';
    private VoteTypeModel $voteTypeModel;

    public function __construct()
    {
        parent::__construct();

        $auth = $this->session->get('dashboard');
        if (!isset($auth) || !$auth['signin'] || !($auth['role'] == "admin")) {
            $this->toAuth();
        }

        $this->voteTypeModel = new VoteTypeModel();
    }

    public function index()
    {
        $data = array_reverse($this->voteTypeModel->findAll());

        return view('Pages/VoteType/VoteType', [
            'linkName' => $this->linkName,
            'votetypes' => $data
        ]);
    }

    public function add()
    {
        $voteType = $this->request->getVar('voteType');
        $voteTypeName = $this->request->getVar('voteTypeName');

        $exist = $this->voteTypeModel->getByType($voteType);
        if (!$exist) {
            $this->voteTypeModel->insert([
                'id' => generateID(),
                'type' => $voteType,
                'name' => $voteTypeName
            ]);
        }

        return redirect()->to(base_url('voteType'));
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $voteTypeName = $this->request->getVar('voteTypeName');
        $voteType = $this->request->getVar('voteType');

        $exist = $this->voteTypeModel->getByType($voteType);
        if (!$exist || $exist['id'] == $id) {
            $this->voteTypeModel->update($id, [
                'type' => $voteType,
                'name' => $voteTypeName
            ]);
        }

        return redirect()->to(base_url('voteType'));
    }

    public function delete()
    {
        $id = $this->request->getVar('id');

        $this->voteTypeModel->delete($id);

        return redirect()->to(base_url('voteType'));
    }
}
