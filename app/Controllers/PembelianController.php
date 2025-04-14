<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PurchaseRequestsModel;
use App\Models\PurchaseRequestDetailsModel;
use App\Models\PersediaanInventarisModel;
use App\Models\UsersModel;

class PembelianController extends BaseController
{
    protected $purchaseRequestsModel;
    protected $PurchaseRequestDetailsModel;
    protected $inventarisModel;
    protected $usersModel;

    public function __construct()
    {
        $this->purchaseRequestsModel = new PurchaseRequestsModel();
        $this->purchaseDetailsModel = new PurchaseRequestDetailsModel();
        $this->inventarisModel = new PersediaanInventarisModel();
        $this->usersModel = new UsersModel();
    }

    // Tampilkan form permintaan pembelian
    public function create()
    {
        $data['items'] = $this->inventarisModel->findAll();
        $data['users'] = $this->usersModel->findAll();

        return view('pembelian/form_pembelian', $data);
    }

    // Simpan permintaan pembelian
    public function store()
    {
        $postData = $this->request->getPost();

        if (!isset($postData['items']) || empty($postData['items'])) {
            return redirect()->back()->with('error', 'Tidak ada barang yang dipilih.');
        }

        $userId = session()->get('user_id') ?? null;
        $namaPeminta = $postData['nama_peminta'] ?? session()->get('username') ?? 'Guest';

        $requestData = [
            'user_id' => $userId,
            'nama_peminta' => $namaPeminta,
            'tanggal_request' => date('Y-m-d H:i:s'),
            'status' => 'diproses'
        ];

        $requestId = $this->purchaseRequestsModel->insert($requestData);

        foreach ($postData['items'] as $item) {
            if ($item['jumlah'] > 0) {
                $detailData = [
                    'id_request' => $requestId,
                    'id_barang' => $item['id_barang'],
                    'jumlah' => $item['jumlah']
                ];
                $this->purchaseDetailsModel->insert($detailData);
            }
        }

        return redirect()->to('/pembelian/daftar')->with('success', 'Permintaan pembelian berhasil dikirim.');
    }

    // Tampilkan daftar permintaan pembelian
    public function daftar()
    {
        $requests = $this->purchaseRequestsModel->findAll();

        foreach ($requests as &$request) {
            $request['details'] = $this->purchaseDetailsModel
                ->select('purchase_request_details.*, persediaan.nama_barang')
                ->join('persediaan', 'persediaan.id_barang = purchase_request_details.id_barang')
                ->where('id_request', $request['id_request'])
                ->findAll();
        }

        return view('pembelian/daftar_pembelian', ['requests' => $requests]);
    }

    // Update status permintaan pembelian
    public function update_status($requestId)
    {
        if ($this->request->getMethod() === 'post') {
            $newStatus = $this->request->getPost('status');

            if (!in_array($newStatus, ['diproses', 'diterima', 'ditolak'])) {
                return $this->response->setJSON(['success' => false, 'message' => 'Status tidak valid!']);
            }

            $requestData = $this->purchaseRequestsModel->find($requestId);
            if (!$requestData) {
                return $this->response->setJSON(['success' => false, 'message' => 'Request tidak ditemukan!']);
            }

            $updateData = ['status' => $newStatus];


            if ($this->purchaseRequestsModel->update($requestId, $updateData)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Status berhasil diperbarui!']);
            }

            return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui status!']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Metode tidak diizinkan!']);
    }
}
