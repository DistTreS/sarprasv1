<?php

namespace App\Models;

use CodeIgniter\Model;


class AsetRusakModel extends Model
{
    protected $table = 'aset_rusak';
    protected $primaryKey = ['id_aset', 'id']; // Karena ini composite key
    protected $allowedFields = ['id_aset', 'id', 'tanggal_pengajuan', 'status_kerusakan', 'keterangan', 'bukti_foto'];

    public function getAsetRusakWithNamaAset()
    {
        return $this->db->table('aset_rusak')
            ->select('aset_rusak.*, aset.nama_aset') // Pastikan nama_aset diambil
            ->join('aset', 'aset.id_aset = aset_rusak.id_aset', 'left')
            ->get()
            ->getResultArray();
    }
}
