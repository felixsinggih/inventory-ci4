<?php

namespace App\Models;

use CodeIgniter\Model;

class SuplaiDetailModel extends Model
{
    protected $table = 'suplai_detail';
    protected $allowedFields = ['id_suplai', 'id_barang', 'jumlah'];

    public function detail($idSuplai)
    {
        return $this->join('barang', 'barang.id_barang = suplai_detail.id_barang')
            ->where('suplai_detail.id_suplai', $idSuplai)
            ->get()->getResultArray();
    }
}
