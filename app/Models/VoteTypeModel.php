<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteTypeModel extends Model
{
    protected $table = 'tblm_votetype';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'type', 'name', 'deletedAt'];

    public function getByType(string $type)
    {
        return $this->builder()->getWhere([
            'type' => $type
        ])->getResultArray()[0];
    }

    public function checkVoteType()
    {
    }
}
