<?php

namespace App\Models;

use CodeIgniter\Model;

class AsetModel extends Model
{
    protected $table = 'aset';
    protected $primaryKey = 'id_aset';
    protected $allowedFields = ['id_kategori', 'status', 'kondisi', 'gambar'];

    // Validasi ENUM
    protected $validationRules = [
        'id_kategori' => 'required|integer',
        'status'      => 'required|in_list[Tersedia,Terpakai]',
        'kondisi'     => 'required|in_list[Baik,Perbaikan]',
        'gambar'      => 'permit_empty|uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
    ];

    protected $validationMessages = [
        'status'  => ['in_list' => 'Status hanya boleh "Tersedia" atau "Terpakai".'],
        'kondisi' => ['in_list' => 'Kondisi hanya boleh "Baik" atau "Perbaikan".'],
        'gambar'  => [
            'uploaded'  => 'Gambar wajib diunggah.',
            'max_size'  => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'is_image'  => 'File harus berupa gambar.',
            'mime_in'   => 'Format gambar harus JPG, JPEG, atau PNG.',
        ],
    ];
}
