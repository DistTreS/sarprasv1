<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiInventarisModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'id_barang', 'id_user', 'nama_peminta', 'tipe_transaksi', 
        'jumlah', 'tanggal_transaksi', 'keterangan'
    ];
}
