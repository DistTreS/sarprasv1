<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password', 'role'];

    /**
     * Fungsi untuk mendapatkan user berdasarkan username
     */

    public function getUserByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Fungsi untuk memverifikasi password
     */
    public function verifyPassword($inputPassword, $storedPassword)
    {
        // Gunakan password_hash dan password_verify jika password terenkripsi
        return password_verify($inputPassword, $storedPassword);
    }

    /**
     * Fungsi untuk mendapatkan role user berdasarkan jabatan
     */
    public function getRole($role)
    {
        return ($role);
    }
}
