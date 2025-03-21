<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
        helper(['url', 'form', 'session']);
    }

    /**
     * Menampilkan halaman login
     */
    public function login()
    {
        return view('pages/login');
    }

    /**
     * Proses login user
     */
    public function loginProcess()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan username
        $user = $this->authModel->getUserByUsername($username);

        if ($user) {
            // Verifikasi password
            if ($this->authModel->verifyPassword($password, $user['password'])) {
                // Set session user
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ]);

                // Redirect berdasarkan role
                $role = $this->authModel->getRole($user['role']);
                if ($role === 'Pegawai') {
                    return redirect()->to('/dashboard/pegawai');
                } else {
                    return redirect()->to('/dashboard');
                }
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->back()->withInput();
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Proses logout user
     */
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
