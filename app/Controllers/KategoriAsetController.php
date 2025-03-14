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

    public function indexpegawai()
    {
        $data['kategoriList'] = $this->kategoriAsetModel->getKategoriWithCount();
        return view('peminjaman/daftarKategoriAsetPegawai', $data);
    }

    public function indexWithCount()
    {
        $data['kategoriList'] = $this->kategoriAsetModel->getKategoriWithCount();
        return view('peminjaman/daftarKategoriAset', $data);
    }

    // Menampilkan halaman tambah kategori aset
    public function tambah()
    {
        return view('peminjaman/tambahKategoriAset'); // Nama file diperbaiki
    }

    // Menyimpan data kategori aset ke database
    public function store()
    {
        if (!$this->validate([
            'kode_kategori' => 'required|is_unique[kategori_aset.kode_kategori]',
            'nama_kategori' => 'required',
            'deskripsi'     => 'required',
        ])) {
            return redirect()->to('kategoriAset/tambah')->withInput()->with('error', 'Data tidak valid!');
        }

        $this->kategoriAsetModel->insert([
            'kode_kategori' => $this->request->getPost('kode_kategori'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to('kategoriAset')->with('success', 'Kategori aset berhasil ditambahkan!');
    }

    public function update()
    {
        $kategoriModel = new KategoriAsetModel();

        $kodeKategori = $this->request->getPost('kode_kategori');
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi'     => $this->request->getPost('deskripsi')
        ];

        if (!empty($kodeKategori)) {
            $kategoriModel->where('kode_kategori', $kodeKategori)->set($data)->update();
            
            // ✅ Arahkan kembali ke daftar aset dalam kategori yang diperbarui
            return redirect()->to(base_url('kategoriAset'))->with('success', 'Kategori berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Kode kategori tidak ditemukan!');
        }
    }

    // Menghapus Data Kategori Aset
    public function delete($kode_kategori)
    {
    $this->kategoriAsetModel->where('kode_kategori', $kode_kategori)->delete();
    return redirect()->to('/kategoriAset')->with('success', 'Kategori Aset berhasil dihapus');
    }
}
