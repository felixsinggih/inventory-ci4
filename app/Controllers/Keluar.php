<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\KeluarModel;
use App\Models\KeluarDetailModel;
use App\Models\WebModel;
use Dompdf\Dompdf;

class Keluar extends BaseController
{
    protected $barangModel;
    protected $keluarModel;
    protected $keluarDetailModel;
    protected $webModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->keluarModel = new KeluarModel();
        $this->keluarDetailModel = new KeluarDetailModel();
        $this->webModel = new WebModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_export') ? $this->request->getVar('page_export') : 1;
        $keyword = $this->request->getVar('keyword');
        $keluar = $this->keluarModel->orderBy('tanggal', 'DESC');
        $data = [
            'title' => 'Data Barang Keluar',
            'keluar'  => $keluar->paginate(25, 'export'),
            'pager' => $this->keluarModel->pager,
            'act'   => 'barang',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/keluar/index', $data);
    }

    public function pencarian()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword)
            return redirect()->to(base_url('/export/search/' . $keyword))->withInput();
        else
            return redirect()->to(base_url('/export'));
    }

    public function cari($keyword)
    {
        $currentpage = $this->request->getVar('page_export') ? $this->request->getVar('page_export') : 1;
        $keluar = $this->keluarModel->cari($keyword);
        $data = [
            'title' => 'Data Barang Keluar',
            'keluar'  => $keluar->paginate(25, 'export'),
            'pager' => $this->keluarModel->pager,
            'act'   => 'barang',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/keluar/index', $data);
    }

    public function tambah()
    {
        $cartKeluar = \Config\Services::cart();

        $data = [
            'title' => 'Tambah Barang Keluar',
            'cartKeluar'  => $cartKeluar,
            'act'   => 'barang',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/keluar/add', $data);
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
            return redirect()->to(base_url('export/new'))->withInput();
        }

        $idBarang = $this->request->getVar('id_barang');
        $stok = $this->request->getVar('stok');
        $barang = $this->barangModel->find($idBarang);

        if ($barang['stok'] == 0) {
            session()->setflashdata('failed', 'Stok untuk barang bernama ' . $barang['nm_barang'] . ' tidak tersedia.');
            return redirect()->to(base_url('export/new'));
        }

        $cartKeluar = \Config\Services::cart();
        $cartKeluar->insert(array(
            'id'      => $barang['id_barang'],
            'qty'     => 1,
            'name'    => $barang['nm_barang'],
            'price'   => '0',
            'options' => array('spek' => $barang['spek'])
        ));
        // ketika price dihilangkan barang tidak bisa dimasukan
        return redirect()->to(base_url('export/new'));
    }

    public function edit_barang()
    {
        $rowid = $this->request->getVar('rowid');
        $idBarang = $this->request->getVar('id_barang');
        $jumlah = $this->request->getVar('jumlah');

        if ($jumlah == 0) {
            return redirect()->to(base_url('export/delete/' . $rowid));
        } else {
            $barang = $this->barangModel->find($idBarang);
            if ($jumlah > $barang['stok']) {
                session()->setflashdata('failed', 'Stok untuk barang bernama ' . $barang['nm_barang'] . ' hanya tersedia ' . $barang['stok'] . ' ' . $barang['satuan']);
                return redirect()->to(base_url('export/new'));
            } else {
                $cartKeluar = \Config\Services::cart();
                $cartKeluar->update(array(
                    'rowid'   => $rowid,
                    'qty'     => $jumlah
                ));
                return redirect()->to(base_url('export/new'));
            }
        }
    }

    public function hapus_barang($rowID)
    {
        $cartKeluar = \Config\Services::cart();
        $cartKeluar->remove($rowID);
        return redirect()->to(base_url('export/new'));
    }

    public function clear()
    {
        $cartKeluar = \Config\Services::cart();
        $cartKeluar->destroy();
        return redirect()->to(base_url('export/new'));
    }

    public function simpan()
    {
        if (!$this->validate([
            'tanggal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kolom tanggal keluar wajib diisi!',
                ]
            ]
        ])) {
            return redirect()->to(base_url('export/new'))->withInput();
        }

        $cartKeluar = \Config\Services::cart();
        $tglKeluar = $this->request->getVar('tanggal');
        $idKeluar = $this->keluarModel->kodegen($tglKeluar);

        $keluar = [
            'id_keluar' => $idKeluar,
            'tanggal' => $tglKeluar,
            'keterangan' =>  $this->request->getVar('keterangan')
        ];

        $keluarDetail = array();
        $barangEdit = array();
        foreach ($cartKeluar->contents() as $data) :
            $detail = [
                'id_keluar' => $idKeluar,
                'id_barang' => $data['id'],
                'jumlah'    => $data['qty'],
                'spek'  => $data['options']['spek']
            ];

            $barangKeluar = $this->barangModel->find($data['id']);
            $barang = [
                'id_barang' => $data['id'],
                'stok'      => ($barangKeluar['stok'] - $data['qty'])
            ];

            array_push($keluarDetail, $detail);
            array_push($barangEdit, $barang);
        endforeach;

        $this->db->transStart();
        $this->keluarModel->insert($keluar);
        $this->keluarDetailModel->insertBatch($keluarDetail);
        $this->barangModel->updateBatch($barangEdit, 'id_barang');
        $this->db->transComplete();

        if ($this->db->transStatus() == false) {
            session()->setflashdata('failed', 'Data barang keluar gagal disimpan.');
            return redirect()->to(base_url('export/new'));
        } elseif ($this->db->transStatus() == true) {
            $cartKeluar->destroy();
            session()->setflashdata('success', 'Data barang keluar berhasil disimpan.');
            return redirect()->to(base_url('export/' . $idKeluar));
        }
    }

    public function detail($idKeluar)
    {
        $keluar = $this->keluarModel->find($idKeluar);
        $keluarDetail = $this->keluarDetailModel->detail($idKeluar);

        $data = [
            'title' => 'Detail Barang Keluar',
            'keluar' => $keluar,
            'keluarDetail' => $keluarDetail,
            'act'   => 'barang',
        ];
        return view('admin/keluar/detail', $data);
    }

    function print($idKeluar)
    {
        $keluar = $this->keluarModel->find($idKeluar);
        $keluarDetail = $this->keluarDetailModel->detail($idKeluar);
        $web = $this->webModel->find(1);

        $data = [
            'title'    => "Laporan Barang Keluar ",
            'keluar' => $keluar,
            'keluarDetail' => $keluarDetail,
            'web' => $web
        ];

        $fileName = "Barang_Keluar_" . $keluar['id_keluar'] . ".pdf";
        $html = view('admin/keluar/print', $data);
        $dompdf = new Dompdf();
        $dompdf->setPaper('legal', 'potrait');
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream($fileName);
    }
}
