<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VoteModel extends CI_Model
{
    private $table = 'tbl_vote';

    public function getVoteCount()
    {
        $count = $this->db->query('
        select count(id) as count
        from tbl_vote where vote is not null
        ')->result();
        return $count[0]->count;
    }

    public function getRecapVoteCount()
    {
        $sql = '
        SELECT count(v.userId) as count
        FROM tbl_vote as v
        where v.vote is not null
        GROUP BY v.userId
        HAVING COUNT(v.userId) > 1;
        ';
        $data = $this->db->query($sql)->result_array();

        return $data;
    }

    public function getRecapVoteExcel()
    {
        $sql = '
        SELECT v.userId, group_concat(v.vote) as votes, group_concat(v.recap) as recaps, group_concat(v.createdAt) as createdAts, group_concat(v.updatedAt) as updatedAts
        FROM tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        where v.vote is not null and v.recap is not null
        GROUP BY v.userId
        HAVING COUNT(v.userId) > 1;
        ';

        return $this->db->query($sql)->result_array();
    }

    public function getRecapVote()
    {
        $sql = '
        SELECT v.userId, group_concat(v.vote) as votes, group_concat(v.recap) as recaps, group_concat(v.createdAt) as createdAts, group_concat(v.updatedAt) as updatedAts
        FROM tbl_vote as v
        where v.vote is not null and v.recap is not null
        GROUP BY v.userId
        HAVING COUNT(v.userId) > 1;
        ';

        return $this->db->query($sql)->result_array();
    }

    public function getCleanVoteCount()
    {
        $count = $this->db->query('
        select count(*)
        from tbl_vote as v
        where v.vote is not null
        group by v.userId
        having count(v.userId) = 1
        ');
        return $count->result_array();
    }

    public function getCleanVote()
    {
        $count = $this->db->query('
        select v.userId, v.vote, v.updatedAt, v.createdAt
        from tbl_vote as v
        where v.vote is not null
        group by v.userId
        having count(v.userId) = 1
        ');
        return $count->result_array();
    }

    public function setOperatorId(string $deviceToken, string $operatorId)
    {
        $data = ['operatorId' => $operatorId];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

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

    public function insertDeviceTokenWithComittee(string $ip, string $parentToken, string $deviceToken, string $comitteeCode)
    {
        $data = [
            'ipAddress' => $ip,
            'deviceToken' => $deviceToken,
            'parentToken' => $parentToken,
            'comitteeCode' => $comitteeCode
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

    public function getUserByNim(string $nim)
    {
        $res = $this->db->get_where('pemilih', [
            'nim' => $nim
        ]);
        return $res->result_array();
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

    public function setPhone(string $deviceToken, string $phone)
    {
        $data = ['phone' => $phone];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

    public function setVerify(string $deviceToken)
    {
        $data = ['isVerify' => true];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

    public function setNote(string $deviceToken, string $note)
    {
        $data = ['note' => $note];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

    public function insertUser(string $deviceToken, string $userId, string $phone)
    {
        $data = [
            'userId' => $userId,
            'phone' => $phone
        ];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

    public function setUser(string $deviceToken, string $userId)
    {
        $data = ['userId' => $userId];
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

    public function setGuided(string $deviceToken, bool $guided)
    {
        $data = ['isGuided' => $guided];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

    public function setRecap(string $deviceToken, string $recap)
    {
        $data = ['recap' => $recap];
        $this->db->where('deviceToken', $deviceToken)->update($this->table, $data);
    }

    /// RECAP FOR USER ///
    public function getRecapUserCount(string $search)
    {
        if ($search) {
            $search = "%{$search}%";
        } else {
            $search = '%';
        }

        $sql = '
        SELECT v.userId
        FROM tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        where (p.nim like ? or p.nama like ?) and v.vote is not null
        GROUP BY v.userId
        HAVING COUNT(*) > 1;
        ';
        $count = $this->db->query($sql, [$search, $search])->num_rows();

        return $count;
    }

    public function getRecapUserCountAll()
    {
        $sql = '
        SELECT v.userId
        FROM tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        where v.vote is not null
        GROUP BY v.userId
        HAVING COUNT(v.userId) > 1;
        ';
        $count = $this->db->query($sql)->num_rows();

        return $count;
    }

    public function getRecapUserData(string $search, int $offset = 0, int $limit = 5)
    {
        if ($search) {
            $search = "%{$search}%";
        } else {
            $search = '%';
        }

        $sql = '
        SELECT v.userId, p.nim, p.nama, p.kelas, COUNT(v.userId) as count, group_concat(v.phone) as phones, group_concat(v.recap) as recaps
        FROM tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        where (p.nim like ? or p.nama like ?) and v.vote is not null
        GROUP BY v.userId
        HAVING COUNT(v.userId) > 1
        limit ? offset ?
        ';
        $data = $this->db->query($sql, [$search, $search, $limit, $offset])->result_array();

        return $data;
    }

    public function getByUserID(string $userID)
    {
        $sql = '
        select v.deviceToken, p.nim, p.nama, p.kelas, v.phone, v.comitteeCode, v.note, v.recap, c.comitteeName, v.photoPath, v.vote, ca.nomorurut as candidateNumber
        from tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        left join tbl_comittee as c
        on c.comitteeCode=v.comitteeCode
        left join calon as ca
        on ca.id=v.vote
        where v.userId=?
        ';
        $res = $this->db->query($sql, $userID)->result_array();
        return $res;
    }

    /// RECAP FOR TOKEN ///
    public function getRecapTokenCount(string $search)
    {
        if ($search) {
            $search = "%{$search}%";
        } else {
            $search = '%';
        }

        $sql = '
        select v.id
        from tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        where p.nim like ? and v.vote is not null
        group by v.parentToken
        having count(v.userId) > 1
        ';
        $count = $this->db->query($sql, $search)->num_rows();

        return $count;
    }

    public function getRecapTokenCountAll()
    {
        $sql = '
        select v.id
        from tbl_vote as v
        group by v.parentToken
        having count(v.userId) > 1
        ';
        $count = $this->db->query($sql)->num_rows();

        return $count;
    }

    public function getRecapTokenData(string $search, int $offset = 0, int $limit = 5)
    {
        if ($search) {
            $search = "%{$search}%";
        } else {
            $search = '%';
        }

        $sql = '
        select v.parentToken, count(v.parentToken) as count, group_concat(p.nim) as nims, group_concat(v.recap) as recaps
        from tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        where p.nim like ? and v.vote is not null
        group by v.parentToken
        having count(v.userId) > 1
        limit ? offset ?
        ';
        $data = $this->db->query($sql, [$search, $limit, $offset])->result_array();

        return $data;
    }

    public function getByParentId(string $parentId)
    {
        $sql = '
        select v.deviceToken, p.nim, p.nama, p.kelas, v.phone, v.comitteeCode, v.note, v.recap, c.comitteeName, v.photoPath, v.vote, ca.nomorurut as candidateNumber
        from tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        left join tbl_comittee as c
        on c.comitteeCode=v.comitteeCode
        left join calon as ca
        on ca.id=v.vote
        where v.parentToken=?
        ';
        $res = $this->db->query($sql, $parentId)->result_array();
        return $res;
    }

    /// RECAP FOR NETWORK ///
    public function getRecapNetworkCount(string $search)
    {
        if ($search) {
            $search = "%{$search}%";
        } else {
            $search = '%';
        }

        $sql = '
        select v.id
        from tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        where p.nim like ? and v.vote is not null
        group by v.ipAddress
        having count(v.userId) > 1
        ';
        $count = $this->db->query($sql, $search)->num_rows();

        return $count;
    }

    public function getRecapNetworkCountAll()
    {
        $sql = '
        select v.id
        from tbl_vote as v
        group by v.ipAddress
        having count(v.userId) > 1
        ';
        $count = $this->db->query($sql)->num_rows();

        return $count;
    }

    public function getRecapNetworkData(string $search, int $offset = 0, int $limit = 5)
    {
        if ($search) {
            $search = "%{$search}%";
        } else {
            $search = '%';
        }

        $sql = '
        select v.ipAddress, v.parentToken, count(v.ipAddress) as count, group_concat(p.nim) as nims, group_concat(v.recap) as recaps
        from tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        where p.nim like ? and v.vote is not null
        group by v.ipAddress
        having count(v.userId) > 1
        limit ? offset ?
        ';
        $data = $this->db->query($sql, [$search, $limit, $offset])->result_array();

        return $data;
    }

    public function getByIpAddress(string $ipAddress)
    {
        $sql = '
        select v.deviceToken, p.nim, p.nama, p.kelas, v.phone, v.comitteeCode, v.note, v.recap, c.comitteeName, v.photoPath, v.vote, ca.nomorurut as candidateNumber
        from tbl_vote as v
        inner join pemilih as p
        on p.id=v.userId
        left join tbl_comittee as c
        on c.comitteeCode=v.comitteeCode
        left join calon as ca
        on ca.id=v.vote
        where v.ipAddress=?
        ';
        $res = $this->db->query($sql, $ipAddress)->result_array();
        return $res;
    }
}
