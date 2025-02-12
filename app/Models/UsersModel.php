<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    
    // Define which fields can be modified through the model
    protected $allowedFields = [
        'full_name', 'no_telepon', 'email', 'alamat', 'jabatan',
        'golongan_pegawai', 'is_wi', 'nip', 'id_atasan', 'status_pegawai',
        'instansi', 'ip_address', 'username', 'password', 'password_text',
        'profile_img', 'salt', 'activation_code', 'forgotten_password_code',
        'forgotten_password_time', 'remember_code', 'last_login',
        'is_deleted', 'active'
    ];

    // // By default, timestamps are enabled in CodeIgniter 4
    // protected $useTimestamps = false;

    // // Define the default values for certain fields
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = ['setDefaults'];

    // // Helper method to set default values before insert
    // protected function setDefaults(array $data)
    // {
    //     if (!isset($data['data']['is_deleted'])) {
    //         $data['data']['is_deleted'] = 0;
    //     }
    //     if (!isset($data['data']['active'])) {
    //         $data['data']['active'] = 1;
    //     }
    //     return $data;
    // }

    // // Example method to get active users
    // public function getActiveUsers()
    // {
    //     return $this->where('active', 1)
    //                 ->where('is_deleted', 0)
    //                 ->findAll();
    // }
}