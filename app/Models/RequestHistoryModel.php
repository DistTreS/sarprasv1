<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestHistoryModel extends Model
{
    protected $table      = 'request_history';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_request', 'status', 'tanggal_perubahan'
    ];

    /**
     * Log a status update in request history.
     */
    public function logStatusChange($id_request, $status)
    {
        return $this->insert([
            'id_request' => $id_request,
            'status' => $status,
            'tanggal_perubahan' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Get all history records for a specific request.
     */
    public function getHistoryByRequestId($id_request)
    {
        return $this->where('id_request', $id_request)
                    ->orderBy('tanggal_perubahan', 'DESC')
                    ->findAll();
    }
}
