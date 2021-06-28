<?php

namespace App\Controllers;

use App\Models\HistoryModel;

class History extends BaseController
{
    protected $historyModel;

    public function __construct()
    {
        $this->historyModel = new HistoryModel();
    }

    public function index()
    {
        $currentpage = $this->request->getVar('page_history') ? $this->request->getVar('page_history') : 1;
        $keyword = $this->request->getVar('keyword');
        $history = $this->historyModel->orderBy('created_at', 'DESC');
        $data = [
            'title' => 'History',
            'history'  => $history->paginate(25, 'history'),
            'pager' => $this->historyModel->pager,
            'act'   => 'history',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/history/index', $data);
    }

    public function pencarian()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword)
            return redirect()->to(base_url('/history/search/' . $keyword))->withInput();
        else
            return redirect()->to(base_url('/history'));
    }

    public function cari($keyword)
    {
        $currentpage = $this->request->getVar('page_history') ? $this->request->getVar('page_history') : 1;
        $history = $this->historyModel->cari($keyword);

        $data = [
            'title' => 'History',
            'history'  => $history->paginate(25, 'history'),
            'pager' => $this->historyModel->pager,
            'act'   => 'history',
            'currentPage' => $currentpage,
            'keyword' => $keyword,
        ];
        return view('admin/history/index', $data);
    }
}
