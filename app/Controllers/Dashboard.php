<?php

namespace App\Controllers;

use App\Models\PesertaDiklatModel;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('pages/dashboard');
    }

    public function indexpegawai()
    {
        return view('pages/dashboardpegawai');
    }

    public function indexguest()
    {
        $pesertaDiklatModel = new PesertaDiklatModel();
        $keyword = $this->request->getGet('keyword');

        
        $publikasi = $pesertaDiklatModel->getPublikasiTugasAkhir($keyword);

        return view('pages/dashboardguest', [
            'publikasi' => $publikasi,
            'keyword' => $keyword
        ]);
    }
}
