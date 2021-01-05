<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tblm_admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'name', 'email'];

    public function getByUsername(string $username)
    {
        return $this->builder()
            ->getWhere([
                'username' => $username
            ])->getResultArray();
    }
}
