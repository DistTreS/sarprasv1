<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriAsetModel extends Model
{
    protected $table = 'kategori_aset';
    protected $primaryKey = 'kode_kategori'; // Disesuaikan dengan struktur DB
    protected $allowedFields = ['kode_kategori', 'nama_kategori', 'deskripsi'];

    public function getKategoriWithCount()
    {
        return $this->db->table('kategori_aset')
            ->select('kategori_aset.*, COUNT(aset.id_aset) AS jumlah_aset')
            ->join('aset', 'aset.kode_kategori = kategori_aset.kode_kategori', 'left')
            ->groupBy('kategori_aset.kode_kategori')
            ->get()
            ->getResultArray();
    }
    public function countAsetByKategori($kode_kategori)
    {
        return $this->db->table('aset')
            ->where('kode_kategori', $kode_kategori)
            ->countAllResults();
    }
    public function searchKategori($keyword)
    {
        return $this->db->table('kategori_aset')
            ->select('kategori_aset.*, COUNT(aset.id_aset) AS jumlah_aset')
            ->join('aset', 'aset.kode_kategori = kategori_aset.kode_kategori', 'left')
            ->groupBy('kategori_aset.kode_kategori')
            ->like('kategori_aset.kode_kategori', $keyword)
            ->orLike('kategori_aset.nama_kategori', $keyword)
            ->get()
            ->getResultArray();
    }
}
