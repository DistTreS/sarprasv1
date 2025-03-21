<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MultiAdminBarangFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $allowedRoles = [
            'Admin Utama',
            'Admin Barang',
            'Admin Peminjaman dan Barang',
            'Admin Barang dan Diklat'
        ];

        if (!$session->get('isLoggedIn') || !in_array($session->get('role'), $allowedRoles)) {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu ada perubahan setelah request selesai
    }
}
