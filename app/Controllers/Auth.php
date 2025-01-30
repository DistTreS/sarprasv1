<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        return view('pages/login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Proses autentikasi (dummy check untuk saat ini)
        if ($username === 'admin' && $password === '1234') {
            return redirect()->to('/dashboard');
        } else {
            return redirect()->to('/login')->with('error', 'Invalid username or password');
        }
    }
}
