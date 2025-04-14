<?php

namespace App\Controllers;

use App\Models\AsetRusakModel;
use App\Models\AsetModel;
use App\Models\UsersModel;
use App\Models\KategoriAsetModel;
use CodeIgniter\Controller;
use TCPDF;

class AsetRusakController extends Controller
{
    protected $asetRusakModel;
    protected $asetModel;
    protected $usersModel;
    protected $kategoriAsetModel;

    public function __construct()
    {
        $this->asetRusakModel = new AsetRusakModel();
        $this->asetModel = new AsetModel();
        $this->usersModel = new UsersModel();
        $this->kategoriAsetModel = new KategoriAsetModel();
    }

    // ===============================
    // ADMIN FUNCTIONS
    // ===============================

    // Menampilkan daftar aset rusak untuk admin
    public function index()
    {
        $data['asetRusakList'] = $this->asetRusakModel
            ->select('aset_rusak.*, kategori_aset.nama_kategori, users.full_name')
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset')
            ->join('kategori_aset', 'kategori_aset.kode_kategori = aset.kode_kategori')
            ->join('users', 'users.id = aset_rusak.id', 'left')
            ->findAll();

        return view('peminjaman/pengajuanAsetRusak', $data);
    }

    // Melihat detail aset rusak
    public function detail($id_user, $id_aset)
    {
        $data['asetRusak'] = $this->asetRusakModel
            ->select('aset_rusak.*, kategori_aset.nama_kategori, users.full_name AS nama_pelapor')
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset')
            ->join('kategori_aset', 'kategori_aset.kode_kategori = aset.kode_kategori')
            ->join('users', 'users.id = aset_rusak.id')
            ->where('aset_rusak.id', $id_user)
            ->where('aset_rusak.id_aset', $id_aset)
            ->first();

        if (!$data['asetRusak']) {
            return redirect()->to('/aset-rusak')->with('error', 'Data tidak ditemukan.');
        }

        return view('peminjaman/detailAsetRusak', $data);
    }


    // Cetak laporan aset rusak dalam bentuk PDF
    public function cetak($id_rusak)
    {
        // Implementasi fungsi cetak PDF
    }

    // ===============================
    // USER PEGAWAI FUNCTIONS
    // ===============================

    // Menampilkan riwayat pengajuan aset rusak untuk pegawai
    public function riwayat()
    {
        // Ambil ID user dari sesi
        $id_user = session()->get('user_id');

        // Redirect jika tidak ada sesi login
        if (!$id_user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data aset rusak dengan join ke tabel aset & kategori_aset
        $data['asetRusakList'] = $this->asetRusakModel
            ->select('aset_rusak.id, aset_rusak.id_aset, aset_rusak.tanggal_pengajuan, aset_rusak.status_kerusakan, aset_rusak.status_kerusakan AS status_kerusakan, aset.nama_aset, kategori_aset.nama_kategori')
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset', 'left')
            ->join('kategori_aset', 'kategori_aset.kode_kategori = aset.kode_kategori', 'left')
            ->where('aset_rusak.id', $id_user)
            ->orderBy('aset_rusak.tanggal_pengajuan', 'DESC')
            ->findAll();

        return view('peminjaman/asetRusakPegawai', $data);
    }


    // Melihat detail pengajuan aset rusak oleh pegawai
    public function detailpegawai($id, $id_aset)
    {
        $id = session()->get('user_id');
        $data['asetRusak'] = $this->asetRusakModel
            ->select('aset_rusak.*, kategori_aset.nama_kategori')
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset', 'left')
            ->join('kategori_aset', 'kategori_aset.kode_kategori = aset.kode_kategori', 'left')
            ->where('aset_rusak.id', $id)
            ->where('aset_rusak.id_aset', $id_aset)
            ->first();

        if (!$data['asetRusak']) {
            return redirect()->to('/aset-rusak/pegawai')->with('error', 'Data tidak ditemukan.');
        }

        return view('peminjaman/detailAsetRusakPegawai', $data);
    }

    // Menampilkan halaman pengajuan aset rusak oleh pegawai
    public function pengajuan()
    {
        $id = session()->get('user_id');
        if (!$id) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $data['asetList'] = $this->asetModel
            ->select('aset.id_aset, aset.nup, aset.nama_aset, kategori_aset.nama_kategori')
            ->join('kategori_aset', 'kategori_aset.kode_kategori = aset.kode_kategori', 'left')
            ->findAll();

        return view('peminjaman/pengajuanAsetRusakPegawai', $data);
    }

    public function pengajuanAdmin()
    {
        $id = session()->get('user_id');
        if (!$id) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $data['asetList'] = $this->asetModel
            ->select('aset.id_aset, aset.nup, aset.nama_aset, kategori_aset.nama_kategori')
            ->join('kategori_aset', 'kategori_aset.kode_kategori = aset.kode_kategori', 'left')
            ->findAll();

        return view('peminjaman/pengajuanAsetRusakAdmin', $data);
    }

    // Menyimpan pengajuan aset rusak oleh pegawai
    //📌 Fungsi untuk menyimpan pengajuan aset rusak
    public function simpanPengajuan()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_aset' => 'required|integer',
            'status_kerusakan' => 'required|in_list[Rusak Ringan,Rusak Sedang,Rusak Berat]',
            'keterangan' => 'required',
            'bukti_foto' => 'uploaded[bukti_foto]|max_size[bukti_foto,2048]|is_image[bukti_foto]|mime_in[bukti_foto,image/png,image/jpeg,image/jpg]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', implode(", ", $validation->getErrors()));
        }

        // Upload Foto
        $buktiFoto = $this->request->getFile('bukti_foto');
        $namaFoto = $buktiFoto->getRandomName();
        $buktiFoto->move('uploads/aset_rusak/', $namaFoto);

        // Ambil ID user yang sedang login
        $id_user = session()->get('user_id');

        // Gunakan tanggal saat ini sebagai tanggal pengajuan
        $tanggal_pengajuan = date('Y-m-d');

        // Simpan Data ke Database
        $this->asetRusakModel->insert([
            'id_aset' => $this->request->getPost('id_aset'),
            'id' => $id_user,
            'tanggal_pengajuan' => $tanggal_pengajuan,
            'status_kerusakan' => $this->request->getPost('status_kerusakan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_foto' => $namaFoto,
            'status_pengajuan' => 'Diajukan'
        ]);

        return redirect()->to(base_url('aset-rusak/riwayat'))->with('success', 'Pengajuan berhasil disimpan.');
    }

    public function simpanPengajuanAdmin()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_aset' => 'required|integer',
            'status_kerusakan' => 'required|in_list[Rusak Ringan,Rusak Sedang,Rusak Berat]',
            'keterangan' => 'required',
            'bukti_foto' => 'uploaded[bukti_foto]|max_size[bukti_foto,2048]|is_image[bukti_foto]|mime_in[bukti_foto,image/png,image/jpeg,image/jpg]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', implode(", ", $validation->getErrors()));
        }

        // Upload Foto
        $buktiFoto = $this->request->getFile('bukti_foto');
        $namaFoto = $buktiFoto->getRandomName();
        $buktiFoto->move('uploads/aset_rusak/', $namaFoto);

        // Ambil ID user yang sedang login
        $id_user = session()->get('user_id');

        // Gunakan tanggal saat ini sebagai tanggal pengajuan
        $tanggal_pengajuan = date('Y-m-d');

        // Simpan Data ke Database
        $this->asetRusakModel->insert([
            'id_aset' => $this->request->getPost('id_aset'),
            'id' => $id_user,
            'tanggal_pengajuan' => $tanggal_pengajuan,
            'status_kerusakan' => $this->request->getPost('status_kerusakan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_foto' => $namaFoto,
            'status_pengajuan' => 'Diajukan'
        ]);

        return redirect()->to(base_url('aset_rusak'))->with('success', 'Pengajuan berhasil disimpan.');
    }
}
