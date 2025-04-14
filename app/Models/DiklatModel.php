<?php

namespace App\Models;

use CodeIgniter\Model;

class DiklatModel extends Model
{
    protected $table = 'diklat';
    protected $primaryKey = 'id_diklat';
    protected $allowedFields = [
        'nama_diklat',
        'deskripsi'
    ];

    // Fungsi untuk mendapatkan daftar diklat dengan peserta terdaftar
    public function getDiklatWithPesertaCount()
    {
        $this->select('diklat.*, COUNT(peserta_diklat.id_peserta) AS jumlah_peserta')
            ->join('peserta_diklat', 'diklat.id_diklat = peserta_diklat.id_diklat', 'left')
            ->groupBy('diklat.id_diklat');

        return $this->findAll();
    }

    // Fungsi untuk pencarian diklat berdasarkan nama
    public function searchDiklat($keyword)
    {
        return $this->like('nama_diklat', $keyword)->findAll();
    }
}
