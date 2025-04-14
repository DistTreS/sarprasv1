<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'administrator',
            'password' => password_hash('administrator1', PASSWORD_DEFAULT),
        ];

        // Masukkan data ke dalam tabel users
        $this->db->table('users')->insert($data);
    }
}
