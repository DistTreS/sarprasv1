<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\AsetModel;
use CodeIgniter\Controller;

class PeminjamanController extends Controller
{
    protected $peminjamanModel;
    protected $asetModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
        $this->asetModel = new AsetModel();
    }

    // ADMIN: Menampilkan daftar peminjaman
    public function index()
    {
        $data['peminjaman'] = $this->peminjamanModel->getAllPeminjaman();
        return view('peminjaman/riwayat', $data);
    }

    // ADMIN: Menampilkan detail peminjaman
    public function detail($id_peminjaman)
    {
        $data['peminjaman'] = $this->peminjamanModel->getDetailPeminjaman($id_peminjaman);

        if (!$data['peminjaman']) {
            return redirect()->to('peminjaman')->with('error', 'Data tidak ditemukan.');
        }

        return view('peminjaman/detailPengajuan', $data);
    }

    // ADMIN: Mengubah status peminjaman
    public function update_status($id_peminjaman)
    {
        if ($this->request->getMethod() === 'post') {
            $status_peminjaman = $this->request->getPost('status_peminjaman');

            // Tentukan status layanan berdasarkan status peminjaman
            if ($status_peminjaman === 'Disetujui') {
                $status_layanan = 'Proses';
            } elseif ($status_peminjaman === 'Ditolak') {
                $status_layanan = 'Selesai';
            } else {
                $status_layanan = 'Pengajuan';
            }

            // Update data di database
            $this->peminjamanModel->update($id_peminjaman, [
                'status_peminjaman' => $status_peminjaman,
                'status_layanan' => $status_layanan
            ]);

            // Redirect kembali dengan pesan sukses
            return redirect()->to('peminjaman')->with('success', 'Status peminjaman berhasil diperbarui.');
        }

        return redirect()->to('peminjaman')->with('error', 'Metode tidak valid.');
    }

    // ADMIN: Melakuan perubahan pada pengembalian
    public function pengembalianAdmin($id_peminjaman)
    {
        $peminjaman = $this->peminjamanModel
            ->select('peminjaman.*, users.full_name AS nama_pegawai, aset.nama_aset')
            ->join('users', 'users.id = peminjaman.id_peminjaman', 'left')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
            ->where('peminjaman.id_peminjaman', $id_peminjaman)
            ->first();

        if (!$peminjaman) {
            return redirect()->to(base_url('peminjaman'))->with('error', 'Data tidak ditemukan');
        }

        return view('peminjaman/pengembalianAdmin', ['peminjaman' => $peminjaman]);
    }

    // ADMIN: Melakuan persetujuan pada pengembalian
    public function setujui($id_peminjaman)
    {
        $peminjamanModel = new PeminjamanModel();
        $peminjaman = $peminjamanModel->find($id_peminjaman);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Periksa apakah bukti_pengembalian sudah ada
        if (empty($peminjaman['bukti_pengembalian'])) {
            return redirect()->back()->with('error', 'Bukti pengembalian belum diunggah.');
        }

        // Update status menjadi "Selesai"
        $peminjamanModel->update($id_peminjaman, ['status_layanan' => 'Selesai']);

        log_message('info', 'Pengembalian aset dengan ID ' . $id_peminjaman . ' telah disetujui.');

        return redirect()->back()->with('success', 'Pengembalian telah disetujui.');
    }

    // ADMIN: Melakuan penolakan pada pengembalian
    public function tolak($id_peminjaman)
    {
        $peminjamanModel = new PeminjamanModel();
        $peminjaman = $peminjamanModel->find($id_peminjaman);

        if (!$peminjaman) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Hapus bukti pengembalian sebelumnya
        $buktiLama = $peminjaman['bukti_pengembalian'];
        if (!empty($buktiLama)) {
            $filePath = WRITEPATH . '../public/uploads/bukti_pengembalian/' . $buktiLama;
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file lama
            }
        }

        // Set status tetap "Proses", kosongkan bukti_pengembalian, dan tambahkan pesan penolakan
        $peminjamanModel->update($id_peminjaman, [
            'status_layanan' => 'Proses',
            'bukti_pengembalian' => null,
            'pesan_penolakan' => 'Bukti pengembalian ditolak. Silakan unggah ulang dengan bukti yang valid.'
        ]);

        return redirect()->back()->with('success', 'Bukti pengembalian berhasil ditolak. Pengguna harus mengunggah ulang.');
    }

    // PEGAWAI: Menampilkan daftar peminjaman
    public function indexPegawai()
    {
        $userId = session()->get('user_id'); // Ambil user_id dari session

        // Mengambil data peminjaman beserta nama aset
        $data['peminjaman'] = $this->peminjamanModel
            ->select('peminjaman.*, aset.nama_aset, aset.nup') // Pilih semua kolom dari peminjaman + nama_aset
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left') // Gabungkan dengan tabel aset
            ->where('peminjaman.id', $userId) // Filter hanya data user yang sedang login
            ->orderBy('peminjaman.tanggal_peminjaman', 'DESC')
            ->findAll();

        return view('peminjaman/riwayatPegawai', $data);
    }

    // PEGAWAI: Detail Pengajuan Peminjaman
    public function detailPengajuanPegawai($id_peminjaman)
    {
        $userId = session()->get('user_id'); // Ambil ID user dari session

        // Ambil data peminjaman berdasarkan ID peminjaman dan ID user untuk keamanan
        $data['peminjaman'] = $this->peminjamanModel
            ->select('peminjaman.*, aset.nama_aset, aset.nup, users.no_telepon, peminjaman.bukti_pengembalian') // Tambahkan bukti_pengembalian
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
            ->join('users', 'users.id = peminjaman.id', 'left')
            ->where('peminjaman.id_peminjaman', $id_peminjaman)
            ->where('peminjaman.id', $userId)
            ->first();


        // Jika tidak ditemukan, tampilkan error 404
        if (!$data['peminjaman']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data peminjaman tidak ditemukan.');
        }

        // Tampilkan view dengan data
        return view('peminjaman/detailPengajuanPegawai', $data);
    }


    // PEGAWAI: Form pengajuan peminjaman
    public function formPengajuan()
    {
        $data = [
            'title' => "Form Pengajuan Peminjaman",
            'asetList' => $this->asetModel->where('status_aset', 'Tersedia')->findAll() // 🔥 Hanya ambil yang "Tersedia"
        ];

        return view('peminjaman/formPengajuan', $data);
    }


    // PEGAWAI: Simpan data pengajuan peminjaman
    public function simpanPengajuan()
    {
        $id_user = session()->get('user_id'); // ID user
        $id_pengajuan = uniqid('PNJ-');
        $id_aset_list = $this->request->getPost('id_aset'); // Ambil daftar aset (array)
        $tanggal_rencana_pengembalian = $this->request->getPost('tanggal_rencana_pengembalian');
        $CC = $this->request->getPost('CC');
        $keterangan = $this->request->getPost('keterangan');

        if (!empty($id_aset_list)) {
            foreach ($id_aset_list as $id_aset) {
                $data = [
                    'id' => $id_user,
                    'id_aset' => $id_aset,
                    'tanggal_rencana_pengembalian' => $tanggal_rencana_pengembalian,
                    'CC' => $CC,
                    'keterangan' => $keterangan,
                    'status_peminjaman' => 'Belum Disetujui',
                    'status_layanan' => 'Pengajuan',
                    'tanggal_peminjaman' => date('Y-m-d'),
                    'id_pengajuan' => $id_pengajuan
                ];

                // Simpan ke database
                $this->peminjamanModel->save($data);

                // Update status aset menjadi "Terpakai"
                $this->asetModel->update($id_aset, ['status_aset' => 'Terpakai']);
            }
        }

        return redirect()->to('/pegawai/peminjaman')->with('success', 'Pengajuan peminjaman berhasil diajukan.');
    }



    // PEGAWAI: Form pengembalian aset
    public function pengembalianpegawai($id)
    {
        $data['peminjaman'] = $this->peminjamanModel->find($id);
        return view('peminjaman/formPengembalian', $data);
    }

    public function uploadPengembalian($id)
    {
        // Ambil data peminjaman
        $peminjaman = $this->peminjamanModel->find($id);

        if (!$peminjaman) {
            return redirect()->to('/pegawai/peminjaman')->with('error', 'Data peminjaman tidak ditemukan');
        }

        // Ambil file yang diunggah
        $file = $this->request->getFile('bukti_pengembalian');

        if ($file->isValid() && !$file->hasMoved()) {
            // Simpan file ke folder uploads/pengembalian/
            $newName = $file->getRandomName();
            $file->move('uploads/bukti_pengembalian/', $newName);

            // Update data peminjaman
            $this->peminjamanModel->update($id, [
                'bukti_pengembalian' => $newName,
                'tanggal_pengembalian' => date('Y-m-d'), // Isi tanggal pengembalian otomatis
            ]);

            return redirect()->to('/pegawai/peminjaman')->with('success', 'Bukti pengembalian berhasil diunggah, menunggu persetujuan admin.');
        }

        return redirect()->to('/pegawai/peminjaman')->with('error', 'Gagal mengunggah bukti pengembalian.');
    }
}
