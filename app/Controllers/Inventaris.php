<?php

namespace App\Controllers;

use App\Models\PersediaanInventarisModel;
use App\Models\RiwayatInventarisModel;
use App\Models\TransaksiInventarisModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Inventaris extends Controller
{
    protected $inventarisModel;
    
    public function __construct()
    {
        $this->inventarisModel = new PersediaanInventarisModel();
    }

    public function index()
    {
        $data['persediaan'] = $this->inventarisModel->findAll();
        return view('inventaris/index', $data);
    }

     // Form Tambah Data
     public function create()
     {
         return view('inventaris/create');
     }
    
     // Simpan Data Baru
     public function store()
     {
         $model = new PersediaanInventarisModel();
         
         // Simpan ke database
         $data = [
             'nama_barang'          => $this->request->getPost('nama_barang'),
             'satuan'               => $this->request->getPost('satuan'),
             'nilai'                => $this->request->getPost('nilai'),
             'deskripsi'           => $this->request->getPost('deskripsi'),
         ];
 
         $model->insert($data);
 
         return redirect()->to('/inventaris/index');
     }

      // Form Edit Data
    public function edit($id)
    {
        $data['persediaan'] = $this->inventarisModel->find($id);
        return view('inventaris/edit', $data);
    }

    // Update Data
    public function update($id)
    {
        $this->inventarisModel->update($id, $this->request->getPost());
        return redirect()->to('/inventaris');
    }

    // Hapus Data
    public function delete($id)
    {
        $this->inventarisModel->delete($id);
        return redirect()->to('/inventaris');
    }
}
