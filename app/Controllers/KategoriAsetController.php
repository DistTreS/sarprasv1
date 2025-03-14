<?php

namespace App\Controllers;

use App\Models\KategoriAsetModel;
use CodeIgniter\Controller;

class KategoriAsetController extends Controller
{
    protected $kategoriAsetModel;

    public function __construct()
    {
        $this->kategoriAsetModel = new KategoriAsetModel();
    }

    // Menampilkan daftar kategori aset
    public function index()
    {
        $data['kategoriList'] = $this->kategoriAsetModel->getKategoriWithCount();
        return view('peminjaman/daftarKategoriAset', $data);
    }

    public function indexPegawai()
    {
        $data['kategoriList'] = $this->kategoriAsetModel->getKategoriWithCount();
        return view('peminjaman/daftarKategoriAsetPegawai', $data);
    }

    // Menampilkan halaman tambah kategori aset
    public function tambah()
    {
        return view('peminjaman/tambahKategoriAset');
    }

    // Menyimpan data kategori aset ke database
    public function store()
    {
        if (!$this->validate([
            'kode_kategori' => 'required|is_unique[kategori_aset.kode_kategori]',
            'nama_kategori' => 'required',
            'deskripsi'     => 'required',
        ])) {
            return redirect()->to('/kategoriAset/tambah')->withInput()->with('error', 'Data tidak valid!');
        }

        $this->kategoriAsetModel->insert([
            'kode_kategori' => $this->request->getPost('kode_kategori'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('/kategoriAset')->with('success', 'Kategori aset berhasil ditambahkan!');
    }

    // Menampilkan halaman edit kategori aset
    public function edit($kode_kategori)
    {
        $data['kategori'] = $this->kategoriAsetModel->find($kode_kategori);

        if (!$data['kategori']) {
            return redirect()->to('/kategoriAset')->with('error', 'Kategori tkodeak ditemukan!');
        }

        return view('peminjaman/editKategoriAset', $data);
    }

    // Mengupdate kategori aset
    public function update($kode_kategori = null)
    {
        $kategori = $this->kategoriAsetModel->find($kode_kategori);
        if (!$kode_kategori) {
            $kode_kategori = $this->request->getPost('kode_kategori');
        }        

        if (!$this->validate([
            'nama_kategori' => 'required',
            'deskripsi'     => 'required',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Data tidak valid!');
        }

        $this->kategoriAsetModel->update($kode_kategori, [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi')
        ]);

        return redirect()->to('/kategoriAset')->with('success', 'Kategori aset berhasil diperbarui!');
    }

    // Menghapus Data Kategori Aset
    public function delete($kode_kategori)
    {
        $kategori = $this->kategoriAsetModel->find($kode_kategori);
        if (!$kategori) {
            return redirect()->to('/kategoriAset')->with('error', 'Kategori tkodeak ditemukan!');
        }

        $this->kategoriAsetModel->delete($kode_kategori);
        return redirect()->to('/kategoriAset')->with('success', 'Kategori aset berhasil dihapus!');
    }
}
