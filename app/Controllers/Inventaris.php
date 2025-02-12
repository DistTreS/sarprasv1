<?php

namespace App\Controllers;

use App\Models\ItemRequestsModel;
use App\Models\PersediaanInventarisModel;
use App\Models\RiwayatInventarisModel;
use App\Models\TransaksiInventarisModel;
use CodeIgniter\Controller;
use App\Models\RequestHistoryModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Inventaris extends Controller
{
    protected $inventarisModel;
    protected $transactionModel;
    protected $itemRequestsModel;
    protected $requestHistoryModel;
    
    public function __construct()
    {
        $this->inventarisModel = new PersediaanInventarisModel();
        $this->transactionModel = new TransaksiInventarisModel();
        $this->itemRequestsModel = new ItemRequestsModel();
        $this->requestHistoryModel = new RequestHistoryModel();
        $this->persediaanModel = new PersediaanInventarisModel();
    }

    public function index()
    {
        $data['persediaan'] = $this->inventarisModel->findAll();
        return view('inventaris/index', $data);
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
        return redirect()->to('/inventaris');
    }

    // Hapus Data
    public function delete($id)
    {
        $this->inventarisModel->delete($id);
        return redirect()->to('/inventaris');
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

        // Insert transaction
        $transactionData = [
            'id_barang' => $id_barang,
            'id_user' => 1, // Replace with actual user ID
            'nama_peminta' => 'System', // Replace if needed
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

    return redirect()->to('/inventaris')->with('success', 'Items inserted successfully.');
}


public function transaction_history()
{

    $page = $this->request->getVar('page');
    $page = isset($page) ? (int) $page : 1;
    $perPage = 10;
    
    $filters = [];
    if ($this->request->getGet('date_from')) {
        $filters['date_from'] = $this->request->getGet('date_from');
    }
    if ($this->request->getGet('date_to')) {
        $filters['date_to'] = $this->request->getGet('date_to');
    }
    if ($this->request->getGet('type')) {
        $filters['type'] = $this->request->getGet('type');
    }
    if ($this->request->getGet('user')) {
        $filters['user'] = $this->request->getGet('user');
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

/**
     * Display user request form
     */
    public function userRequestItems()
    {
        $data['persediaan'] = $this->inventarisModel->getAvailableItems();
        return view('inventaris/user_request_items', $data);
    }

    /**
     * Handle item request submission
     */
    // public function submitRequest()
    // {
    //     $nama_peminta = $this->request->getPost('nama_peminta');
    //     $items = $this->request->getPost('items'); // Expecting array of id_barang => jumlah

    //     if (empty($nama_peminta) || empty($items)) {
    //         return redirect()->back()->with('error', 'Please provide all required information.');
    //     }

    //     $db = \Config\Database::connect();
    //     $db->transStart();

    //     // Insert the main request record
    //     $requestData = [
    //         'nama_peminta' => $nama_peminta,
    //         'status' => 'Sent',
    //         'tanggal_request' => date('Y-m-d H:i:s'),
    //     ];
    //     $db->table('item_requests')->insert($requestData);
    //     $id_request = $db->insertID();

    //     // Insert requested items
    //     foreach ($items as $id_barang => $jumlah) {
    //         $this->itemRequestsModel->insert([
    //             'id_request' => $id_request,
    //             'id_barang' => $id_barang,
    //             'jumlah' => $jumlah
    //         ]);
    //     }

    //     // Log the request creation in history
    //     $this->requestHistoryModel->logStatusChange($id_request, 'Sent');

    //     $db->transComplete();

    //     return redirect()->to('/inventaris/manage_requests')->with('success', 'Request submitted successfully.');
    // }

    public function submitRequest()
{
    $itemRequestsModel = new ItemRequestsModel();
    $db = \Config\Database::connect();
    
    $nama_peminta = $this->request->getPost('nama_peminta');
    $tanggal_request = date('Y-m-d H:i:s');
    $status = 'Sent';
    $items = $this->request->getPost('items'); // Should be an array

    if (empty($nama_peminta) || empty($items)) {
        return redirect()->back()->with('error', 'Requester name and items are required.');
    }

    // Start transaction
    $db->transStart();

    $data = [
        'id_request' => $this->request->getPost('id_request'),
        'id_barang'  => $this->request->getPost('id_barang'),
        'jumlah'     => $this->request->getPost('jumlah')
    ];

    // Dump and die to see the data
    dd($data);

    $this->itemRequestsModel->insert($data);
    
    // Insert into item_requests table
    $db->table('item_requests')->insert([
        'nama_peminta' => $nama_peminta,
        'tanggal_request' => $tanggal_request,
        'status' => $status
    ]);

    // Get the last inserted request ID
    $id_request = $db->insertID();

    // Insert items into request_details
    foreach ($items as $item) {
        $db->table('request_details')->insert([
            'id_request' => $id_request,
            'id_barang' => $item['id_barang'],
            'jumlah' => $item['jumlah']
        ]);
    }

    // Commit transaction
    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->back()->with('error', 'Failed to submit request.');
    }

    return redirect()->back()->with('success', 'Request submitted successfully.');
}


    /**
     * Display list of requests
     */
    // public function manageRequests()
    // {
    //     $db = \Config\Database::connect();
    //     $requests = $db->table('item_requests')->get()->getResultArray();
        
    //     foreach ($requests as &$request) {
    //         $request['items'] = $this->itemRequestsModel->getItemsByRequestId($request['id']);
    //     }

    //     $data['item_requests'] = $requests;
    //     return view('inventaris/manage_requests', $data);
    // }

    public function manageRequests()
{
    $db = \Config\Database::connect();
    $itemRequestsModel = new ItemRequestsModel(); // Initialize the model

    // Fetch all requests
    $requests = $db->table('item_requests')->get()->getResultArray();

    foreach ($requests as &$request) {
        // Get items for each request
        $request['items'] = $itemRequestsModel->getItemsByRequestId($request['id']);
    }

    // Pass the corrected variable name
    return view('inventaris/manage_requests', ['requests' => $requests]);
}


    /**
     * Update request status
     */
    public function updateRequestStatus($id_request)
    {
        $status = $this->request->getPost('status');

        if (!$status) {
            return redirect()->back()->with('error', 'Invalid status update.');
        }

        $db = \Config\Database::connect();
        $db->table('item_requests')->where('id', $id_request)->update(['status' => $status]);
        $this->requestHistoryModel->logStatusChange($id_request, $status);

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * View request history
     */
    public function viewRequestHistory($id_request)
    {
        $data['history'] = $this->requestHistoryModel->getHistoryByRequestId($id_request);
        return view('inventaris/request_history', $data);
    }


}



