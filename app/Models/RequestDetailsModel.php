<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestDetailsModel extends Model
{
    protected $table = 'request_details';  // The table name
    protected $primaryKey = 'id_detail';   // Primary key

    protected $allowedFields = [
        'id_request', 
        'id_barang', 
        'jumlah'
    ];

    protected $useTimestamps = false; // No timestamps in the table



    /**
     * Get all items related to a specific request.
     */
    public function getItemsByRequestId($id_request)
    {
        return $this->select('request_details.*, persediaan.nama_barang')
                    ->join('persediaan', 'persediaan.id_barang = request_details.id_barang')
                    ->where('id_request', $id_request)
                    ->findAll();
    }

    /**
     * Insert multiple items into request_details.
     */
    public function insertBatchDetails($id_request, $items)
    {
        $batchData = [];

        foreach ($items as $item) {
            $batchData[] = [
                'id_request' => $id_request,
                'id_barang'  => $item['id_barang'],
                'jumlah'     => $item['jumlah']
            ];
        }

        return $this->insertBatch($batchData);
    }
}
