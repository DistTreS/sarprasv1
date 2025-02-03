<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatInventarisModel extends Model
{
    protected $table      = 'riwayat_barang';
    protected $primaryKey = 'id_riwayat';
    protected $allowedFields = [
        'id_barang', 'id_transaksi', 'tipe', 'jumlah_sebelumnya', 
        'jumlah_baru', 'tanggal_perubahan'
    ];
}
