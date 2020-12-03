<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserOverlapModel extends CI_Model
{
    private $table = 'tbl_user_overlap';

    public function insertUserOverlap(string $deviceToken, string $userId, string $phone)
    {
        $count = $this->db->select('count(id) as count')->from($this->table)
            ->where('deviceToken', $deviceToken)->get()->result();
        $data = ['userId' => $userId, 'phone' => $phone];

        if ($count[0]->count > 0) {
            $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
        } else {
            $data['deviceToken'] = $deviceToken;
            $this->db->insert($this->table, $data);
        }
    }

    public function getCount(string $phone)
    {
        if (!$phone) {
            $phone = "%";
        } else {
            $phone = "%{$phone}%";
        }

        $query = "
        select count(id) as count
        from {$this->table}
        where phone like ?
        ";
        $count = $this->db->query($query, $phone)->result();

        return $count[0]->count;
    }

    public function getCountAll()
    {
        $query = "select count(id) as count from {$this->table}";
        $count = $this->db->query($query)->result();
        return $count[0]->count;
    }

    public function getData(string $phone, int $offset = 0, int $limit = 5)
    {
        if (!$phone) {
            $phone = "%";
        } else {
            $phone = "%{$phone}%";
        }

        $query = "
        select v.deviceToken, p.nim, p.nama, p.kelas, uo.phone, v.comitteeCode, v.note, v.vote, v.isVerify, v.updatedAt
        from tbl_vote as v
        left join {$this->table} as uo
        on v.deviceToken = uo.deviceToken
        left join pemilih as p
        on p.id = uo.userId
        where uo.phone like ? and v.vote is NULL
        limit ? offset ? 
        ";

        return $this->db->query($query, [$phone, $limit, $offset])->result_array();
    }
}
