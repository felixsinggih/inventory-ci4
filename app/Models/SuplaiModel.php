<?php

namespace App\Models;

use CodeIgniter\Model;

class SuplaiModel extends Model
{
    protected $table = 'suplai';
    protected $primaryKey = 'id_suplai';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_suplai', 'penyuplai', 'tanggal', 'keterangan'];

    public function kodegen($tglMasuk)
    {
        $thn = substr($tglMasuk, 2, 2);
        $bln = substr($tglMasuk, 5, 2);
        $hari = substr($tglMasuk, 8, 2);
        $param = "BM-" . $thn . $bln . $hari;
        $query = $this->select('max(right(id_suplai, 3)) as kode')
            ->like('id_suplai', $param)
            ->limit(1)
            ->orderBy('id_suplai', 'DESC')->get()->getRowArray();
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
        return $this->like('id_suplai', $keyword)->orLike('penyuplai', $keyword)->orLike('tanggal', $keyword)
            ->orderBy('tanggal', 'DESC');
    }
}
