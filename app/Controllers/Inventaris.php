<?php

namespace App\Controllers;

use App\Models\ItemRequestsModel;
use App\Models\PersediaanInventarisModel;
use App\Models\RiwayatInventarisModel;
use App\Models\TransaksiInventarisModel;
use App\Models\RequestDetailsModel;
use App\Models\UsersModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Inventaris extends Controller
{
    protected $inventarisModel;
    protected $transactionModel;
    protected $itemRequestsModel;
    protected $requestDetailsModel;
    protected $UsersModel;
    
    public function __construct()
    {
        $this->inventarisModel = new PersediaanInventarisModel();
        $this->transactionModel = new TransaksiInventarisModel();
        $this->itemRequestsModel = new ItemRequestsModel();
        $this->requestDetailsModel = new RequestDetailsModel();
        $this->UsersModel = new UsersModel();
    }

    public function index()
    {
        $data['persediaan'] = $this->inventarisModel->findAll();
        return view('inventaris/index', $data);
    }

    public function index_pegawai()
    {
        $data['persediaan'] = $this->inventarisModel->findAll();
        return view('inventaris/index_pegawai', $data);
    }

     // Form Tambah Data
     public function create()
     {
         return view('inventaris/create');
     }
     
     // Simpan Data Baru
     public function store()
     {
         $model = new PersediaanInventarisModel();
         
         // Simpan ke database
         $data = [
             'nama_barang'          => $this->request->getPost('nama_barang'),
             'satuan'               => $this->request->getPost('satuan'),
             'nilai'                => $this->request->getPost('nilai'),
             'deskripsi'           => $this->request->getPost('deskripsi'),
         ];
 
         $model->insert($data);
 
         return redirect()->to('/inventaris/index');
     }

      // Form Edit Data
    public function edit($id)
    {
        $data['persediaan'] = $this->inventarisModel->find($id);
        return view('inventaris/edit', $data);
    }

    // Update Data
    public function update($id)
    {
        $this->inventarisModel->update($id, $this->request->getPost());
        return redirect()->to('/inventaris/index');
    }

    // Hapus Data
    public function delete($id)
    {
        $this->inventarisModel->delete($id);
        return redirect()->to('/inventaris/index');
    }

    public function insert()
    {
    $inventoryModel = new PersediaanInventarisModel();
    
    // Ensure the query selects id_barang and nama_barang
    $data['items'] = $inventoryModel->select('id_barang, nama_barang')->findAll();

    // dd($this->request->getPost());


    return view('inventaris/insert', $data);
    }

    public function insert_items()
{
    $postData = $this->request->getPost('items'); 
    
    if (!$postData) {
        return redirect()->back()->with('error', 'No data received.');
    }

    // Debugging: Check if all items are received
    log_message('debug', 'Received items: ' . json_encode($postData));

    $inventoryModel = new PersediaanInventarisModel();
    $transactionModel = new TransaksiInventarisModel();
    $historyModel = new RiwayatInventarisModel();

    foreach ($postData as $index => $item) {
        log_message('debug', "Processing item index $index: " . json_encode($item));

        // Ensure all necessary data exists
        if (!isset($item['id_barang']) || !isset($item['jumlah'])) {
            continue; // Skip invalid data
        }

        $id_barang = $item['id_barang'];
        $jumlah = (int) $item['jumlah'];
        $satuan = $item['satuan'] ?? '';

        // Fetch current stock
        $existingItem = $inventoryModel->find($id_barang);

        if (!$existingItem) {
            log_message('error', "Item ID $id_barang not found in inventory.");
            continue; // Skip if item doesn't exist
        }

        // Update inventory stock
        $newJumlah = $existingItem['jumlah'] + $jumlah;
        $inventoryModel->update($id_barang, ['jumlah' => $newJumlah]);

        $session = session();
        $role = $session->get('role');
        $user_id = $session->get('id'); 

        // Insert transaction
        $transactionData = [
            'id_barang' => $id_barang,
            'id_user' => '1', // Replace with actual user ID
            'nama_peminta' => 'Administrator', // Replace if needed
            'tipe_transaksi' => 'Masuk',
            'jumlah' => $jumlah,
            'tanggal_transaksi' => date('Y-m-d'),
            'keterangan' => 'Added via batch insert'
        ];
        $transactionModel->insert($transactionData);
        $id_transaksi = $transactionModel->insertID(); // Get last insert ID

        // Insert into history
        $historyData = [
            'id_barang' => $id_barang,
            'id_transaksi' => $id_transaksi,
            'tipe' => 'Masuk',
            'jumlah_sebelumnya' => $existingItem['jumlah'],
            'jumlah_baru' => $newJumlah,
            'tanggal_perubahan' => date('Y-m-d')
        ];
        $historyModel->insert($historyData);
    }

    return redirect()->to('inventaris/index')->with('success', 'Items inserted successfully.');
}

public function transaction_history()
{
    $page = $this->request->getVar('page') ?? 1;
    $perPage = 10;

    $filters = [];

    if ($this->request->getGet('date_from')) {
        $filters['date_from'] = $this->request->getGet('date_from');
    }
    if ($this->request->getGet('date_to')) {
        $filters['date_to'] = $this->request->getGet('date_to');
    }
    if ($this->request->getGet('type')) {
        $type = $this->request->getGet('type');
        if (in_array($type, ['Masuk', 'Keluar'])) { // Ensure case-sensitive match
            $filters['tipe_transaksi'] = $type;
        }
    }
    if ($this->request->getGet('user')) {
        $filters['nama_peminta'] = $this->request->getGet('user');
    }

    $transactions = $this->transactionModel->getFilteredTransactions($filters, $perPage, ($page - 1) * $perPage);
    $total = $this->transactionModel->countFilteredTransactions($filters);

    return view('inventaris/transaction_history', [
        'transactions' => $transactions,
        'pager' => [
            'current_page' => $page,
            'total_pages' => ceil($total / $perPage),
        ]
    ]);
}


public function item_history($id_barang)
{
    $page = $this->request->getVar('page') ? (int) $this->request->getVar('page') : 1;
    $perPage = 10;

    $history = $this->transactionModel->getItemHistory($id_barang, $perPage, ($page - 1) * $perPage);
    $total = $this->transactionModel->countItemHistory($id_barang);

    // Fetch the item name
    $db = \Config\Database::connect();
    $item = $db->table('persediaan')->where('id_barang', $id_barang)->get()->getRowArray();
    $item_name = $item ? $item['nama_barang'] : 'Unknown Item';

    return view('inventaris/item_history', [
        'history' => $history,
        'pager' => [
            'current_page' => $page,
            'total_pages' => ceil($total / $perPage),
        ],
        'item_name' => $item_name,
    ]);
}

public function user_request_item()
    {
        $data['items'] = $this->inventarisModel->findAll();
        return view('inventaris/user_request_item', $data);
    }




public function manage_request()
{
    $requestModel = new ItemRequestsModel();
    $detailModel = new RequestDetailsModel();
    
    // Get all requests
    $requests = $requestModel->findAll();
    
    // Get details for each request
    foreach ($requests as &$request) {
        $details = $detailModel
            ->select('request_details.*, persediaan.nama_barang')
            ->join('persediaan', 'persediaan.id_barang = request_details.id_barang')
            ->where('id_request', $request['id_request'])
            ->findAll();
            
        $request['details'] = $details;
    }
    
    return view('inventaris/manage_request', ['requests' => $requests]);
}


public function submit_request()
{
    $itemRequestsModel = new ItemRequestsModel();
    $requestDetailsModel = new RequestDetailsModel();
    $db = \Config\Database::connect();

    // Get form data
    $nama_peminta = $this->request->getPost('nama_peminta');
    $items = $this->request->getPost('items');

    // Basic validation
    if (empty($nama_peminta) || empty($items)) {
        return redirect()->back()
                        ->with('error', 'Nama peminta dan items harus diisi.')
                        ->withInput();
    }

    // Start transaction
    $db->transStart();

    try {
        // Insert main request - now including user_id
        $requestData = [
            'nama_peminta' => $nama_peminta,
            'tanggal_request' => date('Y-m-d H:i:s'),
            'status' => 'Sent',
            'user_id' => 1  // Set a default user_id or get it from your authentication system
        ];

        if (!$itemRequestsModel->insert($requestData)) {
            log_message('error', 'Failed to insert request: ' . print_r($itemRequestsModel->errors(), true));
            throw new \Exception('Gagal menyimpan data permintaan utama.');
        }

        $id_request = $db->insertID();

        // Process each requested item
        foreach ($items as $item) {
            if (empty($item['id_barang']) || empty($item['jumlah']) || $item['jumlah'] <= 0) {
                throw new \Exception('Data item tidak valid.');
            }

            $detailData = [
                'id_request' => $id_request,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah']
            ];
            
            if (!$requestDetailsModel->insert($detailData)) {
                log_message('error', 'Failed to insert detail: ' . print_r($requestDetailsModel->errors(), true));
                throw new \Exception('Gagal menyimpan detail permintaan.');
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            throw new \Exception('Gagal menyimpan permintaan.');
        }

        return redirect()->to('inventaris/user_request_item')
                        ->with('success', 'Permintaan berhasil disubmit.');

    } catch (\Exception $e) {
        $db->transRollback();
        log_message('error', 'Request submission error: ' . $e->getMessage());
        return redirect()->back()
                        ->with('error', $e->getMessage())
                        ->withInput();
    }
}


// public function update_status($requestId)
// {
//     if ($this->request->getMethod() === 'post') {
//         $newStatus = $this->request->getPost('status');

//         log_message('debug', "Updating request ID: {$requestId} with status: {$newStatus}");

//         // Validate status
//         if (!in_array($newStatus, ['Sent', 'Processed', 'Accepted', 'Rejected'])) {
//             log_message('error', 'Invalid status: ' . $newStatus);
//             return $this->response->setJSON(['success' => false, 'message' => 'Status tidak valid!']);
//         }

//         // Check if the request exists
//         $requestData = $this->itemRequestsModel->find($requestId);
//         if (!$requestData) {
//             log_message('error', "Request ID {$requestId} not found!");
//             return $this->response->setJSON(['success' => false, 'message' => 'Request tidak ditemukan!']);
//         }

//         // If Accepted, reduce inventory
//         if ($newStatus === 'Accepted') {
//             $requestDetails = $this->requestDetailsModel->where('id_request', $requestId)->findAll();

//             foreach ($requestDetails as $detail) {
//                 $itemId = $detail['id_barang'];
//                 $quantity = $detail['jumlah'];

//                 $item = $this->inventarisModel->find($itemId);
//                 if (!$item || $item['jumlah'] < $quantity) {
//                     log_message('error', "Not enough stock for item ID: {$itemId}");
//                     return $this->response->setJSON([
//                         'success' => false,
//                         'message' => 'jumlah tidak cukup untuk ' . $item['nama_barang']
//                     ]);
//                 }

//                 // Reduce stock
//                 $this->inventarisModel->update($itemId, ['jumlah' => $item['jumlah'] - $quantity]);

//                 // Insert into transaksi_inventaris
//                 $this->transactionModel->insert([
//                     'id_barang' => $itemId,
//                     'jumlah' => $quantity,
//                     'tipe_transaksi' => 'Keluar',
//                     'tanggal_request' => date('Y-m-d H:i:s'),
//                     'user_id' => $requestData['user_id']
//                 ]);

//                 // Insert into riwayat_inventaris
                

//             }
//         }

//         // Update request status
//         if ($this->itemRequestsModel->update($requestId, ['status' => $newStatus])) {
//             log_message('debug', "Request ID: {$requestId} updated successfully.");
//             return $this->response->setJSON(['success' => true, 'message' => 'Status berhasil diperbarui!']);
//         } else {
//             log_message('error', "Failed to update request ID: {$requestId}");
//             return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui status!']);
//         }
//     }

//     return $this->response->setJSON(['success' => false, 'message' => 'Metode tidak diizinkan!']);
// }


public function update_status($requestId)
{
    if ($this->request->getMethod() === 'post') {
        $newStatus = $this->request->getPost('status');

        log_message('debug', "Updating request ID: {$requestId} with status: {$newStatus}");

        // Validate status
        if (!in_array($newStatus, ['Sent', 'Processed', 'Accepted', 'Rejected'])) {
            log_message('error', 'Invalid status: ' . $newStatus);
            return $this->response->setJSON(['success' => false, 'message' => 'Status tidak valid!']);
        }

        // Check if the request exists
        $requestData = $this->itemRequestsModel->find($requestId);
        if (!$requestData) {
            log_message('error', "Request ID {$requestId} not found!");
            return $this->response->setJSON(['success' => false, 'message' => 'Request tidak ditemukan!']);
        }

        // Prepare update data
        $updateData = ['status' => $newStatus];

        // If Accepted, reduce inventory and update tanggal_request
        if ($newStatus === 'Accepted') {
            $requestDetails = $this->requestDetailsModel->where('id_request', $requestId)->findAll();

            foreach ($requestDetails as $detail) {
                $itemId = $detail['id_barang'];
                $quantity = $detail['jumlah'];

                $item = $this->inventarisModel->find($itemId);
                if (!$item || $item['jumlah'] < $quantity) {
                    log_message('error', "Not enough stock for item ID: {$itemId}");
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Jumlah tidak cukup untuk ' . $item['nama_barang']
                    ]);
                }

                // Reduce stock
                $this->inventarisModel->update($itemId, ['jumlah' => $item['jumlah'] - $quantity]);
                // $user = $this->UsersModel->find($requestData['user_id']); // Fetch user info

                $this->transactionModel->insert([
                    'id_barang' => $itemId,
                    'jumlah' => $quantity,
                    'tipe_transaksi' => 'Keluar',
                    'tanggal_transaksi' => date('Y-m-d H:i:s'),
                    'keterangan' => 'Approved request'
                ]);
                

            }

            // **Update tanggal_request to the current date when accepted**
            $updateData['tanggal_request'] = date('Y-m-d H:i:s');
        }

        // Update request status (and tanggal_request if accepted)
        if ($this->itemRequestsModel->update($requestId, $updateData)) {
            log_message('debug', "Request ID: {$requestId} updated successfully.");
            return $this->response->setJSON(['success' => true, 'message' => 'Status berhasil diperbarui!']);
        } else {
            log_message('error', "Failed to update request ID: {$requestId}");
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui status!']);
        }
    }

    return $this->response->setJSON(['success' => false, 'message' => 'Metode tidak diizinkan!']);
}





public function store_request()
{
    $postData = $this->request->getPost();

    // Check if items exist
    if (!isset($postData['items']) || empty($postData['items'])) {
        log_message('error', 'Request submission error: No items selected.');
        return $this->response->setJSON(['success' => false, 'message' => 'No items selected.']);
    }

    // Get user information (nullable)
    $userId = session()->get('user_id') ?? null;
    $namaPeminta = $postData['nama_peminta'] ?? session()->get('username') ?? 'Guest';

    // Main request data
    $requestData = [
        'user_id' => $userId,
        'nama_peminta' => $namaPeminta,
        'tanggal_request' => date('Y-m-d H:i:s'),
        'status' => 'Sent'
    ];

    // Debugging log
    log_message('debug', 'Request Data: ' . json_encode($requestData));
    log_message('debug', 'Testing log: Request data => ' . json_encode($this->request->getPost()));


    // Insert into `item_requests`
    if (!$this->itemRequestsModel->insert($requestData)) {
        log_message('error', 'Request submission error: Failed to insert into item_requests.');
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to create request.']);
    }

    // Get the last inserted ID
    $requestId = $this->itemRequestsModel->insertID();

    // Insert request details
    foreach ($postData['items'] as $item) {
        if ($item['jumlah'] > 0) {
            $detailData = [
                'id_request' => $requestId,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah']
            ];

            log_message('debug', 'Inserting Request Detail: ' . json_encode($detailData));

            if (!$this->requestDetailsModel->insert($detailData)) {
                log_message('error', 'Request submission error: Failed to insert request details for item ' . $item['id_barang']);
            }
        }
    }

    return $this->response->setJSON(['success' => true, 'message' => 'Request submitted successfully.']);
}

}

