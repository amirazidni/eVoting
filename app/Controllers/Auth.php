<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\OperatorModel;

class Auth extends BaseController
{
    private OperatorModel $operatorModel;
    private AdminModel $adminModel;

    public function __construct()
    {
        $this->operatorModel = new OperatorModel();
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        return redirect()->to(base_url('auth/signin'));
    }

    public function signin()
    {
        $auth = $this->session->get('dashboard');
        if (isset($auth) && $auth['signin']) {
            return redirect()->to(base_url('dashboard'));
        }

        return view('Pages/Auth/Signin', [
            'error' => $this->session->getFlashdata('error')
        ]);
    }

    public function signinAction()
    {
        $role = $this->request->getPost('role');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = [];

        if ($role == 'admin') {
            $data = $this->adminModel->getByUsername($username);
        } else if ($role == 'operator') {
            $data = $this->operatorModel->getByUsername($username);
        } else {
            $this->session->setFlashdata('error', 'Role is not valid!');
            return redirect()->to(base_url('auth/signin'));
        }

        if (count($data) == 0) {
            $this->session->setFlashdata('error', 'Failed to signin. No User found!');
            return redirect()->to(base_url('auth/signin'));
        }

        $data = $data[0];
        $success = password_verify($password, $data['password']);

        if (!$success) {
            if ($role == 'admin') {
                $this->session->setFlashdata('error', 'Failed to signin. Admin password is wrong!');
                return redirect()->to(base_url('auth/signin'));
            } else {
                $this->session->setFlashdata('error', 'Failed to signin. Operator password is wrong!');
                return redirect()->to(base_url('auth/signin'));
            }
        }

        // Set JWT HERE
        $this->session->set('dashboard', [
            'id' => $data['id'],
            'role' => $role,
            'username' => $username,
            'signin' => true
        ]);

        return redirect()->to(base_url('dashboard'));
    }

    public function logoutAction()
    {
        $this->session->set('dashboard', null);

        return redirect()->to(base_url('auth'));
    }
}
