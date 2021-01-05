<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'tblt_vote';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ipAddress', 'deviceToken', 'parentToken', 'captchaToken', 'isGuided'];

    public function insertDeviceToken(string $ip, string $parentToken, string $deviceToken)
    {
        $data = [
            'ipAddress' => $ip,
            'deviceToken' => $deviceToken,
            'parentToken' => $parentToken
        ];
        return $this->builder()->insert($data);
    }

    public function insertCaptchaToken(string $deviceToken, string $captcha)
    {
        $data = [
            'captchaToken' => $captcha
        ];
        return $this->builder()->update($data, [
            'deviceToken' => $deviceToken
        ]);
    }

    public function getByParent(string $parentCookie)
    {
        $res = $this->builder()->getWhere([
            'parentToken' => $parentCookie
        ]);

        return $res->getResultArray();
    }

    public function getByToken(string $tokenCookie)
    {
        $res = $this->builder()->getWhere([
            'deviceToken' => $tokenCookie
        ]);

        return $res->getResultArray();
    }

    public function setGuided(string $tokenCookie, bool $guided)
    {
        $data = ['isGuided' => $guided];
        return $this->builder()->update($data, [
            'deviceToken' => $tokenCookie
        ]);
    }
}
