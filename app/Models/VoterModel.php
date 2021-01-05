<?php

namespace App\Models;

use CodeIgniter\Model;

class VoterModel extends Model
{
    protected $table = 'tblm_voter';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'nim', 'password', 'name', 'class', 'studyprogram', 'major', 'faculty', 'deletedAt'];


    public function getByNim(string $nim)
    {
        return $this->builder()->getWhere([
            'nim' => $nim
        ])->getResultArray()[0];
    }

    public function insertType(string $typeId, string $voterId, string $votetypeId, int $voteOrder)
    {
        return $this->db->table('tblm_votertype')->insert([
            'id' => $typeId,
            'voterId' => $voterId,
            'votetypeId' => $votetypeId,
            'voteOrder' => $voteOrder
        ]);
    }

    public function checkVoteType()
    {
        return $this->db->table('tblm_votertype as vt')
            ->select('v.nim, v.name, count(vt.voterId) as voteCount')
            ->join('tblm_voter as v', 'v.id=vt.voterId')
            ->groupBy('voterId')
            ->having('count(voterId) < 5', null, false)
            ->get()->getResultArray();
    }

    // VOTER TYPE
    public function getVoterType(string $voterId)
    {
        return $this->db->table('tblm_votertype')
            ->orderBy('voteOrder', 'ASC')
            ->getWhere([
                'voterId' => $voterId
            ])->getResultArray();
    }

    public function removeAllVoterType(string $voterId)
    {
        $this->db->table('tblm_votertype')
            ->delete([
                'voterId' => $voterId
            ]);
    }

    // PAGINATION
    public function getTotal()
    {
        $count = $this->builder()->selectCount('id', 'count')->get()->getResultArray()[0];
        return $count['count'];
    }

    public function getsFilteredTotal(string $search)
    {
        $count = $this->builder()
            ->selectCount('id', 'count')
            ->like('id', $search)
            ->like('name', $search)
            ->get()->getResultArray()[0];

        return $count['count'];
    }

    public function getsFiltered(string $search, int $limit, int $offset)
    {
        if ($search) {
            $search = "%$search%";
        } else {
            $search = '%';
        }
        $res = $this->db->query("
        select v.id, v.nim, v.name, v.class, group_concat(t.name) votetypes
        from tblm_voter as v
        inner join tblm_votertype as vt
        on v.id=vt.voterId
        inner join tblm_votetype as t
        on t.id=vt.votetypeId
        where v.nim like ? or v.name like ?
        group by v.id
        order by v.createdAt DESC
        limit ? offset ?
        ", [$search, $search, $limit, $offset]);

        return $res->getResultArray();
    }
}
