<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('jabatan') !== 'Admin') {
            // Redirect ke halaman login jika belum login atau bukan admin
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman yang ingin anda akses silahkan login sebagai admin jika ingin mengakses halaman tersebut !');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
