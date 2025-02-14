<?php
namespace App\Models;

use CodeIgniter\Model;

class AsetRusakModel extends Model
{
    protected $table = 'aset_rusak';
    protected $primaryKey = 'id_rusak';
    protected $allowedFields = [
        'id_aset',
        'id_user',
        'tanggal_pengajuan',
        'status_rusak',
        'keterangan',
        'bukti_foto'
    ];
}
