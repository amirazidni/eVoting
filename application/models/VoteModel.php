<?php

class VoteModel extends CI_Model
{
    private $table = 'tbl_vote';

    public function getByIp(string $ip)
    {
        $result = $this->db->select()->from($this->table)->where('ipAddress', $ip)->get();
        return $result->result_array();
    }

    public function insertDeviceToken(string $ip, string $parentToken, string $deviceToken)
    {
        $data = [
            'ipAddress' => $ip,
            'deviceToken' => $deviceToken,
            'parentToken' => $parentToken
        ];
        $this->db->insert($this->table, $data);
    }

    public function getByToken(string $token)
    {
        $result = $this->db->select()->from($this->table)->where('deviceToken', $token)->get();
        return $result->result_array();
    }

    public function insertCaptchaToken(string $deviceToken, string $captcha)
    {
        $data = [
            'captchaToken' => $captcha
        ];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

    public function getByParent(string $parent)
    {
        $result = $this->db->select()->from($this->table)->where('parentToken', $parent)->get();
        return $result->result_array();
    }

    public function checkUserExist(string $nim, string $pass): array
    {
        $result = $this->db->get_where('pemilih', [
            'nim' => $nim,
            'password' => $pass
        ]);
        return $result->result_array();
    }

    public function checkUserVoted(string $userID): array
    {
        $result = $this->db->get_where($this->table, [
            'userId' => $userID
        ]);

        return $result->result_array();
    }

    public function insertUser(string $deviceToken, string $userId, string $phone)
    {
        $data = [
            'userId' => $userId,
            'phone' => $phone
        ];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

    public function updatePhoto(string $deviceToken, string $imgPath)
    {
        $data = [
            'photoPath' => $imgPath
        ];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

    public function setVote(string $deviceToken, string $voteId)
    {
        $data = ['vote' => $voteId];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }
}
