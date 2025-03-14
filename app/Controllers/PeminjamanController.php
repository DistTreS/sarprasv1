<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\UsersModel;
use App\Models\AsetModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;



class PeminjamanController extends Controller
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    // Menampilkan daftar pengajuan peminjaman Admin
    public function index()
    {   
        $usersModel = new UsersModel();
        $data['peminjaman'] = $this->peminjamanModel
            ->select('peminjaman.*, users.full_name as user_name, aset.id_aset, kategori_aset.nama_kategori as nama_aset')
            ->join('users', 'users.id = peminjaman.id_user')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori') 
            ->orderBy('peminjaman.tanggal_pengajuan', 'DESC')
            ->findAll();
        
        return view('peminjaman/riwayat', $data);
    }

    public function detail($id_peminjaman)
    {
        $data['peminjaman'] = $this->peminjamanModel
            ->select('peminjaman.*, users.full_name as user_name, users.no_telepon, aset.id_aset, kategori_aset.nama_kategori as nama_aset')
            ->join('users', 'users.id = peminjaman.id_user', 'left')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori', 'left')
            ->where('peminjaman.id_peminjaman', $id_peminjaman)
            ->first();

        return view('peminjaman/detailPengajuan', $data);
    }

    // Menampilkan daftar pengajuan peminjaman Pegawai
    public function indexPegawai()
    {   
        $session = session();
        $user_id = $session->get('user_id'); // ID user login
        $role = $session->get('role');

        $peminjaman = $this->peminjamanModel
            ->select('peminjaman.*, users.full_name as user_name, aset.id_aset, kategori_aset.nama_kategori as nama_aset')
            ->join('users', 'users.id = peminjaman.id_user')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori') 
            ->where('peminjaman.id_user', $user_id) // Hanya data milik user login
            ->orderBy('peminjaman.tanggal_pengajuan', 'DESC')
            ->get()
            ->getResultArray(); // Gunakan getResultArray() untuk mengambil data sesuai filter

        $data = [
            'peminjaman' => $peminjaman,
            'role' => $role
        ];

        return view('peminjaman/riwayatPegawai', $data);
    }

    //Form pengajuan peminjaman Pegawai
    public function formPengajuan()
    {
        $session = session();
        $user_id = $session->get('user_id'); // ID user login

        // Ambil daftar aset dengan kategori
        $asetModel = new AsetModel();
        $aset = $asetModel->getAsetWithKategori(); // Menggunakan method baru

        $data = [
            'aset' => $aset,
            'user_id' => $user_id
        ];

        return view('peminjaman/formPengajuan', $data);
    }

    //Simpan Data Pengajuan User
    public function simpanPengajuan()
    {
        $session = session();
        $user_id = $session->get('user_id');


        $data = [
            'id_user' => $user_id,
            'id_aset' => $this->request->getPost('id_aset'),
            'tanggal_pengajuan' => $this->request->getPost('tanggal_pengajuan'),
            'tanggal_rencana_pengembalian' => $this->request->getPost('tanggal_rencana_pengembalian'),
            'cc' => $this->request->getPost('cc'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status_layanan' => 'Pengajuan'
        ];

        $this->peminjamanModel->insert($data);

        return redirect()->to('/pegawai/peminjaman')->with('success', 'Peminjaman berhasil diajukan!');
    }

    public function formPengembalian($id_peminjaman)
    {
        $session = session();
        $user_id = $session->get('user_id'); // 
    
        $peminjaman = $this->peminjamanModel
            ->select('peminjaman.*, users.full_name as user_name, aset.id_aset, kategori_aset.nama_kategori as nama_aset')
            ->join('users', 'users.id = peminjaman.id_user')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori') 
            ->where('peminjaman.id_peminjaman', $id_peminjaman) // Filter berdasarkan ID peminjaman
            ->where('peminjaman.id_user', $user_id) // Pastikan peminjaman milik user login
            ->first(); // Ambil satu baris data
    
        // Jika data tidak ditemukan, redirect dengan pesan error
        if (!$peminjaman) {
            return redirect()->to('/pegawai/peminjaman')->with('error', 'Data peminjaman tidak ditemukan atau Anda tidak berhak mengaksesnya.');
        }
    
        return view('peminjaman/formPengembalian', ['peminjaman' => $peminjaman]);
    }
    

    public function simpanPengembalian()
    {
        $session = session();
        $user_id = $session->get('user_id');

        $id_peminjaman = $this->request->getPost('id_peminjaman');
        $tanggal_pengembalian = date('Y-m-d H:i:s');

        // Cek apakah peminjaman ada dan milik user
        $peminjaman = $this->peminjamanModel->where('id_peminjaman', $id_peminjaman)
            ->where('id_user', $user_id)
            ->first();

        if (!$peminjaman) {
            return redirect()->to('/pegawai/peminjaman')->with('error', 'Data peminjaman tidak ditemukan atau Anda tidak berhak mengakses.');
        }

        // Upload bukti pengembalian
        $file = $this->request->getFile('bukti_pengembalian');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/bukti_pengembalian', $newName);
        } else {
            return redirect()->back()->with('error', 'Gagal mengupload bukti pengembalian.');
        }

        // Update status dan bukti pengembalian
        $this->peminjamanModel->update($id_peminjaman, [
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'bukti_pengembalian' => $newName,
            'status_layanan' => 'Selesai'
        ]);

        return redirect()->to('/pegawai/peminjaman')->with('success', 'Peminjaman berhasil dikembalikan.');
    }

    public function detailPengajuanPegawai($id_peminjaman)
    {
        $session = session();
        $user_id = $session->get('user_id'); // Ambil ID user dari session

        $peminjaman = $this->peminjamanModel
            ->select('peminjaman.*, aset.id_aset, kategori_aset.nama_kategori as nama_aset')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori')
            ->where('peminjaman.id_peminjaman', $id_peminjaman)
            ->where('peminjaman.id_user', $user_id)
            ->first(); // Ambil satu data saja

        // Jika data tidak ditemukan atau bukan milik user
        if (!$peminjaman) {
            return redirect()->to('/pegawai/peminjaman')->with('error', 'Data tidak ditemukan atau Anda tidak berhak mengaksesnya.');
        }

        return view('peminjaman/detailPengajuanPegawai', ['peminjaman' => $peminjaman]);
    }


    //Update Status Admin
    public function update_status($id_peminjaman)
    {
        if ($this->request->getMethod() === 'post') {
            $status_peminjaman = $this->request->getPost('status_peminjaman');

            // Pastikan input valid
            if (!in_array($status_peminjaman, ['Belum Disetujui', 'Disetujui'])) {
                return redirect()->back()->with('error', 'Status peminjaman tidak valid!');
            }

            // Tentukan status layanan berdasarkan status peminjaman
            $status_layanan = 'Pengajuan'; // Default
            if ($status_peminjaman == 'Disetujui') {
                $status_layanan = 'Proses';
            }

            // Update status peminjaman & layanan di database
            $this->peminjamanModel->update($id_peminjaman, [
                'status_peminjaman' => $status_peminjaman,
                'status_layanan' => $status_layanan
            ]);

            return redirect()->to(base_url('peminjaman/detail/' . $id_peminjaman))->with('success', 'Status berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Metode tidak diizinkan.');
    }

    // Fungsi cetak PDF
    public function cetak($id_peminjaman)
        {
            // Perbaikan query: ambil cc dan keterangan dari peminjaman, bukan aset
            $data['peminjaman'] = $this->peminjamanModel
                ->select('peminjaman.*, users.full_name as user_name, users.no_telepon, aset.id_aset, kategori_aset.nama_kategori')
                ->join('users', 'users.id = peminjaman.id_user', 'left')
                ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
                ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori', 'left')
                ->where('peminjaman.id_peminjaman', $id_peminjaman)
                ->first();

            if (!$data['peminjaman']) {
                return redirect()->to('peminjaman')->with('error', 'Data tidak ditemukan');
            }

            // Load view ke dalam HTML
            $html = view('peminjaman/cetakPengajuan', $data);

            // Konfigurasi Dompdf
            $options = new Options();
            $options->set('defaultFont', 'Arial');
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Kirim file ke browser untuk didownload
            $dompdf->stream('peminjaman_' . $id_peminjaman . '.pdf', ['Attachment' => false]);
        }

        public function pengembalian($id_peminjaman)
        {
            $data['peminjaman'] = $this->peminjamanModel
                ->select('peminjaman.*, users.full_name as user_name, aset.id_aset, kategori_aset.nama_kategori as nama_kategori')
                ->join('users', 'users.id = peminjaman.id_user', 'left')
                ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
                ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori', 'left')
                ->where('peminjaman.id_peminjaman', $id_peminjaman)
                ->first();

            if (!$data['peminjaman']) {
                return redirect()->to('peminjaman')->with('error', 'Data peminjaman tidak ditemukan.');
            }

            // Tambahkan variabel isAdmin berdasarkan session atau role user
            $data['isAdmin'] = session()->get('role') === 'admin';

            return view('peminjaman/pengembalian', $data);
        }

        public function pengembalianpegawai($id_peminjaman)
        {
            $session = session();
            $user_id = $session->get('user_id'); // Ambil ID user login

            // Ambil data peminjaman berdasarkan ID, pastikan hanya user yang bersangkutan dapat melihatnya
            $data['peminjaman'] = $this->peminjamanModel
                ->where('id_peminjaman', $id_peminjaman)
                ->where('id_user', $user_id)
                ->first();

            // Jika data tidak ditemukan atau bukan milik user, redirect dengan pesan error
            if (!$data['peminjaman']) {
                return redirect()->to('/pegawai/peminjaman')->with('error', 'Data peminjaman tidak ditemukan atau Anda tidak berhak mengakses.');
            }

            return view('peminjaman/formPengembalian', $data);
        }

        public function uploadPengembalian($id_peminjaman)
        {
            $data['peminjaman'] = $this->peminjamanModel
                ->select('peminjaman.*, users.full_name as user_name, users.id as user_id, aset.id_aset, kategori_aset.nama_kategori')
                ->join('users', 'users.id = peminjaman.id_user', 'left')
                ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
                ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori', 'left')
                ->where('peminjaman.id_peminjaman', $id_peminjaman)
                ->first();

            if (!$data['peminjaman']) {
                return redirect()->to('peminjaman')->with('error', 'Data peminjaman tidak ditemukan.');
            }

            // Cek apakah pengguna adalah admin
            $session = session();
            $data['isAdmin'] = ($session->get('role') == 'admin'); // Sesuaikan dengan sistem autentikasi Anda

            return view('peminjaman/pengembalian', $data);
        }
        

}
