<?php

namespace App\Controllers;

use App\Models\TransaksiInventarisModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    public function cetak()
{
    $model = new \App\Models\TransaksiInventarisModel();

    $type = $this->request->getGet('type'); // masuk, keluar, atau kosong
    $dateFrom = $this->request->getGet('date_from');
    $dateTo = $this->request->getGet('date_to');

    $query = $model->select('transaksi.*, persediaan.nama_barang, users.full_name')
        ->join('persediaan', 'persediaan.id_barang = transaksi.id_barang')
        ->join('users', 'users.id = transaksi.id_user');

    if ($type) {
        $query->where('tipe_transaksi', $type);
    }

    if ($dateFrom) {
        $query->where('tanggal_transaksi >=', $dateFrom);
    }

    if ($dateTo) {
        $query->where('tanggal_transaksi <=', $dateTo);
    }

    $transactions = $query->findAll();

    // Generate HTML view
    $html = view('laporan/cetak', ['transactions' => $transactions]);

    // Dompdf setup
    $options = new \Dompdf\Options();
    $options->set('isRemoteEnabled', true);

    $dompdf = new \Dompdf\Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Output PDF in browser
    $dompdf->stream('laporan_transaksi.pdf', ['Attachment' => false]);
}
}
