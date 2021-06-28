<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table = 'vhistory';
    protected $primaryKey = 'id';

    public function cari($keyword)
    {
        return $this->like('id_barang', $keyword)->orLike('nm_barang', $keyword)
            ->orderBy('created_at', 'DESC');
    }
}
