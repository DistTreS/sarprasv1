<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\UsersModel;
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

    // Menampilkan daftar pengajuan peminjaman
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
