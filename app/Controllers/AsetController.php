<?php

namespace App\Controllers;

use App\Models\AsetModel;
use App\Models\KategoriAsetModel; // Tambahkan ini!

class AsetController extends BaseController
{
    protected $asetModel;
    protected $kategoriAsetModel;

    public function __construct()
    {
        $this->asetModel = new AsetModel();
        $this->kategoriAsetModel = new KategoriAsetModel();
    }

    public function index()
    {
        $data['asetList'] = $this->asetModel
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori')
            ->findAll();

        return view('peminjaman/daftarAset', $data);

    }

    // Form tambah aset
    public function create()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        return view('peminjaman/tambahAset', $data);
    }

    // Menyimpan aset ke database
    public function store()
    {
        if (!$this->validate([
            'id_kategori' => 'required|integer',
            'status'      => 'required|in_list[Tersedia,Terpakai]',
            'kondisi'     => 'required|in_list[Baik,Perbaikan]',
            'gambar'      => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal!');
        }

        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/aset', $namaGambar);
        } else {
            return redirect()->back()->withInput()->with('error', 'Upload gambar gagal');
        }

        $this->asetModel->save([
            'id_kategori' => $this->request->getPost('id_kategori'),
            'status'      => $this->request->getPost('status'),
            'kondisi'     => $this->request->getPost('kondisi'),
            'gambar'      => $namaGambar
        ]);

        return redirect()->to('/aset')->with('success', 'Aset berhasil ditambahkan!');
    }

    // Form edit aset
    public function edit($id)
    {
        $data['aset'] = $this->asetModel->find($id);
        $data['kategori'] = $this->kategoriModel->findAll();
        return view('peminjaman/editAset', $data);
    }

    // Update aset
    public function update($id)
    {
        if (!$this->validate([
            'id_kategori' => 'required|integer',
            'status'      => 'required|in_list[Tersedia,Terpakai]',
            'kondisi'     => 'required|in_list[Baik,Perbaikan]',
            'gambar'      => 'max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal!');
        }

        $aset = $this->asetModel->find($id);
        $gambar = $this->request->getFile('gambar');
        $namaGambar = $aset['gambar']; // Gunakan gambar lama jika tidak diubah

        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/aset', $namaGambar);
            unlink('uploads/aset/' . $aset['gambar']); // Hapus gambar lama
        }

        $this->asetModel->update($id, [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'status'      => $this->request->getPost('status'),
            'kondisi'     => $this->request->getPost('kondisi'),
            'gambar'      => $namaGambar
        ]);

        return redirect()->to('/aset')->with('success', 'Aset berhasil diperbarui!');
    }

    // Hapus aset
    public function delete($id)
    {
        $aset = $this->asetModel->find($id);
        if ($aset) {
            unlink('uploads/aset/' . $aset['gambar']);
            $this->asetModel->delete($id);
        }
        return redirect()->to('/aset')->with('success', 'Aset berhasil dihapus!');
    }
}
