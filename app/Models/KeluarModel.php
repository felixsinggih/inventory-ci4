<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluarModel extends Model
{
    protected $table = 'keluar';
    protected $primaryKey = 'id_keluar';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_keluar', 'tanggal', 'keterangan'];

    public function kodegen($tglKeluar)
    {
        $thn = substr($tglKeluar, 2, 2);
        $bln = substr($tglKeluar, 5, 2);
        $hari = substr($tglKeluar, 8, 2);
        $param = "BK-" . $thn . $bln . $hari;
        $query = $this->select('max(right(id_keluar, 3)) as kode')
            ->like('id_keluar', $param)
            ->limit(1)
            ->orderBy('id_keluar', 'DESC')->get()->getRowArray();
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
        return $this->like('id_keluar', $keyword)->orLike('tanggal', $keyword)->orLike('keterangan', $keyword)
            ->orderBy('tanggal', 'DESC');
    }
}
