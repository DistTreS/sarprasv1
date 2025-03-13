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
}
