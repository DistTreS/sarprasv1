<?php

namespace App\Controllers;

use App\Models\PesertaDiklatModel;
use App\Models\PesertaModel;
use App\Models\JenisDiklatModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DiklatController extends Controller
{
    protected $pesertaDiklatModel;
    protected $pesertaModel;
    protected $jenisDiklatModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->pesertaDiklatModel = new PesertaDiklatModel();
        $this->pesertaModel = new PesertaModel();
        $this->jenisDiklatModel = new JenisDiklatModel();
    }

    // =================== 1. TAMPILKAN PESERTA DIKLAT ===================
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        $filterDiklat = $this->request->getGet('jenis_diklat');

        $peserta_diklat = $this->pesertaDiklatModel
        ->getFilteredPeserta($keyword, $filterDiklat);

        $data = [
            'title' => 'Daftar Peserta Diklat',
            'peserta_diklat' => $peserta_diklat,
            'pager' => $this->pesertaDiklatModel->pager,
            'jenisDiklat' => $this->jenisDiklatModel->findAll(),
            'instansi_list' => $this->pesertaDiklatModel->getInstansiList(),
            'angkatan_list' => $this->pesertaDiklatModel->getAngkatanList(),
            'tahun_list' => $this->pesertaDiklatModel->getTahunList()
        ];

        return view('diklat/index', $data);
    }


    // =================== 2. TAMPILKAN DETAIL PESERTA ===================
    public function viewPeserta($id)
    {
        $peserta = $this->pesertaDiklatModel->find($id);
        if (!$peserta) {
            return redirect()->to('/diklat')->with('error', 'Peserta tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Peserta Diklat',
            'peserta' => $peserta
        ];

        return view('diklat/viewPeserta', $data);
    }

    // =================== 3. EDIT PESERTA ===================
    public function editPeserta($id)
    {
        $peserta = $this->pesertaDiklatModel->find($id);
        if (!$peserta) {
            return redirect()->to('/diklat')->with('error', 'Peserta tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Peserta Diklat',
            'peserta' => $peserta,
            'jenisDiklat' => $this->jenisDiklatModel->findAll()
        ];

        return view('diklat/editPeserta', $data);
    }

    public function updatePeserta($id)
    {
        $this->pesertaDiklatModel->update($id, $this->request->getPost());
        return redirect()->to('/diklat')->with('success', 'Data berhasil diperbarui');
    }

    // =================== 4. TAMBAH PESERTA MANUAL ===================
    public function tambahPeserta()
    {
        $data = [
            'title' => 'Tambah Peserta Diklat',
            'jenisDiklat' => $this->jenisDiklatModel->findAll()
        ];

        return view('diklat/tambahPeserta', $data);
    }

    public function simpanPeserta()
    {
        $nip = $this->request->getPost('nip');

        // Cek apakah peserta sudah ada
        $peserta = $this->pesertaModel->where('nip', $nip)->first();

        if (!$peserta) {
            $this->pesertaModel->save([
                'nama' => $this->request->getPost('nama'),
                'nip' => $nip,
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'golruang' => $this->request->getPost('golruang'),
                'nama_jabatan' => $this->request->getPost('nama_jabatan'),
                'instansi' => $this->request->getPost('instansi')
            ]);

            $peserta = $this->pesertaModel->where('nip', $nip)->first();
        }

        // Simpan ke peserta_diklat
        $this->pesertaDiklatModel->save([
            'id_peserta' => $peserta['id_peserta'],
            'id_jenis_diklat' => $this->request->getPost('id_jenis_diklat'),
            'angkatan' => $this->request->getPost('angkatan'),
            'tahun' => $this->request->getPost('tahun'),
            'judul_tugas_akhir' => $this->request->getPost('judul_tugas_akhir'),
            'sertifikat' => $this->request->getPost('sertifikat')
        ]);

        return redirect()->to('/diklat')->with('success', 'Peserta berhasil ditambahkan');
    }

    // =================== 5. IMPORT PESERTA DARI EXCEL ===================
    public function importPeserta()
    {
        $file = $this->request->getFile('file_excel');
        $spreadsheet = IOFactory::load($file->getTempName());
        $data = $spreadsheet->getActiveSheet()->toArray();

        foreach ($data as $row) {
            $nip = $row[1]; // Kolom NIP di Excel

            // Cek apakah peserta sudah ada
            $peserta = $this->pesertaModel->where('nip', $nip)->first();

            if (!$peserta) {
                $this->pesertaModel->save([
                    'nama' => $row[0],
                    'nip' => $nip,
                    'tempat_lahir' => $row[2],
                    'tanggal_lahir' => $row[3],
                    'golruang' => $row[4],
                    'nama_jabatan' => $row[5],
                    'instansi' => $row[6]
                ]);

                $peserta = $this->pesertaModel->where('nip', $nip)->first();
            }

            $this->pesertaDiklatModel->save([
                'id_peserta' => $peserta['id_peserta'],
                'id_jenis_diklat' => $this->request->getPost('id_jenis_diklat'),
                'angkatan' => $row[7],
                'tahun' => $row[8],
                'judul_tugas_akhir' => $row[9],
                'sertifikat' => $row[10]
            ]);
        }

        return redirect()->to('/diklat')->with('success', 'Data peserta berhasil diimpor');
    }

    // =================== 6. HAPUS PESERTA ===================
    public function hapusPeserta($id)
    {
        $this->pesertaDiklatModel->delete($id);
        return redirect()->to('/diklat')->with('success', 'Peserta berhasil dihapus');
    }
}
