<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemRequestsModel extends Model
{
    protected $table = 'item_requests';  // The table name
    protected $primaryKey = 'id_request'; // Primary key

    protected $allowedFields = [
        'user_id', 
        'nama_peminta', 
        'tanggal_request', 
        'status'
    ];

    protected $useTimestamps = false; // Since `tanggal_request` is manually set



    /**
     * Get all items related to a specific request.
     */
    public function getItemsByRequestId($id_request)
    {
        return $this->select('request_details.*, persediaan.nama_barang')
                    ->join('persediaan', 'persediaan.id_barang = request_details.id_barang')
                    ->where('request_details.id_request', $id_request)
                    ->findAll();
    }

    public function addRequest($nama_peminta, $items)
    {
        $db = \Config\Database::connect();
    
        // Insert into item_requests
        $db->table('item_requests')->insert([
            'nama_peminta' => $nama_peminta,
            'tanggal_request' => date('Y-m-d H:i:s'),
            'status' => 'Sent'
        ]);
    
        // Get the last inserted request ID
        $id_request = $db->insertID();
    
        // Insert into request_details
        foreach ($items as $item) {
            $db->table('request_details')->insert([
                'id_request' => $id_request,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah']
            ]);
        }
    
        return $id_request;
    }
    

}
