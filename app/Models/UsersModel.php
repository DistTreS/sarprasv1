<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{

    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'full_name',
        'no_telepon',
        'email',
        'alamat',
        'jabatan',
        'golongan_pegawai',
        'is_wi',
        'nip',
        'id_atasan',
        'status_pegawai',
        'instansi',
        'ip_address',
        'username',
        'password',
        'password_text',
        'profile_img',
        'salt',
        'activation_code',
        'forgotten_password_code',
        'forgotten_password_time',
        'remember_code',
        'last_login',
        'is_deleted',
        'active',
        'is_banned',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';

    
    public function getAvailableUsers()
    {
        // Query untuk mengambil data pengguna yang tersedia (misalnya, status = 'active')
        return $this->select('id, full_name')
                    ->findAll();
    }
}
