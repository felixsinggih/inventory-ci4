<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluarDetailModel extends Model
{
    protected $table = 'keluar_detail';
    protected $allowedFields = ['id_keluar', 'id_barang', 'jumlah', 'spek'];

    public function detail($idKeluar)
    {
        return $this->select('*, keluar_detail.spek AS spek_attime')
            ->join('barang', 'barang.id_barang = keluar_detail.id_barang')
            ->where('keluar_detail.id_keluar', $idKeluar)
            ->get()->getResultArray();
    }
}
