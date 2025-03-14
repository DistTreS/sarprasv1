<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetModel extends Model
{
    protected $table = 'aset';
    protected $primaryKey = 'id_aset';
    protected $allowedFields = ['id_aset','id_kategori', 'status', 'kondisi', 'gambar'];

    public function getAsetWithKategori()
    {
    return $this->select('aset.id_aset, aset.status, aset.kondisi, aset.gambar, kategori_aset.nama_kategori')
                ->join('kategori_aset', 'kategori_aset.id_kategori = aset.id_kategori')
                ->findAll();
    }

}

