<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseRequestsModel extends Model
{
    protected $table = 'purchase_requests';
    protected $primaryKey = 'id_request';

    protected $allowedFields = [
        'user_id',
        'nama_peminta',
        'tanggal_request',
        'status'
    ];

    protected $useTimestamps = false;

    public function getItemsByRequestId($id_request)
    {
        return $this->select('purchase_request_details.*, persediaan.nama_barang')
                    ->join('purchase_request_details', 'purchase_requests.id_request = purchase_request_details.id_request')
                    ->join('persediaan', 'persediaan.id_barang = purchase_request_details.id_barang')
                    ->where('purchase_requests.id_request', $id_request)
                    ->findAll();
    }

    public function addPurchaseRequest($nama_peminta, $items)
    {
        $db = \Config\Database::connect();

        $db->table('purchase_requests')->insert([
            'nama_peminta' => $nama_peminta,
            'tanggal_request' => date('Y-m-d H:i:s'),
            'status' => 'diproses'
        ]);

        $id_request = $db->insertID();

        foreach ($items as $item) {
            $db->table('purchase_request_details')->insert([
                'id_request' => $id_request,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah']
            ]);
        }

        return $id_request;
    }
}
