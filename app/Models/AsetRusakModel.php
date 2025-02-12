<?php
namespace App\Models;

use CodeIgniter\Model;

class AsetRusakModel extends Model
{
    protected $table = 'aset_rusak';
    protected $primaryKey = 'id_aset';
    protected $allowedFields = [
        'id',
        'keterangan',
        'gambar'
    ];
}
