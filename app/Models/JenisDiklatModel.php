<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisDiklatModel extends Model
{
    protected $table = 'jenis_diklat';
    protected $primaryKey = 'id_diklat';
    protected $allowedFields = [
        'nama_diklat',
        'deskripsi'
    ];
}
