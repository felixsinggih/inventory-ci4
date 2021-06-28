<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PenyesuaianModel;

class Barang extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : 1;
        $keyword = $this->request->getVar('keyword');
        $barang = $this->barangModel;
        $data = [
            'title' => 'Data Barang',
            'barang'  => $barang->paginate(25, 'barang'),
            'pager' => $this->barangModel->pager,
            'act'   => 'barang',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/barang/index', $data);
    }

    public function pencarian()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword)
            return redirect()->to(base_url('/item/search/' . $keyword))->withInput();
        else
            return redirect()->to(base_url('/item'));
    }

    public function cari($keyword)
    {
        $currentpage = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : 1;
        $barang = $this->barangModel->cari($keyword);
        $data = [
            'title' => 'Data Barang',
            'barang'  => $barang->paginate(25, 'barang'),
            'pager' => $this->barangModel->pager,
            'act'   => 'barang',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/barang/index', $data);
    }

    public function detail($idBarang)
    {
        $barang = $this->barangModel->find($idBarang);

        if (empty($barang)) {
            session()->setflashdata('failed', 'Oops... Data tidak ditemukan. Silahkan pilih data.');
            return redirect()->to(base_url('/barang'))->withInput();
        }

        $data = [
            'title' => 'Detail Barang',
            'barang' => $barang,
            'act'   => 'barang',
        ];
        return view('admin/barang/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Data Barang',
            'act'   => 'barang',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/barang/add', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nm_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang wajib diisi!',
                ]
            ],
            'satuan' => [
                'rules' => 'required|max_length[10]',
                'errors' => [
                    'required' => 'Satuan wajib diisi!',
                    'max_length' => 'Panjang maksimal untuk kolom ini sebesar 10 huruf!'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/item/add'))->withInput();
        }

        $idBarang = $this->barangModel->kodegen();
        $stok = 0;

        $data = [
            'id_barang' => $idBarang,
            'nm_barang' => $this->request->getVar('nm_barang'),
            'spek' => $this->request->getVar('spek'),
            'satuan' => ucwords($this->request->getVar('satuan')),
            'stok' => $stok,
        ];

        $this->db->transStart();
        $this->barangModel->insert($data);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data barang gagal ditambah.');
            return redirect()->to(base_url('item/add'));
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data barang berhasil ditambah.');
            return redirect()->to(base_url('item'));
        }
    }

    public function ubah($idBarang)
    {
        $barang = $this->barangModel->find($idBarang);
        if (empty($barang)) {
            session()->setflashdata('failed', 'Oops... Data tidak ditemukan. Silahkan pilih data.');
            return redirect()->to(base_url('/item'))->withInput();
        }

        $data = [
            'title' => 'Edit Data Barang',
            'barang'  => $barang,
            'act'   => 'barang',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/barang/edit', $data);
    }

    public function ubah_data($idBarang)
    {
        if (!$this->validate([
            'nm_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama barang wajib diisi!',
                ]
            ],
            'satuan' => [
                'rules' => 'required|max_length[10]',
                'errors' => [
                    'required' => 'Satuan wajib diisi!',
                    'max_length' => 'Panjang maksimal untuk kolom ini sebesar 10 huruf!'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/item/edit/' . $idBarang))->withInput();
        }

        $barang = $this->barangModel->find($idBarang);

        $data = [
            'id_barang' => $barang['id_barang'],
            'nm_barang' => $this->request->getVar('nm_barang'),
            'spek' => $this->request->getVar('spek'),
            'satuan' => ucwords($this->request->getVar('satuan')),
        ];

        $this->db->transStart();
        $this->barangModel->update($barang['id_barang'], $data);
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data barang gagal diubah.');
            return redirect()->to(base_url('item'));
        } elseif ($this->db->transStatus() == true) {
            session()->setflashdata('success', 'Data barang berhasil diubah.');
            return redirect()->to(base_url('item'));
        }
    }

    public function data_barang()
    {
        $request = \Config\Services::request();
        $keyword = $request->getPostGet('term');
        $barang = $this->barangModel->cari_barang($keyword);
        $w = array();
        foreach ($barang as $a) :
            $w[] = [
                "label" => $a['id_barang'] . ' - ' . $a['nm_barang'],
                "id_barang" => $a['id_barang'],
            ];
        endforeach;
        echo json_encode($w);
    }
}
