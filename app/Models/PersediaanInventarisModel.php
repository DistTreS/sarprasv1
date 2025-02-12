<?php

namespace App\Models;

use CodeIgniter\Model;

class PersediaanInventarisModel extends Model
{
    protected $table      = 'persediaan';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = [
        'nama_barang', 'deskripsi', 'jumlah', 'satuan', 'nilai'
    ];

    public function getAvailableItems()
    {
        return $this->select('id_barang, nama_barang')->findAll();
    }
}
