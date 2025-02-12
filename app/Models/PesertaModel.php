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
        'golruang',
        'nama_jabatan',
        'instansi'
    ];

    public function filterData($params)
    {
        $this->select('peserta.*, peserta_diklat.*')
            ->join('peserta', 'peserta.id_peserta = peserta_diklat.id_peserta');

        if (!empty($params['keyword'])) {
            $this->groupStart()
                ->like('peserta.nama', $params['keyword'])
                ->orLike('peserta.nip', $params['keyword'])
                ->groupEnd();
        }

        if (!empty($params['id_diklat'])) {
            $this->where('peserta_diklat.id_diklat', $params['id_diklat']);
        }

        if (!empty($params['instansi'])) {
            $this->like('peserta.instansi', $params['instansi']);
        }

        if (!empty($params['angkatan'])) {
            $this->where('peserta_diklat.angkatan', $params['angkatan']);
        }

        if (!empty($params['tahun'])) {
            $this->where('peserta_diklat.tahun', $params['tahun']);
        }

        return $this->paginate(25);
    }
}
