<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiInventarisModel extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'id_barang', 'id_user', 'nama_peminta', 'tipe_transaksi', 
        'jumlah', 'tanggal_transaksi', 'keterangan'
    ];

    // public function getFilteredTransactions($filters, $limit, $offset)
    // {
    //     $builder = $this->db->table($this->table)->limit($limit, $offset);

    //     if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
    //         $builder->where('tanggal_transaksi >=', $filters['start_date'])
    //                 ->where('tanggal_transaksi <=', $filters['end_date']);
    //     }
    //     if (!empty($filters['type'])) {
    //         $builder->where('tipe_transaksi', $filters['type']);
    //     }
    //     if (!empty($filters['user'])) {
    //         $builder->where('id_user', $filters['user']);
    //     }

    //     return $builder->get()->getResultArray();
    // }

    public function getFilteredTransactions($filters, $limit, $offset)
{
    $builder = $this->db->table($this->table)
        ->select('transaksi.id_transaksi, transaksi.id_barang, transaksi.id_user, persediaan.nama_barang, users.full_name AS nama_user, transaksi.nama_peminta, transaksi.tipe_transaksi, transaksi.jumlah, transaksi.tanggal_transaksi, transaksi.keterangan')
        ->join('persediaan', 'persediaan.id_barang = transaksi.id_barang', 'left')
        ->join('users', 'users.id = transaksi.id_user', 'left')
        ->limit($limit, $offset);

    if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
        $builder->where('transaksi.tanggal_transaksi >=', $filters['date_from'])
                ->where('transaksi.tanggal_transaksi <=', $filters['date_to']);
    }
    if (!empty($filters['type'])) {
        $builder->where('transaksi.tipe_transaksi', $filters['type']);
    }
    if (!empty($filters['user'])) {
        $builder->where('transaksi.id_user', $filters['user']);
    }

    return $builder->get()->getResultArray();
}


    public function countFilteredTransactions($filters)
    {
        $builder = $this->db->table($this->table);
        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $builder->where('tanggal_transaksi >=', $filters['start_date'])
                    ->where('tanggal_transaksi <=', $filters['end_date']);
        }
        if (!empty($filters['type'])) {
            $builder->where('tipe_transaksi', $filters['type']);
        }
        if (!empty($filters['user'])) {
            $builder->where('id_user', $filters['user']);
        }

        return $builder->countAllResults();
    }

    public function getItemHistory($id_barang, $limit, $offset)
    {
        return $this->where('id_barang', $id_barang)
                    ->limit($limit, $offset)
                    ->findAll();
    }

    public function countItemHistory($id_barang)
    {
        return $this->where('id_barang', $id_barang)->countAllResults();
    }



}

