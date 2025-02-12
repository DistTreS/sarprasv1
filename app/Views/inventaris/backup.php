//manage_requests

<?= $this->include('layout/sidebar'); ?>
<h2>Manage Requests</h2>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;"> <?= session()->getFlashdata('success'); ?> </p>
<?php endif; ?>

<table border="1">
    <tr>
        <th>No</th>
        <th>Requester</th>
        <th>Requested Items</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($requests as $index => $request): ?>
        <tr>
            <td><?= $index + 1; ?></td>
            <td><?= esc($request['nama_peminta']); ?></td>
            <td><?= esc($request['items']); ?></td>
            <td><?= esc($request['total_jumlah']); ?></td>
            <td><?= esc($request['status']); ?></td>
            <td>
                <form method="post" action="<?= base_url('inventaris/update_request_status/' . $request['id']); ?>">
                    <select name="status">
                        <option value="Sent" <?= $request['status'] == 'Sent' ? 'selected' : ''; ?>>Sent</option>
                        <option value="Processed" <?= $request['status'] == 'Processed' ? 'selected' : ''; ?>>Processed</option>
                        <option value="Accepted" <?= $request['status'] == 'Accepted' ? 'selected' : ''; ?>>Accepted</option>
                        <option value="Rejected" <?= $request['status'] == 'Rejected' ? 'selected' : ''; ?>>Rejected</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

//request Controller

public function request_items()
{
    if ($this->request->getMethod() === 'post') {
        $user_id = session()->get('user_id');
        $nama_peminta = $this->request->getPost('nama_peminta');
        $items = $this->request->getPost('items');
        
        foreach ($items as $item) {
            $data = [
                'user_id' => $user_id,
                'nama_peminta' => $nama_peminta,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah'],
                'status' => 'Sent'
            ];
            $this->requestModel->insert($data);
        }

        return redirect()->to('/inventaris/request_items')->with('success', 'Request submitted successfully');
    }
    return view('inventaris/request_items');
}


public function manage_requests()
{
    $allRequests = $this->requestModel->getAllRequests();

    // Group requests by nama_peminta and tanggal_request
    $groupedRequests = [];
    foreach ($allRequests as $request) {
        $key = $request['nama_peminta'] . '|' . $request['tanggal_request'];
        
        if (!isset($groupedRequests[$key])) {
            $groupedRequests[$key] = [
                'nama_peminta' => $request['nama_peminta'],
                'tanggal_request' => $request['tanggal_request'],
                'status' => $request['status'],
                'items' => [],
            ];
        }
        
        $groupedRequests[$key]['items'][] = [
            'nama_barang' => $request['nama_barang'],
            'jumlah' => $request['jumlah']
        ];
    }

    $data['requests'] = $groupedRequests;
    return view('inventaris/manage_requests', $data);
}


    public function request_details($nama_peminta, $tanggal_request)
    {
        $data['items'] = $this->requestModel->getRequestItems($nama_peminta, $tanggal_request);
        return view('inventaris/request_details', $data);
    }



// public function update_request_status($user_id, $tanggal_request_encoded)
// {
//     $tanggal_request = urldecode($tanggal_request_encoded);
//     $status = $this->request->getPost('status');

//     // Update all requests with the same user and request date
//     $requests = $this->requestModel->where('user_id', $user_id)
//                                    ->where('tanggal_request', $tanggal_request)
//                                    ->findAll();

//     if (!$requests) {
//         return redirect()->to('/inventaris/manage_requests')->with('error', 'Request not found.');
//     }

//     foreach ($requests as $request) {
//         if ($status === 'Accepted') {
//             $inventarisModel = new PersediaanInventarisModel();
//             $item = $inventarisModel->find($request['id_barang']);

//             if ($item && $item['jumlah'] >= $request['jumlah']) {
//                 $newStock = $item['jumlah'] - $request['jumlah'];
//                 $inventarisModel->update($request['id_barang'], ['jumlah' => $newStock]);

//                 // Insert transaction history
//                 $transactionData = [
//                     'id_barang' => $request['id_barang'],
//                     'id_user' => $request['user_id'],
//                     'nama_peminta' => $request['nama_peminta'],
//                     'tipe_transaksi' => 'Request Accepted',
//                     'jumlah' => $request['jumlah'],
//                     'tanggal_transaksi' => date('Y-m-d H:i:s'),
//                     'keterangan' => 'Request approved and stock updated'
//                 ];
//                 $this->transactionModel->insert($transactionData);
//             } else {
//                 return redirect()->to('/inventaris/manage_requests')->with('error', 'Insufficient stock.');
//             }
//         }

//         // Update all requests with the same user and request date
//         $this->requestModel->update($request['id'], ['status' => $status]);
//     }

//     return redirect()->to('/inventaris/manage_requests')->with('success', 'Request status updated.');
// }

public function update_request_status($nama_peminta, $tanggal_request)
    {
        $nama_peminta = urldecode($nama_peminta);
        $tanggal_request = urldecode($tanggal_request);

        if ($this->request->getMethod() === 'post') {
            $new_status = $this->request->getPost('status');

            // Fetch all requested items for the given requester and date
            $requests = $this->requestModel
                ->where('nama_peminta', $nama_peminta)
                ->where('tanggal_request', $tanggal_request)
                ->findAll();

            if (!$requests) {
                return redirect()->to('/inventaris/manage_requests')->with('error', 'No matching request found.');
            }

            // Update status for all items in the request
            foreach ($requests as $request) {
                $this->requestModel->update($request['id'], ['status' => $new_status]);

                // If accepted, reduce stock and log transaction & history
                if ($new_status === 'Accepted') {
                    $item = $this->inventarisModel->find($request['id_barang']);

                    if ($item && $item['jumlah'] >= $request['jumlah']) {
                        // Reduce stock
                        $new_stock = $item['jumlah'] - $request['jumlah'];
                        $this->inventarisModel->update($item['id_barang'], ['jumlah' => $new_stock]);

                        // Log transaction history
                        $transactionData = [
                            'id_barang' => $request['id_barang'],
                            'jumlah' => $request['jumlah'],
                            'tanggal' => date('Y-m-d H:i:s'),
                            'jenis' => 'Request Accepted',
                            'user_id' => $request['user_id']
                        ];
                        $this->transactionModel->insert($transactionData);

                        // Log item history
                        $historyData = [
                            'id_barang' => $request['id_barang'],
                            'jumlah' => $request['jumlah'],
                            'tanggal' => date('Y-m-d H:i:s'),
                            'tipe' => 'Request Approved',
                            'user_id' => $request['user_id']
                        ];
                        $this->historyModel->insert($historyData);
                    } else {
                        return redirect()->to('/inventaris/manage_requests')->with('error', 'Insufficient stock for ' . $item['nama_barang']);
                    }
                }
            }

            return redirect()->to('/inventaris/manage_requests')->with('success', 'Request status updated successfully.');
        }

        return redirect()->to('/inventaris/manage_requests')->with('error', 'Invalid request.');
    }


public function user_request_items()
    {
        if ($this->request->getMethod() === 'post') {
            $user_id = session()->get('user_id');
            $nama_peminta = $this->request->getPost('nama_peminta');
            $items = $this->request->getPost('items');
            
            $requestData = [
                'user_id' => $user_id,
                'nama_peminta' => $nama_peminta,
                'status' => 'Sent',
                'tanggal_request' => date('Y-m-d H:i:s'),
            ];
            
            $request_id = $this->requestModel->insertRequest($requestData, $items);
            
            return redirect()->to('/inventaris/user_request_items')->with('success', 'Request submitted successfully');
        }
        $data['inventaris'] = $this->inventarisModel->findAll();
        return view('inventaris/user_request_items', $data);
    }

    public function submit_request()
    {
        if ($this->request->getMethod() === 'post') {
            $user_id = session()->get('user_id');
            $nama_peminta = $this->request->getPost('nama_peminta');
            $items = $this->request->getPost('items');
    
            foreach ($items as $item) {
                // Check if this request already exists (same name, same date)
                $existingRequest = $this->requestModel
                    ->where('nama_peminta', $nama_peminta)
                    ->where('tanggal_request', date('Y-m-d'))
                    ->first();
    
                if ($existingRequest) {
                    // Update the existing request (insert new items)
                    $this->requestModel->insert([
                        'user_id' => $user_id,
                        'nama_peminta' => $nama_peminta,
                        'id_barang' => $item['id_barang'],
                        'jumlah' => $item['jumlah'],
                        'status' => 'Sent',
                        'tanggal_request' => date('Y-m-d H:i:s'),
                    ]);
                } else {
                    // Create a new request
                    $this->requestModel->insert([
                        'user_id' => $user_id,
                        'nama_peminta' => $nama_peminta,
                        'id_barang' => $item['id_barang'],
                        'jumlah' => $item['jumlah'],
                        'status' => 'Sent',
                        'tanggal_request' => date('Y-m-d H:i:s'),
                    ]);
                }
            }
    
            return redirect()->to('/inventaris/user_request_items')->with('success', 'Request submitted successfully');
        }
    
        return redirect()->to('/inventaris/user_request_items')->with('error', 'Invalid request');
    }
    