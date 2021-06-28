<?php

namespace App\Controllers;

use App\Models\WebModel;

class Web extends BaseController
{
    protected $webModel;

    public function __construct()
    {
        $this->webModel = new WebModel();
    }

    public function index()
    {
        $web = $this->webModel->find(1);
        $data = [
            'title' => 'Pengaturan',
            'web' => $web,
            'act'   => 'settings',
        ];
        return view('admin/web/index', $data);
    }

    public function ubah()
    {
        $web = $this->webModel->find(1);
        $data = [
            'title' => 'Pengaturan',
            'web' => $web,
            'act'   => 'settings',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/web/edit', $data);
    }

    public function ubah_data($idWeb)
    {
        if (!$this->validate([
            'nm_web' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama website wajib diisi!',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat wajib diisi!'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email wajib diisi!'
                ]
            ],
            'telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Telepon wajib diisi!'
                ]
            ],
            'min_stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Minimal stok wajib diisi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/settings/edit/'))->withInput();
        }

        $web = $this->webModel->find($idWeb);
        $password = $this->request->getVar('password');

        $data = [
            'id_web' => $web['id_web'],
            'nm_web' => $this->request->getVar('nm_web'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'telp' => $this->request->getVar('telp'),
            'min_stok' => $this->request->getVar('min_stok'),
        ];

        $this->db->transStart();
        $this->webModel->update($web['id_web'], $data);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Pengaturan gagal diubah.');
            return redirect()->to(base_url('settings/edit'));
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Pengaturan berhasil diubah.');
            return redirect()->to(base_url('settings'));
        }
    }
}
