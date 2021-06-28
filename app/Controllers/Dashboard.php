<?php

namespace App\Controllers;

use App\Models\WebModel;
use App\Models\BarangModel;

class Dashboard extends BaseController
{
    protected $webModel;
    protected $barangModel;

    public function __construct()
    {
        $this->webModel = new WebModel();
        $this->barangModel = new BarangModel();
    }
    public function index()
    {
        $web = $this->webModel->find(1);
        $minimal = $this->barangModel->notifikasi_stok($web['min_stok']);
        $data = [
            'title' => 'Dashboard',
            'web' => $web,
            'minimal' => $minimal,
            'act' => 'dashboard'
        ];
        return view('admin/dashboard/index', $data);
    }
}
