<?php

namespace App\Models;

use CodeIgniter\Model;

class WebModel extends Model
{
    protected $table = 'web';
    protected $primaryKey = 'id_web';
    protected $useTimestamps = true;
    protected $allowedFields = ['nm_web', 'alamat', 'email', 'telp', 'min_stok'];
}
