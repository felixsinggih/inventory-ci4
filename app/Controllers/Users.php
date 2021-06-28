<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_admin') ? $this->request->getVar('page_admin') : 1;
        $keyword = $this->request->getVar('keyword');
        $admin = $this->usersModel;
        $data = [
            'title' => 'Data Admin',
            'admin'  => $admin->paginate(10, 'admin'),
            'pager' => $this->usersModel->pager,
            'act'   => 'admin',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/users/index', $data);
    }

    public function pencarian()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword)
            return redirect()->to(base_url('/admin/search/' . $keyword))->withInput();
        else
            return redirect()->to(base_url('/admin'));
    }

    public function cari($keyword)
    {
        $currentpage = $this->request->getVar('page_admin') ? $this->request->getVar('page_admin') : 1;
        $admin = $this->usersModel->cari($keyword);
        $data = [
            'title' => 'Data Admin',
            'admin'  => $admin->paginate(10, 'admin'),
            'pager' => $this->usersModel->pager,
            'act'   => 'admin',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/users/index', $data);
    }

    public function detail($idUser)
    {
        $admin = $this->usersModel->find($idUser);

        if (empty($admin)) {
            session()->setflashdata('failed', 'Oops... Data tidak ditemukan. Silahkan pilih data.');
            return redirect()->to(base_url('/admin'))->withInput();
        }

        $data = [
            'title' => 'Detail Admin',
            'admin' => $admin,
            'act'   => 'admin',
        ];
        return view('admin/users/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Admin',
            'act'   => 'admin',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/users/add', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nm_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi!',
                ]
            ],
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Nama Lengkap wajib diisi!',
                    'is_unique' => 'Usename sudah digunakan!'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi!'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level wajib diisi!'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/add'))->withInput();
        }

        $idUser = $this->usersModel->kodegen();
        $password = $this->request->getVar('password');
        $pwHash = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'id_user' => $idUser,
            'nm_user' => $this->request->getVar('nm_user'),
            'password' => $pwHash,
            'username' => $this->request->getVar('username'),
            'level' => $this->request->getVar('level'),
            'status' => $this->request->getVar('status'),
        ];

        $this->db->transStart();
        $this->usersModel->insert($data);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data admin gagal ditambah.');
            return redirect()->to(base_url('admin/add'));
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data admin berhasil ditambah.');
            return redirect()->to(base_url('admin'));
        }
    }

    public function ubah($idUser)
    {
        $admin = $this->usersModel->find($idUser);
        if (empty($admin)) {
            session()->setflashdata('failed', 'Oops... Data tidak ditemukan. Silahkan pilih data.');
            return redirect()->to(base_url('/admin'))->withInput();
        }

        $data = [
            'title' => 'Edit Admin',
            'admin'  => $admin,
            'act'   => 'admin',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/users/edit', $data);
    }

    public function ubah_data($idUser)
    {
        if (!$this->validate([
            'nm_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama lengkap wajib diisi!',
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level wajib diisi!'
                ]
            ],
            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status wajib diisi!'
                ]
            ],
        ])) {
            return redirect()->to(base_url('/admin/edit/' . $idUser))->withInput();
        }

        $admin = $this->usersModel->find($idUser);
        $password = $this->request->getVar('password');

        if (empty($password)) {
            $data = [
                'id_user' => $admin['id_user'],
                'nm_user' => $this->request->getVar('nm_user'),
                'level' => $this->request->getVar('level'),
                'status' => $this->request->getVar('status'),
            ];
        } else {
            $pwHash = password_hash($password, PASSWORD_DEFAULT);
            $data = [
                'id_user' => $admin['id_user'],
                'nm_user' => $this->request->getVar('nm_user'),
                'password' => $pwHash,
                'level' => $this->request->getVar('level'),
                'status' => $this->request->getVar('status'),
            ];
        }

        $this->db->transStart();
        $this->usersModel->update($admin['id_user'], $data);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data admin gagal diubah.');
            return redirect()->to(base_url('admin'));
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data admin berhasil diubah.');
            return redirect()->to(base_url('admin/' . $admin['id_user']));
        }
    }

    public function profil()
    {
        $idUser = session()->get('idUser');
        $user = $this->usersModel->find($idUser);

        $data = [
            'title' => 'Profile',
            'user' => $user,
            'act' => ''
        ];
        return view('admin/users/profil/index', $data);
    }

    public function pass()
    {
        $idUser = session()->get('idUser');
        $user = $this->usersModel->find($idUser);

        $data = [
            'title' => 'Profile',
            'user' => $user,
            'act' => '',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/users/profil/password', $data);
    }

    public function ubah_password()
    {
        $idUser = $this->request->getVar('id_user');
        $pass = $this->request->getVar('pass');
        $user = $this->usersModel->find($idUser);

        if (password_verify($pass, $user['password']) == false) {
            session()->setflashdata('failed', 'Oops... Password anda salah.');
            return redirect()->to(base_url('password'))->withInput();
        }

        if (!$this->validate([
            'pass' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom Password wajib diisi!',
                ]
            ],
            'pass_baru' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Kolom Password Baru wajib diisi!',
                    'min_length' => 'Panjang minimal password 8 karakter!'
                ]
            ],
            'pass_konfirmasi' => [
                'rules' => 'required|matches[pass_baru]',
                'errors' => [
                    'required' => 'Kolom Konfirmasi Password wajib diisi!',
                    'matches' => 'Kolom Konfirmasi Password harus sama dengan kolom Password Baru!'
                ]
            ]
        ])) {
            return redirect()->to(base_url('password'))->withInput();
        }

        $password = $this->request->getVar('pass_konfirmasi');
        $pwHash = password_hash($password, PASSWORD_DEFAULT);
        $userdata = [
            'id_user' => $user['id_user'],
            'password' => $pwHash
        ];

        $this->db->transStart();
        $this->usersModel->update($user['id_user'], $userdata);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Password gagal diubah.');
            return redirect()->to(base_url('password'))->withInput();
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Password berhasil diubah.');
            return redirect()->to(base_url('profile'));
        }
    }
}
