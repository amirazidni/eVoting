<?php

namespace App\Controllers;

use App\Models\VoterModel;
use App\Models\VoteTypeModel;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Verify extends BaseController
{
    private $linkName = 'verify';

    private VoteTypeModel $voteTypeModel;
    private VoterModel $voterModel;

    public function __construct()
    {
        $this->voteTypeModel = new VoteTypeModel();
        $this->voterModel = new VoterModel();
    }

    public function index()
    {
        $lastSearch = '';

        return view('Pages/Verify/Verify', [
            'linkName' => $this->linkName,
            'lastSearch' => $lastSearch
        ]);
    }
}
