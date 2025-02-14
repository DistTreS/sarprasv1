<?php
namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $allowedFields = [
        'id_user',
        'id_aset',
        'nama_aset',
        'jumlah',
        'cc',
        'telepon',
        'keterangan',
        'tanggal_pengajuan',
        'tanggal_rencana_pengembalian',
        'tanggal_pengembalian',
        'bukti_pengembalian',
        'status_layanan',
        'status_peminjaman'
    ];

    // Fungsi untuk menambahkan pengajuan peminjaman
    public function tambahPengajuan($data)
    {
        $data['tanggal_pengajuan'] = date('Y-m-d'); // Otomatis isi tanggal pengajuan
        $data['status_layanan'] = 'Pengajuan';
        $data['status_peminjaman'] = 'Belum Disetujui';
        return $this->insert($data);
    }

    // Fungsi untuk memperbarui status layanan oleh admin
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status_layanan' => $status]);
    }

    // Fungsi untuk menyetujui peminjaman
    public function setujuiPeminjaman($id)
    {
        return $this->update($id, [
            'status_layanan' => 'Proses',
            'status_peminjaman' => 'Disetujui'
        ]);
    }

    // Fungsi untuk mengubah status ke selesai setelah user mengembalikan aset
    public function selesaikanPeminjaman($id, $bukti)
    {
        return $this->update($id, [
            'status_layanan' => 'Selesai',
            'tanggal_pengembalian' => date('Y-m-d'),
            'bukti_pengembalian' => $bukti
        ]);
    }
}
