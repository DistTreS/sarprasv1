<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetModel extends Model
{
    protected $table = 'aset';
    protected $primaryKey = 'id_aset';
    protected $allowedFields = ['kode_kategori', 'nama_aset', 'nup', 'kondisi', 'status_aset', 'gambar'];

    public function getAsetWithKategori()
    {
        return $this->select('aset.*, kategori_aset.nama_kategori')
                    ->join('kategori_aset', 'kategori_aset.kode_kategori = aset.kode_kategori', 'left')
                    ->findAll();
    }
    
}

