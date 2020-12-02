<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ComitteeModel extends CI_Model
{
    private $table = 'tbl_comittee';

    public function getByKey(string $comitteeCode)
    {
        $result = $this->db->select()->from($this->table)
            ->where('comitteeCode', $comitteeCode)->get();
        return $result->result_array();
    }

    public function registerIp(string $comitteeCode, string $ip)
    {
        $data = ['registerIp' => $ip];
        $this->db->where('comitteeCode', $comitteeCode)->update($this->table, $data);
    }
}
