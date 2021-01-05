<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    private $linkName = 'dashboard';

    public function __construct()
    {
        parent::__construct();

        $auth = $this->session->get('dashboard');
        if (!isset($auth) || !$auth['signin']) {
            $this->toAuth();
        }
    }

    public function index()
    {
        return view('Pages/Dashboard/Dashboard', [
            'linkName' => $this->linkName
        ]);
    }
}
