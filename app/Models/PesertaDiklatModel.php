<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaDiklatModel extends Model
{
    protected $table = 'peserta_diklat';

    protected $primaryKey = 'id_peserta';

    protected $allowedFields = [
        'id_peserta',
        'id_diklat',
        'angkatan',
        'tahun',
        'sertifikat',
        'judul_tugas_akhir',
        'tugas_akhir'
    ];

    // Fungsi untuk mendapatkan data peserta berdasarkan berbagai filter
    public function getFilteredPeserta($keyword = null, $jenis_diklat = null, $instansi = null, $angkatan = null, $tahun = null)
    {
        $query = $this->select('
            peserta_diklat.*, 
            peserta.nama, 
            peserta.nip, 
            peserta.instansi, 
            peserta.golruang, 
            CONCAT(peserta.tempat_lahir, ", ", peserta.tanggal_lahir) AS tempat_tgl_lahir,
            peserta.nama_jabatan
        ')
            ->join('peserta', 'peserta.id_peserta = peserta_diklat.id_peserta', 'left');

        // Filter berdasarkan nama atau NIP
        if (!empty($keyword)) {
            $query->groupStart()
                ->like('peserta.nama', $keyword)
                ->orLike('peserta.nip', $keyword)
                ->groupEnd();
        }

        // Filter berdasarkan jenis diklat
        if (!empty($jenis_diklat)) {
            $query->where('peserta_diklat.id_diklat', $jenis_diklat);
        }

        // Filter berdasarkan instansi
        if (!empty($instansi)) {
            $query->where('peserta.instansi', $instansi);
        }

        // Filter berdasarkan angkatan
        if (!empty($angkatan)) {
            $query->where('peserta_diklat.angkatan', $angkatan);
        }

        // Filter berdasarkan tahun
        if (!empty($tahun)) {
            $query->where('peserta_diklat.tahun', $tahun);
        }

        return $query->paginate(25);
    }

    // Fungsi untuk mendapatkan data peserta yang difilter untuk keperluan cetak PDF
    public function getFilteredPesertaForPdf($keyword = null, $jenis_diklat = null, $instansi = null, $angkatan = null, $tahun = null)
    {
        $query = $this->select('
            peserta_diklat.*, 
            CONCAT(peserta.nama, "\n", peserta.nip, "\n", peserta.tempat_lahir, ", ", peserta.tanggal_lahir ) AS nama_dan_nip,
            peserta.instansi, 
            peserta.golruang, 
            peserta.nama_jabatan
        ')
            ->join('peserta', 'peserta.id_peserta = peserta_diklat.id_peserta', 'left');

        // Filter yang sama seperti fungsi sebelumnya
        if (!empty($keyword)) {
            $query->groupStart()
                ->like('peserta.nama', $keyword)
                ->orLike('peserta.nip', $keyword)
                ->groupEnd();
        }

        if (!empty($jenis_diklat)) $query->where('peserta_diklat.id_diklat', $jenis_diklat);
        if (!empty($instansi)) $query->where('peserta.instansi', $instansi);
        if (!empty($angkatan)) $query->where('peserta_diklat.angkatan', $angkatan);
        if (!empty($tahun)) $query->where('peserta_diklat.tahun', $tahun);

        return $query->findAll(); // Mengembalikan semua data untuk PDF
    }

    // Fungsi untuk mendapatkan daftar instansi unik
    public function getInstansiList()
    {
        return $this->select('peserta.instansi')
            ->join('peserta', 'peserta.id_peserta = peserta_diklat.id_peserta')
            ->distinct()
            ->findAll();
    }

    // Fungsi untuk mendapatkan daftar angkatan unik
    public function getAngkatanList()
    {
        return $this->select('angkatan')
            ->distinct()
            ->findAll();
    }

    // Fungsi untuk mendapatkan daftar tahun unik
    public function getTahunList()
    {
        return $this->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'DESC')
            ->findAll();
    }

     // Ambil satu peserta diklat dengan composite key
     public function findComposite($id_peserta, $id_diklat)
     {
         return $this->where('id_peserta', $id_peserta)
                     ->where('id_diklat', $id_diklat)
                     ->first();
     }
 
     // Update data dengan composite key
     public function updateComposite($id_peserta, $id_diklat, $data)
     {
         return $this->where('id_peserta', $id_peserta)
                     ->where('id_diklat', $id_diklat)
                     ->set($data)
                     ->update();
     }
 
     // Delete data dengan composite key
     public function deleteComposite($id_peserta, $id_diklat)
     {
         return $this->where('id_peserta', $id_peserta)
                     ->where('id_diklat', $id_diklat)
                     ->delete();
     }
}
