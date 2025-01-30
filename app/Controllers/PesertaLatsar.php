<?php

namespace App\Controllers;

use App\Models\PesertaLatsarModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PesertaLatsar extends Controller
{
    protected $pesertaModel;

    public function __construct()
    {
        $this->pesertaModel = new PesertaLatsarModel();
    }

    // Menampilkan semua peserta
    public function index()
    {
        $data['peserta'] = $this->pesertaModel->findAll();
        return view('latsar/index', $data);
    }

    // Form Tambah Data
    public function create()
    {
        return view('latsar/create');
    }

    // Simpan Data Baru
    public function store()
    {
        $model = new PesertaLatsarModel();
        $file = $this->request->getFile('sertifikat');

        // Cek apakah ada file sertifikat yang diupload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('public/uploads/sertifikat/', $newName);
        } else {
            $newName = null;
        }

        // Simpan ke database
        $data = [
            'Nama'             => $this->request->getPost('nama'),
            'Nip'              => $this->request->getPost('nip'),
            'Tempat_Tgl_Lahir' => $this->request->getPost('tempat_tgl_lahir'),
            'Golruang'         => $this->request->getPost('golruang'),
            'nama_jabatan'     => $this->request->getPost('nama_jabatan'),
            'instansi'         => $this->request->getPost('instansi'),
            'angkatan'         => $this->request->getPost('angkatan'),
            'tahun'            => $this->request->getPost('tahun'),
            'sertifikat'       => $newName
        ];

        $model->insert($data);

        return redirect()->to('/latsar/index');
    }

    // Tampilkan Detail Peserta
    public function view($id)
    {
        $data['peserta'] = $this->pesertaModel->find($id);
        return view('latsar/view', $data);
    }

    // Form Edit Data
    public function edit($id)
    {
        $data['peserta'] = $this->pesertaModel->find($id);
        return view('latsar/edit', $data);
    }

    // Update Data
    public function update($id)
    {
        $this->pesertaModel->update($id, $this->request->getPost());
        return redirect()->to('/pesertaLatsar');
    }

    // Hapus Data
    public function delete($id)
    {
        $this->pesertaModel->delete($id);
        return redirect()->to('/pesertaLatsar');
    }
    public function importExcel()
    {
        $file = $this->request->getFile('file_excel');

        // Validasi file
        $validationRule = array(
            'file_excel' => array(
                'label' => 'File Excel',
                'rules' => 'uploaded[file_excel]|mime_in[file_excel,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]'
            )
        );

        if (!$this->validate($validationRule)) {
            return redirect()->to('/pesertaLatsar')->with('error', 'File harus berupa Excel (.xls atau .xlsx)');
        }

        if ($file->isValid() && !$file->hasMoved()) {
            // Pindahkan file
            $newFileName = $file->getRandomName();
            $filePath = WRITEPATH . 'uploads/' . $newFileName;
            
            if ($file->move(WRITEPATH . 'uploads', $newFileName)) {
                // Baca file Excel
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();

                $successCount = 0;
                $errorCount = 0;

                foreach ($sheetData as $index => $row) {
                    if ($index == 0) continue; // Lewati baris header

                    // Validasi data
                    if (empty($row[0]) || empty($row[1])) {
                        $errorCount++;
                        continue;
                    }

                    $data = array(
                        'Nama'             => trim($row[0]),
                        'Nip'              => trim($row[1]),
                        'Tempat_Tgl_Lahir' => trim($row[2]),
                        'Golruang'         => trim($row[3]),
                        'nama_jabatan'     => trim($row[4]),
                        'instansi'         => trim($row[5]),
                        'angkatan'         => trim($row[6]),
                        'tahun'            => trim($row[7]),
                        'sertifikat'       => !empty($row[8]) ? trim($row[8]) : null
                    );

                    if ($this->pesertaModel->insert($data)) {
                        $successCount++;
                    } else {
                        $errorCount++;
                        log_message('error', 'Gagal menyimpan data: ' . json_encode($data));
                    }
                }

                // Hapus file temporary
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $message = "Berhasil mengimpor $successCount data.";
                if ($errorCount > 0) {
                    $message .= " Gagal mengimpor $errorCount data.";
                }
                return redirect()->to('/pesertaLatsar')->with('success', $message);
            }
        }

        return redirect()->to('/pesertaLatsar')->with('error', 'Gagal mengimpor data.');
    }
}
