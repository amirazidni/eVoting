<?php

namespace App\Models;

use CodeIgniter\Model;

class OperatorModel extends Model
{
    protected $table = 'tblm_operator';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'username', 'password', 'phone'];

    public function getByUsername(string $username)
    {
        return $this->builder()
            ->getWhere([
                'username' => $username
            ])->getResultArray();
    }
}
