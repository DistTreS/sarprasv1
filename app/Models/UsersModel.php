<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'full_name', 'no_telepon', 'email', 'alamat', 'jabatan',
        'nip', 'username', 'password', 'profile_img', 'role'
    ];
<<<<<<< HEAD
    
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    
    public function getAvailableUsers()
    {
        // Query untuk mengambil data pengguna yang tersedia (misalnya, status = 'active')
        return $this->select('id, full_name')
                    ->findAll();
    }
=======
>>>>>>> 5063b98eebe424c2a68201b97f651226b3ee5f0d
}
