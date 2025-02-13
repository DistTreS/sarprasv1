<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PegawaiFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        if (session()->get('jabatan') === 'Admin') {
            return redirect()->to('/login')->with('error', 'Halaman yang coba anda akses adalah halaman untuk pegawai silahkan login sebagai pegawai jika ingin mengakses halaman tersebut !');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
     
    }
}
