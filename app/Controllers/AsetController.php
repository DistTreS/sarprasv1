<?php

namespace App\Controllers;

use App\Models\AsetModel;
use App\Models\KategoriAsetModel; 

class AsetController extends BaseController
{
    protected $asetModel;
    protected $kategoriAsetModel;

    public function __construct()
    {
        $this->asetModel = new AsetModel();
        $this->kategoriAsetModel = new KategoriAsetModel();
    }

    public function index($id_kategori = null)
{
    if ($id_kategori) {
        $kategori = $this->kategoriAsetModel->find($id_kategori);
        if (!$kategori) {
            return redirect()->to('/aset')->with('error', 'Kategori tidak ditemukan.');
        }

        $data = [
            'title' => "Daftar Aset: " . $kategori['nama_kategori'],
            'kategori' => $kategori,
            'id_kategori' => $id_kategori, // Kirim ke view
            'asetList' => $this->asetModel->where('id_kategori', $id_kategori)->findAll()
        ];
    } else {
        $data = [
            'title' => "Daftar Semua Aset",
            'kategori' => null,
            'id_kategori' => null, // Pastikan dikirim meskipun null
            'asetList' => $this->asetModel->findAll()
        ];
    }

    return view('peminjaman/daftarAset', $data);
}


    public function create()
{
    $id_kategori = $this->request->getGet('id_kategori'); // Ambil id_kategori dari URL
    $data = [
        'title' => "Tambah Aset",
        'kategori' => $this->kategoriAsetModel->findAll(),
        'id_kategori' => $id_kategori // Kirim ke view
    ];
    return view('peminjaman/tambahAset', $data);
}

    // Menyimpan aset ke database
    public function store()
    {
        $idKategori = $this->request->getPost('id_kategori');
        $kategori = $this->kategoriAsetModel->find($idKategori);

        if (!$kategori) {
            die("Kategori tidak ditemukan!");  // Debugging
        }

        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/aset', $namaGambar);
        } else {
            die("Upload gambar gagal!"); // Debugging
        }

        $data = [
            'id_kategori' => $idKategori,
            'status'      => $this->request->getPost('status'),
            'kondisi'     => $this->request->getPost('kondisi'),
            'gambar'      => $namaGambar
        ];

        $this->asetModel->insert($data);

        return redirect()->to('/aset')->with('success', 'Aset berhasil ditambahkan berdasarkan kategori!');
        
    }

    // 🔹 Menampilkan form edit aset
    public function edit($id)
    {
        $aset = $this->asetModel->find($id);
        if (!$aset) {
            return redirect()->back()->with('error', 'Aset tidak ditemukan!');
        }

        $data = [
            'title' => "Edit Aset",
            'asetEdit' => $aset, 
            'kategori' => $this->kategoriAsetModel->findAll(),
            'asetList' => $this->asetModel->where('id_kategori', $aset['id_kategori'])->findAll() 
        ];

        return view('peminjaman/daftarAset', $data);
    }

    // 🔹 Update aset dan kembali ke daftar aset dalam kategori yang sama
    public function update()
    {
        $id = $this->request->getPost('id_aset');

        // Ambil id_kategori untuk redirect setelah update
        $aset = $this->asetModel->find($id);
        if (!$aset) {
            return redirect()->to('/aset')->with('error', 'Aset tidak ditemukan!');
        }
        $id_kategori = $aset['id_kategori'];

        if (!$this->validate([
            'status'  => 'required|in_list[Tersedia,Terpakai]',
            'kondisi' => 'required|in_list[Baik,Perbaikan]',
            'gambar'  => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal!');
        }

        $gambar = $this->request->getFile('gambar');
        $namaGambar = $aset['gambar']; // Gunakan gambar lama jika tidak diubah

        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/aset', $namaGambar);

            // Hapus gambar lama jika ada
            if (!empty($aset['gambar']) && file_exists('uploads/aset/' . $aset['gambar'])) {
                unlink('uploads/aset/' . $aset['gambar']);
            }
        }

        // Update data aset
        $this->asetModel->update($id, [
            'status'  => $this->request->getPost('status'),
            'kondisi' => $this->request->getPost('kondisi'),
            'gambar'  => $namaGambar
        ]);

        return redirect()->to('/aset/' . $id_kategori)->with('success', 'Aset berhasil diperbarui!');
    }

    public function delete($id)
    {
        // Ambil data aset sebelum dihapus
        $aset = $this->asetModel->find($id);

        if (!$aset) {
            return redirect()->to(base_url('aset'))->with('error', 'Aset tidak ditemukan.');
        }

        $id_kategori = $aset['id_kategori']; // Dapatkan kategori aset

        // Hapus aset
        $this->asetModel->delete($id);

        // Redirect kembali ke daftar aset berdasarkan kategori
        return redirect()->to(base_url('aset/' . $id_kategori))->with('success', 'Aset berhasil dihapus!');
    }

}
