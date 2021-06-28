<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    protected $usersModel;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        return view('login/index');
    }

    public function masuk()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $cek = $this->usersModel->where('username', $username)->first();

        if (!empty($cek)) {
            if (password_verify($password, $cek['password'])) {
                if ($cek['status'] == "Aktif") {
                    session()->set('idUser', $cek['id_user']);
                    session()->set('username', $cek['username']);
                    session()->set('name', $cek['nm_user']);
                    session()->set('level', $cek['level']);
                    session()->set('loggedIn', true);

                    session()->setflashdata('success', 'Selamat Datang, ' . session()->get('name'));
                    return redirect()->to(base_url('dashboard'))->withInput();
                } else {
                    session()->setflashdata('failed', 'Maaf, Status anda sudah Tidak Aktif');
                    return redirect()->to(base_url())->withInput();
                }
            } else {
                session()->setflashdata('failed', 'Oopss.. Username/password salah');
                return redirect()->to(base_url())->withInput();
            }
        } else {
            session()->setflashdata('failed', 'Oopss.. Data tidak ditemukan!');
            return redirect()->to(base_url())->withInput();
        }
    }

    public function keluar()
    {
        session()->remove('idUser');
        session()->remove('username');
        session()->remove('name');
        session()->remove('level');
        session()->remove('loggedIn');
        return redirect()->to(base_url());
    }
}
