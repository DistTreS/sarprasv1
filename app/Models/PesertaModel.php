<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaModel extends Model
{
    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';
    protected $allowedFields = [
        'nama',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_jabatan',
        'instansi'
    ];

    
}
