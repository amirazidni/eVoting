<?php

namespace App\Controllers;

use App\Models\OperatorModel;

class Operator extends BaseController
{
    private string $linkName = 'operator';
    private OperatorModel $operatorModel;

    public function __construct()
    {
        parent::__construct();

        $auth = $this->session->get('dashboard');
        if (!isset($auth) || !$auth['signin'] || !($auth['role'] == "admin")) {
            $this->toAuth();
        }

        $this->operatorModel = new OperatorModel();
    }

    public function index()
    {
        $operators = $this->operatorModel->findAll();

        return view('Pages/Operator/Operator', [
            'linkName' => $this->linkName,
            'operators' => $operators
        ]);
    }

    public function add()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $phone = $this->request->getVar('phone');
        $password = password_hash($password, PASSWORD_BCRYPT, [
            'cost' => $this->saltRound
        ]);

        $this->operatorModel->insert([
            'id' => generateID(),
            'username' => $username,
            'password' => $password,
            'phone' => $phone
        ]);

        return redirect()->to(base_url('operator'));
    }

    public function update()
    {
        $id = $this->request->getVar('id');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $phone = $this->request->getVar('phone');
        $data = [
            'username' => $username,
            'phone' => $phone
        ];

        if ($password) {
            $password = password_hash($password, PASSWORD_BCRYPT, [
                'cost' => $this->saltRound
            ]);
            $data['password'] = $password;
        }

        $this->operatorModel->update($id, $data);

        return redirect()->to(base_url('operator'));
    }

    public function delete()
    {
        $id = $this->request->getVar('id');

        $this->operatorModel->delete($id);

        return redirect()->to(base_url('operator'));
    }
}
