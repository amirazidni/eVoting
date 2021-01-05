<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateModel extends Model
{
    protected $table = 'tblm_candidate';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'votetype', 'candidateOrder', 'name', 'description', 'photoName'];

    public function gets()
    {
        return $this->db->table($this->table . ' as c')
            ->select('c.id, c.candidateOrder, c.name, c.description, c.photoName, vt.name as voteTypeName')
            ->join('tblm_votetype as vt', 'vt.id=c.votetype')
            ->get()->getResultArray();
    }
}
