<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_user', 'nm_user', 'username', 'password', 'level', 'status'];

    public function kodegen()
    {
        $param = "AD";
        $query = $this->select('max(right(id_user, 3)) as kode')
            ->like('id_user', $param)
            ->limit(1)
            ->orderBy('id_user', 'DESC')->get()->getRowArray();
        if (!empty($query)) {
            $kode = intval($query['kode']) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = $param . $kodemax;
        return $kodejadi;
    }

    public function cari($keyword)
    {
        return $this->like('nm_user', $keyword)->orLike('username', $keyword);
    }
}
