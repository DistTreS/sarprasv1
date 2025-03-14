<?php

namespace App\Controllers;

use App\Models\AsetModel;
use App\Models\KategoriAsetModel; 
use CodeIgniter\Exceptions\PageNotFoundException;

class AsetController extends BaseController
{
    protected $asetModel;
    protected $kategoriAsetModel;

    public function __construct()
    {
        $this->asetModel = new AsetModel();
        $this->kategoriAsetModel = new KategoriAsetModel();
    }

    public function index($kode_kategori = null) // Jadikan parameter opsional
    {
        $data = ['title' => "Daftar Aset"];

        if (!empty($kode_kategori)) {
            $kategori = $this->kategoriAsetModel->find($kode_kategori);
            if (!$kategori) {
                throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
            }
            $data['title'] = "Daftar Aset: " . $kategori['nama_kategori'];
            $data['kode_kategori'] = $kode_kategori;
            $data['asetList'] = $this->asetModel->where('kode_kategori', $kode_kategori)->findAll();
        } else {
            // Jika tidak ada kategori, ambil semua aset
            $data['asetList'] = $this->asetModel->findAll();
        }

        return view('peminjaman/daftarAset', $data);
    }



    public function indexPegawai($kode_kategori = null)
    {
        $data = ['title' => "Daftar Aset"];

        if (!empty($kode_kategori)) {
            $kategori = $this->kategoriAsetModel->find($kode_kategori);
            if (!$kategori) {
                throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
            }
            $data['title'] = "Daftar Aset: " . $kategori['nama_kategori'];
            $data['kategori'] = $kategori;
            $data['kode_kategori'] = $kode_kategori;
            $data['asetList'] = $this->asetModel->where('kode_kategori', $kode_kategori)->findAll();
        } else {
            // Jika tidak ada kategori, ambil semua aset
            $data['asetList'] = $this->asetModel->findAll();
        }

        return view('peminjaman/daftarAsetPegawai', $data);
    }


    public function cariAset($kode_kategori = null)
    {
        $search = $this->request->getGet('search'); // Bisa berupa nama aset atau NUP

        $data = ['title' => "Daftar Aset"];

        if (!empty($kode_kategori)) {
            $kategori = $this->kategoriAsetModel->find($kode_kategori);
            if (!$kategori) {
                throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
            }
            $data['title'] = "Daftar Aset: " . $kategori['nama_kategori'];
            $data['kode_kategori'] = $kode_kategori;

            // Pencarian berdasarkan nama aset atau NUP dalam kategori yang dipilih
            if (!empty($search)) {
                $data['asetList'] = $this->asetModel
                    ->where('kode_kategori', $kode_kategori)
                    ->groupStart()
                        ->like('nama_aset', $search)
                        ->orLike('nup', $search)
                    ->groupEnd()
                    ->findAll();
                $data['search'] = $search; // Simpan nilai pencarian untuk ditampilkan kembali
            } else {
                $data['asetList'] = $this->asetModel->where('kode_kategori', $kode_kategori)->findAll();
            }
        } else {
            // Jika tidak ada kategori, ambil semua aset
            $data['asetList'] = $this->asetModel->findAll();
        }

        return view('peminjaman/daftarAset', $data);
    }


    public function cariAsetPegawai($kode_kategori = null)
    {
        $search = $this->request->getGet('search'); // Bisa berupa nama aset atau NUP

        $data = ['title' => "Daftar Aset"];

        if (!empty($kode_kategori)) {
            $kategori = $this->kategoriAsetModel->find($kode_kategori);
            if (!$kategori) {
                throw PageNotFoundException::forPageNotFound('Kategori tidak ditemukan.');
            }
            $data['title'] = "Daftar Aset: " . $kategori['nama_kategori'];
            $data['kode_kategori'] = $kode_kategori;

            // Pencarian berdasarkan nama aset atau NUP dalam kategori yang dipilih
            if (!empty($search)) {
                $data['asetList'] = $this->asetModel
                    ->where('kode_kategori', $kode_kategori)
                    ->groupStart()
                        ->like('nama_aset', $search)
                        ->orLike('nup', $search)
                    ->groupEnd()
                    ->findAll();
                $data['search'] = $search; // Simpan nilai pencarian untuk ditampilkan kembali
            } else {
                $data['asetList'] = $this->asetModel->where('kode_kategori', $kode_kategori)->findAll();
            }
        } else {
            // Jika tidak ada kategori, ambil semua aset
            $data['asetList'] = $this->asetModel->findAll();
        }

        return view('peminjaman/daftarAsetPegawai', $data);
    }




    public function create()
    {
        $data = [
            'title' => "Tambah Aset",
            'kategori' => $this->kategoriAsetModel->findAll(),
            'kode_kategori' => old('kode_kategori', ''), // Tambahkan ini
            'validation' => \Config\Services::validation()
        ];
        return view('peminjaman/tambahAset', $data);
    }

    public function store()
    {
        // Debug: Periksa apakah data dari form terkirim
        

        // Validasi input
        if (!$this->validate([
            'nama_aset' => 'required',
            'nup' => 'required|numeric',
            'status_aset' => 'required',
            'kondisi' => 'required',
            'gambar' => 'uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/png,image/jpg,image/jpeg]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Harap isi semua field dengan benar.');
        }

        // Ambil data dari form
        $kode_kategori = $this->request->getPost('kode_kategori'); // 🔥 Data dari input hidden
        $nama_aset = $this->request->getPost('nama_aset');
        $nup = $this->request->getPost('nup');
        $status_aset = $this->request->getPost('status_aset');
        $kondisi = $this->request->getPost('kondisi');

        // Proses upload gambar
        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/aset', $namaGambar);
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar.');
        }

        // Debug: Pastikan gambar terupload
        

        // Simpan data ke database
        $this->asetModel->insert([
            'kode_kategori' => $kode_kategori,
            'nama_aset' => $nama_aset,
            'nup' => $nup,
            'status_aset' => $status_aset,
            'kondisi' => $kondisi,
            'gambar' => $namaGambar
        ]);

        return redirect()->to('kategoriAset/detail/' . $kode_kategori)->with('success', 'Aset berhasil ditambahkan!');
    }


    

    public function update($id_aset)
    {
        $asetModel = new AsetModel();
        $aset = $asetModel->find($id_aset);

        if (!$aset) {
            return redirect()->to(base_url('peminjaman/daftarAset'))->with('error', 'Data aset tidak ditemukan!');
        }

        $data = [
            'nama_aset' => $this->request->getPost('nama_aset'),
            'nup' => $this->request->getPost('nup'),
            'kondisi' => $this->request->getPost('kondisi'),
            'status_aset' => $this->request->getPost('status_aset'),
        ];

        // Jika ada gambar baru diunggah
        $gambar = $this->request->getFile('gambar');
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move('uploads/aset', $gambarName);
            $data['gambar'] = $gambarName;

            // Hapus gambar lama jika ada
            if (!empty($aset['gambar']) && file_exists('uploads/aset/' . $aset['gambar'])) {
                unlink('uploads/aset/' . $aset['gambar']);
            }
        }

        $asetModel->update($id_aset, $data);
        return redirect()->to(base_url('aset'))->with('success', 'Aset berhasil diperbarui');
    }

    

    public function delete($id)
    {
        $aset = $this->asetModel->find($id);
        if (!$aset) {
            throw PageNotFoundException::forPageNotFound('Aset tidak ditemukan.');
        }

        $kode_kategori = $aset['kode_kategori']?? null;

        $this->asetModel->delete($id);
        return redirect()->to('kategoriAset/detail/' . $kode_kategori)->with('success', 'Aset berhasil dihapus!');

    }

    public function edit($id_aset)
    {
        $aset = $this->asetModel->find($id_aset);

        if (!$aset) {
            return redirect()->to(base_url('peminjaman/daftarAset'))->with('error', 'Aset tidak ditemukan');
        }

        return view('peminjaman/editAset', ['title' => 'Edit Aset', 'aset' => $aset]);
    }

}
