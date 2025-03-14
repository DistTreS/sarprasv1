<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriAsetModel extends Model
{
    protected $table = 'kategori_aset';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['kode_kategori', 'nama_kategori', 'deskripsi'];

    public function getKategoriWithCount()
    {
        return $this->db->table('kategori_aset')
                        ->select('kategori_aset.*, COUNT(aset.id_aset) AS jumlah_aset')
                        ->join('aset', 'aset.id_kategori = kategori_aset.id_kategori', 'left outer')
                        ->groupBy('kategori_aset.id_kategori')
                        ->get()
                        ->getResultArray();
    }
}
