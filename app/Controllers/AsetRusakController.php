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

    public function index()
    {
        $data['asetRusakList'] = $this->asetRusakModel
            ->select('aset_rusak.*, kategori_aset.nama_kategori, users.full_name AS nama_pelapor')
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori')
            ->join('users', 'users.id = aset_rusak.id_user', 'left')
            ->findAll();

        return view('peminjaman/pengajuanAsetRusak', $data);
    }

    public function detail($id_rusak)
    {
        $data['asetRusak'] = $this->asetRusakModel
            ->select('aset_rusak.*, kategori_aset.nama_kategori, users.full_name AS nama_pelapor')
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori')
            ->join('users', 'users.id = aset_rusak.id_user')
            ->where('aset_rusak.id_rusak', $id_rusak)
            ->first();

        if (!$data['asetRusak']) {
            return redirect()->to('/aset-rusak')->with('error', 'Data tidak ditemukan.');
        }

        return view('peminjaman/detailAsetRusak', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'id_aset' => 'required',
            'keterangan' => 'required',
            'status_pengajuan' => 'required|in_list[Rusak Kecil,Rusak Sedang,Rusak Besar]',
            'bukti_foto' => 'uploaded[bukti_foto]|max_size[bukti_foto,2048]|is_image[bukti_foto]|mime_in[bukti_foto,image/jpg,image/jpeg,image/png]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal!');
        }

        $buktiFoto = $this->request->getFile('bukti_foto');
        $namaFoto = $buktiFoto->getRandomName();
        $buktiFoto->move('uploads/aset_rusak', $namaFoto);

        $this->asetRusakModel->insert([
            'id_aset' => $this->request->getPost('id_aset'),
            'id_user' => session()->get('id_user'),
            'tanggal_rusak' => date('Y-m-d'),
            'status_pengajuan' => $this->request->getPost('status_pengajuan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_foto' => $namaFoto
        ]);

        return redirect()->to('/aset-rusak')->with('success', 'Pengajuan aset rusak berhasil!');
    }

    public function cetak($id_rusak)
    {
        $asetRusak = $this->asetRusakModel
            ->select('aset_rusak.*, kategori_aset.nama_kategori, users.full_name AS nama_pelapor')
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori')
            ->join('users', 'users.id = aset_rusak.id_user')
            ->where('aset_rusak.id_rusak', $id_rusak)
            ->first();

        if (!$asetRusak) {
            return redirect()->to('/aset-rusak')->with('error', 'Data aset rusak tidak ditemukan.');
        }

        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        $pdf->SetFont('Helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Laporan Pengajuan Aset Rusak', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica', '', 12);

        $content = "<h2>Detail Aset Rusak</h2>";
        $content .= "<p><strong>Nama Pelapor:</strong> " . $asetRusak['nama_pelapor'] . "</p>";
        $content .= "<p><strong>Nama Aset:</strong> " . $asetRusak['nama_kategori'] . "</p>";
        $content .= "<p><strong>Tanggal Pengajuan:</strong> " . $asetRusak['tanggal_rusak'] . "</p>";
        $content .= "<p><strong>Status Kerusakan:</strong> " . $asetRusak['status_pengajuan'] . "</p>";
        $content .= "<p><strong>Keterangan:</strong> " . $asetRusak['keterangan'] . "</p>";
        
        $pdf->writeHTML($content, true, false, true, false, '');
        
        if ($asetRusak['bukti_foto']) {
            $imagePath = 'uploads/aset_rusak/' . $asetRusak['bukti_foto'];
            if (file_exists($imagePath)) {
                $pdf->Image($imagePath, 15, $pdf->GetY() + 10, 80);
            }
        }

        $this->response->setContentType('application/pdf');
        $pdf->Output('Laporan_Aset_Rusak_' . $id_rusak . '.pdf', 'I');
    }

    // 📌 Fungsi untuk menampilkan Riwayat Pengajuan Aset Rusak
    public function riwayat()
    {
        $id_user = session()->get('user_id');

        // Cek apakah id_user ada di session
        if (!$id_user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data aset rusak berdasarkan id_user
        $data['asetRusakList'] = $this->asetRusakModel
            ->select('aset_rusak.id_rusak, aset_rusak.tanggal_pengajuan, aset_rusak.status_rusak, kategori_aset.nama_kategori')
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset', 'left')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori', 'left')
            ->where('aset_rusak.id_user', $id_user)
            ->orderBy('aset_rusak.tanggal_pengajuan', 'DESC')
            ->findAll();

        return view('peminjaman/asetRusakPegawai', $data);
    }

    // 📌 Fungsi untuk melihat detail pengajuan aset rusak
    public function detailpegawai($id_rusak)
    {
        $id_user = session()->get('user_id');

        // Ambil data aset rusak berdasarkan ID
        $data['asetRusak'] = $this->asetRusakModel
            ->select('aset_rusak.*, kategori_aset.nama_kategori')
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset', 'left')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori', 'left')
            ->where('aset_rusak.id_rusak', $id_rusak)
            ->where('aset_rusak.id_user', $id_user)
            ->first();

        if (!$data['asetRusak']) {
            return redirect()->to('/aset-rusak/pegawai')->with('error', 'Data tidak ditemukan.');
        }

        return view('peminjaman/detailAsetRusakPegawai', $data);
    }

    // 📌 Fungsi untuk menampilkan halaman pengajuan aset rusak
    public function pengajuan()
    {
        $id_user = session()->get('user_id');

        if (!$id_user) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil daftar aset yang bisa diajukan
        $asetList = $this->asetModel
            ->select('aset.id_aset, kategori_aset.nama_kategori')
            ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori', 'left')
            ->findAll();

        return view('peminjaman/pengajuanAsetRusakPegawai', [
            'asetList' => $asetList
        ]);
    }

    // 📌 Fungsi untuk menyimpan pengajuan aset rusak
    public function simpanPengajuan()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_aset' => 'required|integer',
            'tanggal_pengajuan' => 'required|valid_date',
            'status_rusak' => 'required|in_list[rusak kecil,rusak sedang,rusak besar]',
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
        $id_user = session()->get('user_id'); // Pastikan session menggunakan key yang benar

        // Simpan Data ke Database
        $this->asetRusakModel->insert([
            'id_aset' => $this->request->getPost('id_aset'),
            'id_user' => $id_user,
            'tanggal_pengajuan' => $this->request->getPost('tanggal_pengajuan'),
            'status_rusak' => $this->request->getPost('status_rusak'),
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_foto' => $namaFoto,
            'status_pengajuan' => 'Diajukan' // Status awal pengajuan
        ]);

        return redirect()->to(base_url('aset-rusak/riwayat'));
    }

}
