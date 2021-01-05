<?php

namespace App\Models;

use CodeIgniter\Model;

class VoterTypeModel extends Model
{
    protected $table = 'tblm_votertype';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'voterId', 'votetypeId', 'voteOrder', 'deletedAt'];
}
