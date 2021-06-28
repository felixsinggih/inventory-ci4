<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\SuplaiModel;
use App\Models\SuplaiDetailModel;
use App\Models\WebModel;
use Dompdf\Dompdf;

class Suplai extends BaseController
{
    protected $barangModel;
    protected $suplaiModel;
    protected $suplaiDetailModel;
    protected $webModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->suplaiModel = new SuplaiModel();
        $this->suplaiDetailModel = new SuplaiDetailModel();
        $this->webModel = new WebModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_supply') ? $this->request->getVar('page_supply') : 1;
        $keyword = $this->request->getVar('keyword');
        $suplai = $this->suplaiModel->orderBy('tanggal', 'DESC');
        $data = [
            'title' => 'Data Barang Masuk',
            'suplai'  => $suplai->paginate(25, 'supply'),
            'pager' => $this->suplaiModel->pager,
            'act'   => 'barang',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/suplai/index', $data);
    }

    public function pencarian()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword)
            return redirect()->to(base_url('/supply/search/' . $keyword))->withInput();
        else
            return redirect()->to(base_url('/supply'));
    }

    public function cari($keyword)
    {
        $currentpage = $this->request->getVar('page_supply') ? $this->request->getVar('page_supply') : 1;
        $suplai = $this->suplaiModel->cari($keyword);
        $data = [
            'title' => 'Data Barang Masuk',
            'suplai'  => $suplai->paginate(25, 'supply'),
            'pager' => $this->suplaiModel->pager,
            'act'   => 'barang',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/suplai/index', $data);
    }

    public function tambah()
    {
        $cart = \Config\Services::cart();

        $data = [
            'title' => 'Tambah Barang Masuk',
            'cart'  => $cart,
            'act'   => 'barang',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/suplai/add', $data);
    }

    public function tambah_barang()
    {
        if (!$this->validate([
            'id_barang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan lakukan pencarian!',
                ]
            ]
        ])) {
            return redirect()->to(base_url('supply/new'))->withInput();
        }

        $idBarang = $this->request->getVar('id_barang');
        $barang = $this->barangModel->find($idBarang);

        $cart = \Config\Services::cart();
        $cart->insert(array(
            'id'      => $barang['id_barang'],
            'qty'     => 1,
            'name'    => $barang['nm_barang'],
            'price'   => '0',
            'options' => array('spek' => $barang['spek'])
        ));
        // ketika price dihilangkan barang tidak bisa dimasukan
        return redirect()->to(base_url('supply/new'));
    }

    public function edit_barang()
    {
        $rowid = $this->request->getVar('rowid');
        $jumlah = $this->request->getVar('jumlah');

        if ($jumlah == 0) {
            return redirect()->to(base_url('supply/delete/' . $rowid));
        } else {
            $cart = \Config\Services::cart();
            $cart->update(array(
                'rowid'   => $rowid,
                'qty'     => $jumlah
            ));
            return redirect()->to(base_url('supply/new'));
        }
    }

    public function hapus_barang($rowID)
    {
        $cart = \Config\Services::cart();
        $cart->remove($rowID);
        return redirect()->to(base_url('supply/new'));
    }

    public function clear()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to(base_url('supply/new'));
    }

    public function simpan()
    {
        if (!$this->validate([
            'penyuplai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom penyuplai wajib diisi!',
                ]
            ],
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom tanggal masuk wajib diisi!',
                ]
            ]
        ])) {
            return redirect()->to(base_url('supply/new'))->withInput();
        }

        $cart = \Config\Services::cart();
        $tglMasuk = $this->request->getVar('tanggal');
        $idSuplai = $this->suplaiModel->kodegen($tglMasuk);

        $suplai = [
            'id_suplai' => $idSuplai,
            'penyuplai' =>  $this->request->getVar('penyuplai'),
            'tanggal'   => $tglMasuk,
            'keterangan'    =>  $this->request->getVar('keterangan')
        ];

        $suplaiDetail = array();
        $barangEdit = array();
        foreach ($cart->contents() as $data) :
            $detail = [
                'id_suplai' => $idSuplai,
                'id_barang' => $data['id'],
                'jumlah'    => $data['qty']
            ];

            $barangCek = $this->barangModel->find($data['id']);
            $barang = [
                'id_barang' => $data['id'],
                'stok'      => ($barangCek['stok'] + $data['qty'])
            ];

            array_push($suplaiDetail, $detail);
            array_push($barangEdit, $barang);
        endforeach;

        $this->db->transStart();
        $this->suplaiModel->insert($suplai);
        $this->suplaiDetailModel->insertBatch($suplaiDetail);
        $this->barangModel->updateBatch($barangEdit, 'id_barang');
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data barang masuk gagal disimpan.');
            return redirect()->to(base_url('supply/new'));
        } elseif ($this->db->transStatus() == true) {
            $cart->destroy();
            session()->setflashdata('success', 'Data barang masuk berhasil disimpan.');
            return redirect()->to(base_url('supply/' . $idSuplai));
        }
    }

    public function detail($idSuplai)
    {
        $suplai = $this->suplaiModel->find($idSuplai);
        $suplaiDetail = $this->suplaiDetailModel->detail($idSuplai);

        $data = [
            'title' => 'Detail Barang Masuk',
            'suplai' => $suplai,
            'suplaiDetail' => $suplaiDetail,
            'act'   => 'barang',
        ];
        return view('admin/suplai/detail', $data);
    }

    function print($idSuplai)
    {
        $suplai = $this->suplaiModel->find($idSuplai);
        $suplaiDetail = $this->suplaiDetailModel->detail($idSuplai);
        $web = $this->webModel->find(1);

        $data = [
            'title'    => "Laporan Barang Masuk ",
            'suplai' => $suplai,
            'suplaiDetail' => $suplaiDetail,
            'web' => $web
        ];

        $fileName = "Barang_Masuk_" . $suplai['id_suplai'] . ".pdf";
        $html = view('admin/suplai/print', $data);
        $dompdf = new Dompdf();
        $dompdf->setPaper('legal', 'potrait');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream($fileName);
    }
}
