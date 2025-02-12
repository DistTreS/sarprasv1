<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaDiklatModel extends Model
{
    protected $table = 'peserta_diklat';
    protected $primaryKey = 'id_peserta_diklat';
    protected $allowedFields = [
        'id_peserta',
        'id_diklat',
        'angkatan',
        'tahun',
        'sertifikat',
        'judul_tugas_akhir'
    ];

    public function getFilteredPeserta($keyword = null, $jenis_diklat = null, $instansi = null, $angkatan = null, $tahun = null)
    {
        $query = $this->select('
        peserta_diklat.*, 
        peserta.nama, 
        peserta.nip, 
        peserta.instansi, 
        peserta.golruang, 
        CONCAT(peserta.tempat_lahir, ", ", peserta.tanggal_lahir) AS tempat_tgl_lahir,
        peserta.nama_jabatan, 
        peserta_diklat.angkatan, 
        peserta_diklat.tahun, 
        peserta_diklat.judul_tugas_akhir
    ')
            ->join('peserta', 'peserta.id_peserta = peserta_diklat.id_peserta', 'left');

        // Pencarian berdasarkan nama atau NIP
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

    public function getFilteredPesertaforpdf($keyword = null, $jenis_diklat = null, $instansi = null, $angkatan = null, $tahun = null)
    {
        $query = $this->select('
        peserta_diklat.*, 
        peserta.nama, 
        peserta.nip, 
        peserta.instansi, 
        peserta.golruang, 
        CONCAT(peserta.tempat_lahir, ", ", peserta.tanggal_lahir) AS tempat_tgl_lahir,
        peserta.nama_jabatan, 
        peserta_diklat.angkatan, 
        peserta_diklat.tahun, 
        peserta_diklat.judul_tugas_akhir
    ')
            ->join('peserta', 'peserta.id_peserta = peserta_diklat.id_peserta', 'left');

        // Filter yang ada sebelumnya
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

        return $query->findAll(); // Menampilkan semua data
    }




    public function getInstansiList()
    {
        return $this->select('peserta.instansi')
            ->join('peserta', 'peserta.id_peserta = peserta_diklat.id_peserta')
            ->distinct()
            ->findAll();
    }

    public function getAngkatanList()
    {
        return $this->select('angkatan')
            ->distinct()
            ->findAll();
    }

    public function getTahunList()
    {
        return $this->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'DESC')
            ->findAll();
    }
}
