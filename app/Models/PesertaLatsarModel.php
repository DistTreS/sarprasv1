<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaLatsarModel extends Model
{
    protected $table      = 'peserta_latsar';
    protected $primaryKey = 'id_peserta_latsar';
    protected $allowedFields = [
        'Nama', 'Nip', 'Tempat_Tgl_Lahir', 'Golruang', 'nama_jabatan', 
        'instansi', 'angkatan', 'tahun', 'sertifikat'
    ];
}
