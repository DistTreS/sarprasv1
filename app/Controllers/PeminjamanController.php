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
        $result = $this->peminjamanModel->getDetailPeminjaman($id_peminjaman);

        if (!$result) {
            return redirect()->to('peminjaman')->with('error', 'Data tidak ditemukan.');
        }

        // Inisialisasi array
        $peminjaman = [
            'id_pengajuan' => $result[0]['id_pengajuan'],
            'full_name' => $result[0]['full_name'],
            'CC' => $result[0]['CC'],
            'keterangan' => $result[0]['keterangan'],
            'tanggal_peminjaman' => $result[0]['tanggal_peminjaman'],
            'tanggal_rencana_pengembalian' => $result[0]['tanggal_rencana_pengembalian'],
            'tanggal_pengembalian' => $result[0]['tanggal_pengembalian'],
            'status_peminjaman' => $result[0]['status_peminjaman'],
            'status_layanan' => $result[0]['status_layanan'],
            'acc_by' => $result[0]['acc_by'],
            'aset' => [] // 🔥 Buat array kosong untuk daftar aset
        ];

        // Loop untuk mengisi daftar aset
        foreach ($result as $row) {
            $peminjaman['aset'][] = [
                'nup' => $row['nup'],
                'nama_aset' => $row['nama_aset']
            ];
        }

        return view('peminjaman/detailPengajuan', ['peminjaman' => $peminjaman]);
    }




    // ADMIN: Mengubah status peminjaman
    public function update_status($id_pengajuan)
    {

        if ($this->request->getMethod() === 'post') {
            $status_peminjaman = $this->request->getPost('status_peminjaman');

            if (!$id_pengajuan) {
                return redirect()->to('peminjaman')->with('error', 'ID pengajuan tidak ditemukan.');
            }

            // Ambil informasi admin yang sedang login
            $admin_name = session()->get('full_name'); // Pastikan session menyimpan nama admin

            if (!$admin_name) {
                return redirect()->to('peminjaman')->with('error', 'Gagal memperbarui status. Admin tidak terdeteksi.');
            }

            // Tentukan status layanan berdasarkan status peminjaman
            if ($status_peminjaman === 'Disetujui') {
                $status_layanan = 'Proses';
            } elseif ($status_peminjaman === 'Ditolak') {
                $status_layanan = 'Selesai';
            } else {
                $status_layanan = 'Pengajuan';
            }

            // Update data di database
            $update = $this->peminjamanModel->where('id_pengajuan', $id_pengajuan)->set([
                'status_peminjaman' => $status_peminjaman,
                'status_layanan' => $status_layanan,
                'acc_by' => $admin_name
            ])->update();


            if (!$update) {
                return redirect()->to('peminjaman')->with('error', 'Gagal memperbarui status peminjaman.');
            }

            return redirect()->to('peminjaman')->with('success', 'Status peminjaman berhasil diperbarui.');
        }

        return redirect()->to('peminjaman')->with('error', 'Metode tidak valid.');
    }




    // ADMIN: Melakuan perubahan pada pengembalian
    public function pengembalianAdmin($id_pengajuan)
    {
        $peminjaman = $this->peminjamanModel
            ->select('peminjaman.*, users.full_name AS nama_pegawai')
            ->join('users', 'users.id = peminjaman.id', 'left')
            ->where('peminjaman.id_pengajuan', $id_pengajuan)
            ->first(); // Ambil data peminjaman (hanya 1 karena informasi umum)

        if (!$peminjaman) {
            return redirect()->to(base_url('peminjaman'))->with('error', 'Data tidak ditemukan');
        }

        // Ambil daftar aset yang terkait dengan pengajuan ini
        $aset_pinjaman = $this->peminjamanModel
            ->select('aset.nama_aset, aset.nup, peminjaman.bukti_pengembalian')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
            ->where('peminjaman.id_pengajuan', $id_pengajuan)
            ->findAll(); // Ambil semua aset yang terkait dengan pengajuan ini

        return view('peminjaman/pengembalianAdmin', [
            'peminjaman' => $peminjaman,
            'aset_pinjaman' => $aset_pinjaman // Kirim daftar aset ke tampilan
        ]);
    }



    // ADMIN: Melakuan persetujuan pada pengembalian
    public function setujui($id_pengajuan)
    {
        $peminjamanModel = new PeminjamanModel();

        // Ambil semua peminjaman terkait pengajuan ini
        $peminjamanList = $peminjamanModel->where('id_pengajuan', $id_pengajuan)->findAll();

        if (empty($peminjamanList)) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Ambil role dari session
        $role = session()->get('role');
        $tanggalHariIni = date('Y-m-d');

        // Cek apakah role adalah admin yang tidak perlu upload bukti
        $adminLangsungSetujui = in_array($role, [
            'Admin Utama',
            'Admin Peminjaman',
            'Admin Peminjaman dan Barang',
            'Admin Peminjaman dan Diklat'
        ]);

        if ($adminLangsungSetujui) {
            // Langsung setujui dan isi tanggal_pengembalian
            $peminjamanModel->where('id_pengajuan', $id_pengajuan)
                ->set([
                    'status_layanan' => 'Selesai',
                    'tanggal_pengembalian' => $tanggalHariIni
                ])->update();

            log_message('info', "Pengembalian aset (oleh admin: $role) untuk ID pengajuan $id_pengajuan telah disetujui tanpa cek bukti.");
            return redirect()->back()->with('success', 'Pengembalian telah disetujui oleh admin.');
        }

        // Kalau bukan admin, periksa apakah semua bukti pengembalian sudah ada
        foreach ($peminjamanList as $peminjaman) {
            if (empty($peminjaman['bukti_pengembalian'])) {
                return redirect()->back()->with('error', 'Bukti pengembalian belum diunggah untuk semua aset.');
            }
        }

        // Setujui dan isi tanggal pengembalian
        $peminjamanModel->where('id_pengajuan', $id_pengajuan)
            ->set([
                'status_layanan' => 'Selesai',
                'tanggal_pengembalian' => $tanggalHariIni
            ])->update();

        log_message('info', "Pengembalian aset dengan ID pengajuan $id_pengajuan telah disetujui (dengan bukti lengkap).");
        return redirect()->back()->with('success', 'Pengembalian telah disetujui.');
    }



    // ADMIN: Melakuan penolakan pada pengembalian
    public function tolak($id_pengajuan)
    {
        $peminjamanModel = new PeminjamanModel();

        // Ambil semua peminjaman terkait pengajuan ini
        $peminjamanList = $peminjamanModel->where('id_pengajuan', $id_pengajuan)->findAll();

        if (empty($peminjamanList)) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // Ambil satu data peminjaman untuk mendapatkan bukti pengembalian (karena hanya ada satu bukti)
        $buktiLama = $peminjamanList[0]['bukti_pengembalian'] ?? null;

        // Hapus file bukti pengembalian jika ada
        if (!empty($buktiLama)) {
            $filePath = WRITEPATH . '../public/uploads/bukti_pengembalian/' . $buktiLama;
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file lama
            }
        }

        // Set status kembali ke "Proses", kosongkan bukti_pengembalian, dan tambahkan pesan penolakan
        $peminjamanModel->where('id_pengajuan', $id_pengajuan)->set([
            'status_layanan' => 'Proses',
            'bukti_pengembalian' => null,
            'pesan_penolakan' => 'Bukti pengembalian ditolak. Silakan unggah ulang dengan bukti yang valid.'
        ])->update();

        log_message('warning', 'Pengembalian aset dalam pengajuan ID ' . $id_pengajuan . ' telah ditolak.');

        return redirect()->back()->with('success', 'Bukti pengembalian berhasil ditolak. Pengguna harus mengunggah ulang.');
    }


    // PEGAWAI: Menampilkan daftar peminjaman
    public function indexPegawai()
    {
        $userId = session()->get('user_id'); // Ambil user_id dari session

        // Mengambil data peminjaman, mengelompokkan berdasarkan id_pengajuan
        $data['peminjaman'] = $this->peminjamanModel
            ->select('peminjaman.id_pengajuan, 
                  GROUP_CONCAT(aset.nama_aset SEPARATOR ", ") as nama_aset, 
                  GROUP_CONCAT(aset.nup SEPARATOR ", ") as nup, 
                  MIN(peminjaman.tanggal_peminjaman) as tanggal_peminjaman,
                  MAX(peminjaman.tanggal_rencana_pengembalian) as tanggal_rencana_pengembalian, 
                  MIN(peminjaman.status_peminjaman) as status_peminjaman,
                  MIN(peminjaman.status_layanan) as status_layanan')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
            ->where('peminjaman.id', $userId)
            ->groupBy('peminjaman.id_pengajuan') // Mengelompokkan berdasarkan id_pengajuan
            ->orderBy('tanggal_peminjaman', 'DESC')
            ->findAll();

        return view('peminjaman/riwayatPegawai', $data);
    }



    // PEGAWAI: Detail Pengajuan Peminjaman
    public function detailPengajuanPegawai($id_pengajuan)
    {
        $userId = session()->get('user_id'); // Ambil ID user dari session

        // Ambil data peminjaman berdasarkan ID pengajuan dan ID user untuk keamanan
        $data['peminjaman'] = $this->peminjamanModel
            ->select('peminjaman.*, aset.nama_aset, aset.nup, users.no_telepon, peminjaman.bukti_pengembalian') // Tambahkan bukti_pengembalian
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
            ->join('users', 'users.id = peminjaman.id', 'left')
            ->where('peminjaman.id_pengajuan', $id_pengajuan)
            ->where('peminjaman.id', $userId)
            ->findAll(); // Ambil semua aset dalam satu pengajuan

        // Jika tidak ditemukan, tampilkan error 404
        if (empty($data['peminjaman'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data peminjaman tidak ditemukan.');
        }

        // Ambil data umum peminjaman (hanya sekali, bukan per aset)
        $data['detail_pengajuan'] = [
            'id_pengajuan' => $id_pengajuan,
            'tanggal_peminjaman' => $data['peminjaman'][0]['tanggal_peminjaman'],
            'tanggal_rencana_pengembalian' => $data['peminjaman'][0]['tanggal_rencana_pengembalian'],
            'status_peminjaman' => $data['peminjaman'][0]['status_peminjaman'],
            'status_layanan' => $data['peminjaman'][0]['status_layanan'],
            'no_telepon' => $data['peminjaman'][0]['no_telepon'],
            'bukti_pengembalian' => $data['peminjaman'][0]['bukti_pengembalian'],
            'acc_by' => $data['peminjaman'][0]['acc_by']
        ];

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

    public function formPengajuanAdmin()
    {
        $data = [
            'title' => "Form Pengajuan Peminjaman",
            'asetList' => $this->asetModel->where('status_aset', 'Tersedia')->findAll() // 🔥 Hanya ambil yang "Tersedia"
        ];

        return view('peminjaman/formPengajuanAdmin', $data);
    }


    // PEGAWAI: Simpan data pengajuan peminjaman
    public function simpanPengajuan()
    {
        $id_user = session()->get('user_id'); // ID user
        $id_pengajuan = uniqid('PNJ-');
        $id_aset_list = $this->request->getPost('id_aset'); // Ambil daftar aset (array)
        $tanggal_rencana_pengembalian = $this->request->getPost('tanggal_rencana_pengembalian');
        $tanggal_peminjaman = $this->request->getPost('tanggal_peminjaman');
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
                    'tanggal_peminjaman' => $tanggal_peminjaman,
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

    public function simpanPengajuanAdmin()
    {
        $id_user = session()->get('user_id'); // ID user
        $id_pengajuan = uniqid('PNJ-');
        $id_aset_list = $this->request->getPost('id_aset'); // Ambil daftar aset (array)
        $tanggal_rencana_pengembalian = $this->request->getPost('tanggal_rencana_pengembalian');
        $tanggal_peminjaman = $this->request->getPost('tanggal_peminjaman');
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
                    'tanggal_peminjaman' => $tanggal_peminjaman,
                    'id_pengajuan' => $id_pengajuan
                ];

                // Simpan ke database
                $this->peminjamanModel->save($data);

                // Update status aset menjadi "Terpakai"
                $this->asetModel->update($id_aset, ['status_aset' => 'Terpakai']);
            }
        }

        return redirect()->to('/peminjaman')->with('success', 'Pengajuan peminjaman berhasil diajukan.');
    }



    // PEGAWAI: Form pengembalian aset
    public function pengembalianpegawai($id_pengajuan)
    {
        $data['peminjaman'] = $this->peminjamanModel->where('id_pengajuan', $id_pengajuan)->first();

        if (!$data['peminjaman']) {
            return redirect()->to('pegawai/peminjaman')->with('error', 'Data tidak ditemukan.');
        }

        return view('peminjaman/formPengembalian', $data);
    }


    public function uploadPengembalian($id_pengajuan)
    {
        // Ambil data peminjaman berdasarkan id_pengajuan
        $peminjaman = $this->peminjamanModel->where('id_pengajuan', $id_pengajuan)->first();

        if (!$peminjaman) {
            return redirect()->to('pegawai/peminjaman')->with('error', 'Data peminjaman tidak ditemukan');
        }

        // Ambil file yang diunggah
        $file = $this->request->getFile('bukti_pengembalian');

        if ($file->isValid() && !$file->hasMoved()) {
            // Simpan file ke folder uploads/pengembalian/
            $newName = $file->getRandomName();
            $file->move('uploads/bukti_pengembalian/', $newName);

            // Update data peminjaman
            $this->peminjamanModel->where('id_pengajuan', $id_pengajuan)->set([
                'bukti_pengembalian' => $newName,
                'tanggal_pengembalian' => date('Y-m-d'), // Isi tanggal pengembalian otomatis
            ])->update();

            return redirect()->to('pegawai/peminjaman')->with('success', 'Bukti pengembalian berhasil diunggah, menunggu persetujuan admin.');
        }

        return redirect()->to('pegawai/peminjaman')->with('error', 'Gagal mengunggah bukti pengembalian.');
    }
}
