<?php

namespace App\Models;

use CodeIgniter\Model;

class PesertaDiklatModel extends Model
{
    protected $table = 'peserta_diklat';
    protected $primaryKey = 'id_peserta_diklat';
    protected $allowedFields = [
        'id_peserta',
        'id_diklat',
        'angkatan',
        'tahun',
        'sertifikat',
        'judul_tugas_akhir'
    ];

    public function getFilteredPeserta($keyword = null, $filterDiklat = null)
    {
        $query = $this->select('peserta_diklat.*, peserta.nama, peserta.nip, peserta.tempat_lahir, peserta.tanggal_lahir, peserta.golruang, peserta.nama_jabatan, peserta.instansi')
            ->join('peserta', 'peserta.id_peserta = peserta_diklat.id_peserta')
            ->join('jenis_diklat', 'jenis_diklat.id_diklat = peserta_diklat.id_diklat');

        if ($keyword) {
            $query->like('peserta.nama', $keyword)
                ->orLike('peserta.nip', $keyword)
                ->orLike('peserta.instansi', $keyword);
        }

        if ($filterDiklat) {
            $query->where('peserta_diklat.id_diklat', $filterDiklat);
        }

        return $query->paginate(25);
    }


    public function getInstansiList()
    {
        return $this->select('peserta.instansi')
            ->join('peserta', 'peserta.id_peserta = peserta_diklat.id_peserta')
            ->distinct()
            ->findAll();
    }

    public function getAngkatanList()
    {
        return $this->select('angkatan')
            ->distinct()
            ->findAll();
    }

    public function getTahunList()
    {
        return $this->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'DESC')
            ->findAll();
    }
}
