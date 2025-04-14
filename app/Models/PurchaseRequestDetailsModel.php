<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseRequestDetailsModel extends Model
{
    protected $table = 'purchase_request_details';
    protected $primaryKey = 'id_detail';

    protected $allowedFields = [
        'id_request',
        'id_barang',
        'jumlah'
    ];

    protected $useTimestamps = false;

    public function getItemsByRequestId($id_request)
    {
        return $this->select('purchase_request_details.*, persediaan.nama_barang')
                    ->join('persediaan', 'persediaan.id_barang = purchase_request_details.id_barang')
                    ->where('id_request', $id_request)
                    ->findAll();
    }

    public function insertBatchDetails($id_request, $items)
    {
        $batchData = [];

        foreach ($items as $item) {
            $batchData[] = [
                'id_request' => $id_request,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah']
            ];
        }

        return $this->insertBatch($batchData);
    }
}
