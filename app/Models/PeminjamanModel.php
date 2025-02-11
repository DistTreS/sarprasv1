<?php
namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman'; // Perbaikan nama tabel
    protected $primaryKey = 'id_peminjaman';
    protected $allowedFields = [
        'id_user',
        'id_aset',
        'tanggal_peminjaman',
        'tanggal_rencana_pengembalian',
        'tanggal_pengembalian',
        'status',
        'CC',
        'keterangan'
    ];
}
