<?php

namespace App\Controllers;

use App\Models\PesertaDiklatModel;
use App\Models\PesertaModel;
use App\Models\DiklatModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Dompdf\Dompdf;
use Dompdf\Options;

class DiklatController extends Controller
{
    protected $pesertaDiklatModel;
    protected $pesertaModel;
    protected $DiklatModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->pesertaDiklatModel = new PesertaDiklatModel();
        $this->pesertaModel = new PesertaModel();
        $this->DiklatModel = new DiklatModel();
    }

    // =================== 1. TAMPILKAN PESERTA DIKLAT ===================
    public function index()
    {
        // Ambil semua parameter dari request
        $keyword       = esc($this->request->getGet('keyword'));
        $filterDiklat  = esc($this->request->getGet('jenis_diklat'));
        $instansi      = esc($this->request->getGet('instansi'));
        $angkatan      = esc($this->request->getGet('angkatan'));
        $tahun         = esc($this->request->getGet('tahun'));

        // Query berdasarkan filter dan pencarian
        $peserta_diklat = $this->pesertaDiklatModel
            ->getFilteredPeserta($keyword, $filterDiklat, $instansi, $angkatan, $tahun);

        $data = [
            'title'         => 'Daftar Peserta Diklat',
            'peserta_diklat' => $peserta_diklat,
            'pager'         => $this->pesertaDiklatModel->pager,
            'jenisDiklat'   => $this->DiklatModel->findAll(),
            'instansi_list' => $this->pesertaDiklatModel->getInstansiList(),
            'angkatan_list' => $this->pesertaDiklatModel->getAngkatanList(),
            'tahun_list'    => $this->pesertaDiklatModel->getTahunList(),

            // Mengirimkan data pencarian & filter agar tetap terisi di form
            'keyword'       => $keyword,
            'filterDiklat'  => $filterDiklat,
            'instansi'      => $instansi,
            'angkatan'      => $angkatan,
            'tahun'         => $tahun
        ];

        return view('diklat/index', $data);
    }

    public function indexguest()
    {
        // Ambil semua parameter dari request
        $keyword       = esc($this->request->getGet('keyword'));
        $filterDiklat  = esc($this->request->getGet('jenis_diklat'));
        $instansi      = esc($this->request->getGet('instansi'));
        $angkatan      = esc($this->request->getGet('angkatan'));
        $tahun         = esc($this->request->getGet('tahun'));

        // Query berdasarkan filter dan pencarian
        $peserta_diklat = $this->pesertaDiklatModel
            ->getFilteredPeserta($keyword, $filterDiklat, $instansi, $angkatan, $tahun);

        $data = [
            'title'         => 'Daftar Peserta Diklat',
            'peserta_diklat' => $peserta_diklat,
            'pager'         => $this->pesertaDiklatModel->pager,
            'jenisDiklat'   => $this->DiklatModel->findAll(),
            'instansi_list' => $this->pesertaDiklatModel->getInstansiList(),
            'angkatan_list' => $this->pesertaDiklatModel->getAngkatanList(),
            'tahun_list'    => $this->pesertaDiklatModel->getTahunList(),

            // Mengirimkan data pencarian & filter agar tetap terisi di form
            'keyword'       => $keyword,
            'filterDiklat'  => $filterDiklat,
            'instansi'      => $instansi,
            'angkatan'      => $angkatan,
            'tahun'         => $tahun
        ];

        return view('diklat/indexguest', $data);
    }



    // =================== 2. TAMPILKAN DETAIL PESERTA ===================
    public function viewPeserta($id_peserta, $id_diklat)
    {
        $pesertaModel = new PesertaModel();
        $pesertaDiklatModel = new PesertaDiklatModel();

        // Ambil data peserta berdasarkan ID peserta
        $peserta = $pesertaModel->find($id_peserta);

        // Ambil data peserta_diklat berdasarkan ID peserta dan ID diklat
        $pesertaDiklat = $pesertaDiklatModel->where('id_peserta', $id_peserta)
            ->where('id_diklat', $id_diklat)
            ->first();

        // Jika tidak ditemukan, kembali ke halaman daftar peserta dengan pesan error
        if (!$peserta || !$pesertaDiklat) {
            return redirect()->to('/diklat')->with('error', 'Peserta tidak ditemukan.');
        }

        // Kirim data ke view
        return view('diklat/viewPeserta', [
            'peserta' => $peserta,
            'peserta_diklat' => $pesertaDiklat
        ]);
    }

    public function viewPesertaGuest($id_peserta, $id_diklat)
    {
        $pesertaModel = new PesertaModel();
        $pesertaDiklatModel = new PesertaDiklatModel();

        // Ambil data peserta berdasarkan ID peserta
        $peserta = $pesertaModel->find($id_peserta);

        // Ambil data peserta_diklat berdasarkan ID peserta dan ID diklat
        $pesertaDiklat = $pesertaDiklatModel->where('id_peserta', $id_peserta)
            ->where('id_diklat', $id_diklat)
            ->first();

        // Jika tidak ditemukan, kembali ke halaman daftar peserta dengan pesan error
        if (!$peserta || !$pesertaDiklat) {
            return redirect()->to('/diklat')->with('error', 'Peserta tidak ditemukan.');
        }

        // Kirim data ke view
        return view('diklat/viewPesertaGuest', [
            'peserta' => $peserta,
            'peserta_diklat' => $pesertaDiklat
        ]);
    }


    // =================== 3. EDIT PESERTA ===================
    public function editPeserta($id_peserta, $id_diklat)
    {
        $pesertaModel = new PesertaModel();
        $pesertaDiklatModel = new PesertaDiklatModel();

        // Ambil data peserta berdasarkan kedua ID
        $peserta = $pesertaModel
            ->select('peserta.*, peserta_diklat.angkatan, peserta_diklat.tahun, peserta_diklat.sertifikat, peserta_diklat.judul_tugas_akhir, peserta_diklat.tugas_akhir')
            ->join('peserta_diklat', 'peserta.id_peserta = peserta_diklat.id_peserta', 'left')
            ->where('peserta.id_peserta', $id_peserta)
            ->where('peserta_diklat.id_diklat', $id_diklat)
            ->first();

        // Jika data tidak ditemukan
        if (!$peserta) {
            return redirect()->to(base_url('diklat'))->with('error', 'Data peserta tidak ditemukan.');
        }

        return view('diklat/editPeserta', ['peserta' => $peserta, 'id_diklat' => $id_diklat]);
    }



    public function updatePeserta($id_peserta, $id_diklat)
    {
        $pesertaModel = new PesertaModel();
        $pesertaDiklatModel = new PesertaDiklatModel();

        // Ambil input dari form
        $dataPeserta = [
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'golruang' => $this->request->getPost('golruang'),
            'nama_jabatan' => $this->request->getPost('nama_jabatan'),
            'instansi' => $this->request->getPost('instansi')
        ];

        $dataDiklat = [
            'angkatan' => $this->request->getPost('angkatan'),
            'tahun' => $this->request->getPost('tahun'),
            'judul_tugas_akhir' => $this->request->getPost('judul_tugas_akhir')
        ];

        // Cek jika ada file sertifikat yang diupload
        $fileSertifikat = $this->request->getFile('sertifikat');
        if ($fileSertifikat && $fileSertifikat->isValid()) {
            $newName = $fileSertifikat->getRandomName();
            $fileSertifikat->move('uploads/sertifikat', $newName);
            $dataDiklat['sertifikat'] = $newName;
        }

        // Cek jika ada file tugas akhir yang diupload
        $fileTugasAkhir = $this->request->getFile('tugas_akhir');
        if ($fileTugasAkhir && $fileTugasAkhir->isValid()) {
            $newName = $fileTugasAkhir->getRandomName();
            $fileTugasAkhir->move('uploads/tugas_akhir', $newName);
            $dataDiklat['tugas_akhir'] = $newName;
        }

        // Update data peserta
        $pesertaModel->update($id_peserta, $dataPeserta);

        // Update data peserta_diklat menggunakan composite key
        $pesertaDiklatModel->updateComposite($id_peserta, $id_diklat, $dataDiklat);

        // Redirect ke halaman diklat dengan pesan sukses
        return redirect()->to(base_url('diklat'))->with('success', 'Data peserta berhasil diperbarui.');
    }




    // =================== 4. TAMBAH PESERTA MANUAL ===================
    public function tambahPeserta()
    {
        $pesertaModel = new PesertaModel();
        $pesertaDiklatModel = new PesertaDiklatModel();
        $diklatModel = new DiklatModel();

        if ($this->request->getMethod() === 'get') {
            $data['diklat'] = $diklatModel->findAll(); // Ambil semua jenis diklat
            return view('diklat/tambahPeserta', $data);
        }

        // Ambil data dari form input
        $nama           = $this->request->getPost('nama');
        $nip            = $this->request->getPost('nip');
        $tempat_lahir   = $this->request->getPost('tempat_lahir');
        $tanggal_lahir  = $this->request->getPost('tanggal_lahir');
        $golruang       = $this->request->getPost('golruang');
        $nama_jabatan   = $this->request->getPost('nama_jabatan');
        $instansi       = $this->request->getPost('instansi');
        $id_diklat      = $this->request->getPost('id_diklat');
        $angkatan       = $this->request->getPost('angkatan');
        $tahun          = $this->request->getPost('tahun');
        $judul_tugas_akhir = $this->request->getPost('judul_tugas_akhir');

        // Handle file upload: sertifikat
        $sertifikatFile = $this->request->getFile('sertifikat');
        $sertifikatName = null;

        if ($sertifikatFile && $sertifikatFile->isValid() && !$sertifikatFile->hasMoved()) {
            if ($sertifikatFile->getClientMimeType() !== 'application/pdf') {
                return redirect()->back()->with('error', 'Sertifikat harus dalam format PDF.');
            }
            $sertifikatName = time() . '_' . $sertifikatFile->getRandomName();
            $sertifikatFile->move('uploads/sertifikat/', $sertifikatName);
        }

        // Handle file upload: tugas akhir
        $tugasAkhirFile = $this->request->getFile('tugas_akhir');
        $tugasAkhirName = null;

        if ($tugasAkhirFile && $tugasAkhirFile->isValid() && !$tugasAkhirFile->hasMoved()) {
            if ($tugasAkhirFile->getClientMimeType() !== 'application/pdf') {
                return redirect()->back()->with('error', 'Tugas Akhir harus dalam format PDF.');
            }
            $tugasAkhirName = time() . '_' . $tugasAkhirFile->getRandomName();
            $tugasAkhirFile->move('uploads/tugas_akhir/', $tugasAkhirName);
        }

        // Cek apakah peserta sudah ada berdasarkan NIP
        $existingPeserta = $pesertaModel->where('nip', $nip)->first();
        if ($existingPeserta) {
            $id_peserta = $existingPeserta['id_peserta'];
        } else {
            // Tambahkan peserta baru ke tabel `peserta`
            $dataPeserta = [
                'nama'          => $nama,
                'nip'           => $nip,
                'tempat_lahir'  => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'golruang'      => $golruang,
                'nama_jabatan'  => $nama_jabatan,
                'instansi'      => $instansi
            ];
            $id_peserta = $pesertaModel->insert($dataPeserta, true);
        }

        // **Pengecekan duplikasi peserta pada diklat yang sama**
        $existingPesertaDiklat = $pesertaDiklatModel
            ->where('id_peserta', $id_peserta)
            ->where('id_diklat', $id_diklat)
            ->first();

        if ($existingPesertaDiklat) {
            return redirect()->back()->with('error', 'Peserta sudah terdaftar pada diklat yang sama.');
        }

        // Tambahkan ke tabel `peserta_diklat`
        $dataPesertaDiklat = [
            'id_peserta'        => $id_peserta,
            'id_diklat'         => $id_diklat,
            'angkatan'          => $angkatan,
            'tahun'             => $tahun,
            'sertifikat'        => $sertifikatName,
            'judul_tugas_akhir' => $judul_tugas_akhir,
            'tugas_akhir'       => $tugasAkhirName
        ];
        $pesertaDiklatModel->insert($dataPesertaDiklat);

        return redirect()->to('/diklat')->with('success', 'Peserta berhasil ditambahkan.');
    }





    // =================== 5. IMPORT PESERTA DARI EXCEL ===================
    public function importPeserta()
    {
        $file = $this->request->getFile('file_excel');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid.');
        }

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getTempName());
        $data = $spreadsheet->getActiveSheet()->toArray();

        $id_diklat = $this->request->getPost('id_diklat'); // Jenis diklat dari form

        foreach ($data as $index => $row) {
            if ($index === 0) continue; // Lewatkan baris header (jika ada)

            $nip = $row[1]; // Kolom NIP di Excel

            // Cek apakah peserta sudah ada di tabel `peserta`
            $peserta = $this->pesertaModel->where('nip', $nip)->first();

            if (!$peserta) {
                // Tambahkan peserta baru ke tabel `peserta`
                $this->pesertaModel->save([
                    'nama'          => $row[0],
                    'nip'           => $nip,
                    'tempat_lahir'  => $row[2],
                    'tanggal_lahir' => $row[3],
                    'golruang'      => $row[4],
                    'nama_jabatan'  => $row[5],
                    'instansi'      => $row[6]
                ]);

                // Ambil kembali data peserta yang baru ditambahkan
                $peserta = $this->pesertaModel->where('nip', $nip)->first();
            }

            // Cek apakah peserta sudah terdaftar pada jenis diklat yang sama
            $existingPesertaDiklat = $this->pesertaDiklatModel
                ->where('id_peserta', $peserta['id_peserta'])
                ->where('id_diklat', $id_diklat)
                ->first();

            if ($existingPesertaDiklat) {
                // Lewatkan peserta yang sudah terdaftar pada jenis diklat yang sama
                continue;
            }

            // Simpan data ke tabel `peserta_diklat`
            $this->pesertaDiklatModel->save([
                'id_peserta'        => $peserta['id_peserta'],
                'id_diklat'         => $id_diklat,
                'angkatan'          => $row[7],
                'tahun'             => $row[8],
                'judul_tugas_akhir' => $row[9],
                'sertifikat'        => $row[10] ?? null, // Sertifikat opsional
                'tugas_akhir'        => $row[11] ?? null
            ]);
        }

        return redirect()->to('/diklat')->with('success', 'Data peserta berhasil diimpor.');
    }


    // =================== 6. HAPUS PESERTA ===================
    public function hapusPeserta($id_peserta, $id_diklat)
    {
        // Hapus data peserta_diklat berdasarkan composite key
        $this->pesertaDiklatModel->deleteComposite($id_peserta, $id_diklat);

        return redirect()->to('/diklat')->with('success', 'Peserta berhasil dihapus');
    }


    // Tampilkan daftar jenis diklat
    public function jenisDiklat()
    {
        $DiklatModel = new DiklatModel();
        $data['jenis_diklat'] = $DiklatModel->findAll();
        return view('diklat/indexJenisDiklat', $data);
    }

    // Form tambah jenis diklat
    public function tambahJenisDiklat()
    {
        $data = [
            'title' => 'Tambah Jenis Diklat',
        ];
        return view('diklat/tambahJenisDiklat', $data);
    }

    // Simpan jenis diklat baru ke database
    public function simpanJenisDiklat()
    {
        $this->DiklatModel->insert([
            'nama_diklat' => $this->request->getPost('nama_diklat'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to(base_url('diklat/jenisDiklat'))->with('success', 'Jenis Diklat berhasil ditambahkan');
    }

    // Form edit jenis diklat
    public function editJenisDiklat($id_diklat)
    {
        $jenis_diklat = $this->DiklatModel->find($id_diklat);
        if (!$jenis_diklat) {
            return redirect()->to(base_url('diklat/jenisDiklat'))->with('error', 'Jenis Diklat tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Jenis Diklat',
            'jenis_diklat' => $jenis_diklat,
        ];
        return view('diklat/editJenisDiklat', $data);
    }

    // Update data jenis diklat
    public function updateJenisDiklat($id_diklat)
    {
        $this->DiklatModel->update($id_diklat, [
            'nama_diklat' => $this->request->getPost('nama_diklat'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
        ]);

        return redirect()->to(base_url('diklat/jenisDiklat'))->with('success', 'Jenis Diklat berhasil diperbarui');
    }

    // Hapus jenis diklat
    public function hapusJenisDiklat($id_diklat)
    {
        $this->DiklatModel->delete($id_diklat);
        return redirect()->to(base_url('diklat/jenisDiklat'))->with('success', 'Jenis Diklat berhasil dihapus');
    }


    public function importExcel()
    {
        $file = $this->request->getFile('file_excel');
        $id_diklat = $this->request->getPost('id_diklat');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid.');
        }

        // Load file Excel
        $spreadsheet = IOFactory::load($file->getTempName());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $pesertaModel = new PesertaModel();
        $pesertaDiklatModel = new PesertaDiklatModel();

        // Lewati baris pertama (header)
        for ($i = 1; $i < count($rows); $i++) {
            $data = $rows[$i];

            // Sesuaikan indeks dengan format Excel
            $nama            = $data[0];
            $nip             = $data[1];
            $golruang        = $data[2];
            $tempat_lahir    = $data[3];
            $tanggal_lahir   = $data[4];
            $nama_jabatan    = $data[5];
            $instansi        = $data[6];
            $angkatan        = $data[7];
            $tahun           = $data[8];
            $sertifikat      = $data[9];
            $judul_tugas_akhir = $data[10];

            // Perbaiki format tanggal lahir sebelum menyimpannya
            if (strpos($tanggal_lahir, '/') !== false) {
                $dateParts = explode('/', $tanggal_lahir); // Pecah berdasarkan '/'
                if (count($dateParts) === 3) {
                    $tanggal_lahir = "{$dateParts[2]}-{$dateParts[1]}-{$dateParts[0]}"; // Ubah ke format YYYY-MM-DD
                }
            } elseif (is_numeric($tanggal_lahir)) {
                $tanggal_lahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tanggal_lahir)->format('Y-m-d');
            }

            // Cek apakah peserta sudah ada berdasarkan NIP
            $peserta = $pesertaModel->where('nip', $nip)->first();

            if (!$peserta) {
                // Jika belum ada, tambahkan ke tabel peserta
                $id_peserta = $pesertaModel->insert([
                    'nama'          => $nama,
                    'nip'           => $nip,
                    'tempat_lahir'  => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'golruang'      => $golruang,
                    'nama_jabatan'  => $nama_jabatan,
                    'instansi'      => $instansi
                ], true);
            } else {
                $id_peserta = $peserta['id_peserta'];
            }

            // Tambahkan ke tabel peserta_diklat
            $pesertaDiklatModel->insert([
                'id_peserta'   => $id_peserta,
                'id_diklat'    => $id_diklat,
                'angkatan'     => $angkatan,
                'tahun'        => $tahun,
                'sertifikat'   => $sertifikat,
                'judul_tugas_akhir' => $judul_tugas_akhir
            ]);
        }

        return redirect()->to('/diklat')->with('success', 'Data berhasil diimport.');
    }


    public function exportToPdf()
    {
        // Ambil filter dari request
        $keyword       = $this->request->getGet('keyword');
        $jenis_diklat  = $this->request->getGet('jenis_diklat');
        $instansi      = $this->request->getGet('instansi');
        $angkatan      = $this->request->getGet('angkatan');
        $tahun         = $this->request->getGet('tahun');

        // Ambil data berdasarkan filter
        $peserta_diklat = $this->pesertaDiklatModel
            ->getFilteredPesertaforpdf($keyword, $jenis_diklat, $instansi, $angkatan, $tahun);

        // **Tambahkan Base64 Encoding untuk Gambar:**
        $imagePath = FCPATH . 'images/logoppsdm.png'; // Pastikan path benar
        $imageData = base64_encode(file_get_contents($imagePath)); // Encode gambar ke Base64
        $imageBase64 = 'data:image/png;base64,' . $imageData; // Format Base64

        // Siapkan data untuk ditampilkan di PDF
        $data = [
            'peserta_diklat' => $peserta_diklat,
            'imageBase64'    => $imageBase64, // Kirim gambar ke view
        ];

        // Load view PDF
        $html = view('diklat/exportPDF', $data);

        // Konfigurasi dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isRemoteEnabled', true); // Pastikan remote enabled
        $dompdf = new Dompdf($options);

        // Load HTML ke dompdf
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF
        $dompdf->stream('Data_Peserta_Diklat.pdf', ['Attachment' => true]);
    }

    public function lihatTugasAkhir($id_peserta, $id_diklat)
    {
        $pesertaModel = new PesertaModel();
        $pesertaDiklatModel = new PesertaDiklatModel();

        // Ambil data peserta
        $peserta = $pesertaModel->find($id_peserta);

        // Ambil data peserta diklat berdasarkan ID peserta dan ID diklat
        $pesertaDiklat = $pesertaDiklatModel->where('id_peserta', $id_peserta)
            ->where('id_diklat', $id_diklat)
            ->first();

        // Validasi jika data tidak ditemukan
        if (!$peserta || !$pesertaDiklat || empty($pesertaDiklat['tugas_akhir'])) {
            return redirect()->to('/diklat')->with('error', 'File Tugas Akhir tidak ditemukan.');
        }

        // Kirim data ke view untuk ditampilkan
        return view('diklat/lihat_tugas_akhir', [
            'peserta' => $peserta,
            'peserta_diklat' => $pesertaDiklat
        ]);
    }
}
