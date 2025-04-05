<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $allowedFields = [
        'id',
        'id_aset',
        'tanggal_peminjaman',
        'tanggal_rencana_pengembalian',
        'tanggal_pengembalian',
        'status_peminjaman',
        'status_layanan',
        'CC',
        'keterangan',
        'bukti_pengembalian',
        'id_pengajuan',
        'acc_by'
    ];

    public function getPeminjamanWithAdmin($id_peminjaman)
    {
        return $this->select('peminjaman.*, users.full_name as admin_nama, users.id as admin_id')
            ->join('users', 'users.id = peminjaman.updated_by', 'left') // JOIN dengan tabel users
            ->where('peminjaman.id', $id_peminjaman)
            ->first();
    }


    public function getDetailPeminjaman($id_peminjaman)
    {
        return $this->db->table('peminjaman')
            ->select('peminjaman.id_pengajuan, peminjaman.CC, peminjaman.keterangan, 
                  peminjaman.tanggal_peminjaman, peminjaman.tanggal_rencana_pengembalian, peminjaman.tanggal_pengembalian, 
                  peminjaman.status_peminjaman, peminjaman.status_layanan, peminjaman.acc_by, aset.nup, aset.nama_aset, users.full_name')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
            ->join('users', 'users.id = peminjaman.id', 'left')
            ->where('peminjaman.id_pengajuan', $id_peminjaman)
            ->get()
            ->getResultArray();
    }




    public function getPeminjamanByUser($id)
    {
        return $this->select('peminjaman.*, aset.nama_aset')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
            ->where('peminjaman.id', $id) // Sesuaikan dengan kolom ID user
            ->orderBy('peminjaman.tanggal_peminjaman', 'DESC')
            ->findAll();
    }


    public function getAllPeminjaman()
    {
        return $this->select('
        peminjaman.id_pengajuan,
        users.full_name, 
        GROUP_CONCAT(aset.nup SEPARATOR ", ") as nup,
        GROUP_CONCAT(aset.nama_aset SEPARATOR ", ") as nama_aset,
        peminjaman.tanggal_peminjaman,
        peminjaman.tanggal_rencana_pengembalian,
        peminjaman.status_layanan
    ')
            ->join('users', 'users.id = peminjaman.id', 'left')
            ->join('aset', 'aset.id_aset = peminjaman.id_aset', 'left')
            ->groupBy('peminjaman.id_pengajuan') // <== Mengelompokkan berdasarkan ID Pengajuan
            ->orderBy('peminjaman.tanggal_peminjaman', 'DESC')
            ->findAll();
    }



    public function tambahPengajuan($data)
    {
        $data['tanggal_peminjaman'] = date('Y-m-d');
        $data['status_layanan'] = 'Pengajuan';
        $data['status_peminjaman'] = 'Belum Disetujui';
        return $this->insert($data);
    }

    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status_layanan' => $status]);
    }

    public function setujuiPeminjaman($id)
    {
        return $this->update($id, [
            'status_layanan' => 'Proses',
            'status_peminjaman' => 'Disetujui'
        ]);
    }

    public function selesaikanPeminjaman($id, $bukti)
    {
        return $this->update($id, [
            'status_layanan' => 'Selesai',
            'tanggal_pengembalian' => date('Y-m-d'),
            'bukti_pengembalian' => $bukti
        ]);
    }
}
