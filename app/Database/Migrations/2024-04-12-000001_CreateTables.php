<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // Tabel Users
        $this->forge->addField([
            'id'                     => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'full_name'              => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_telepon'             => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'email'                  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'alamat'                 => ['type' => 'TEXT', 'null' => true],
            'jabatan'                => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'golongan_pegawai'       => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'is_wi'                  => ['type' => 'BOOLEAN', 'default' => false],
            'nip'                    => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'id_atasan'              => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'status_pegawai'         => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'instansi'               => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'ip_address'             => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => true],
            'username'               => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password'               => ['type' => 'VARCHAR', 'constraint' => 255],
            'password_text'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'profile_img'            => ['type' => 'TEXT', 'null' => true],
            'salt'                   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'activation_code'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'forgotten_password_code'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'forgotten_password_time'=> ['type' => 'DATETIME', 'null' => true],
            'remember_code'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'last_login'             => ['type' => 'DATETIME', 'null' => true],
            'is_deleted'             => ['type' => 'BOOLEAN', 'default' => false],
            'active'                 => ['type' => 'BOOLEAN', 'default' => true],
            'is_banned'              => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'             => ['type' => 'DATETIME', 'null' => true],
            'created_by'             => ['type' => 'INT', 'unsigned' => true, 'null' => true],
            'updated_at'             => ['type' => 'DATETIME', 'null' => true],
            'updated_by'             => ['type' => 'INT', 'unsigned' => true, 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');

        // Tabel Aset
        $this->forge->addField([
            'id_aset'     => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_kategori' => ['type' => 'INT', 'unsigned' => true],
            'status'      => ['type' => 'VARCHAR', 'constraint' => 50],
            'kondisi'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'gambar'      => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id_aset', true);
        $this->forge->createTable('aset');

        // Tabel Aset Rusak
        $this->forge->addField([
            'id_rusak'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_aset'          => ['type' => 'INT', 'unsigned' => true],
            'id_user'          => ['type' => 'INT', 'unsigned' => true],
            'tanggal_rusak'    => ['type' => 'DATE'],
            'status_pengajuan' => ['type' => 'VARCHAR', 'constraint' => 50],
            'keterangan'       => ['type' => 'TEXT', 'null' => true],
            'bukti_foto'       => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id_rusak', true);
        $this->forge->createTable('aset_rusak');

        // Tabel Item Requests
        $this->forge->addField([
            'id_request'       => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'user_id'          => ['type' => 'INT', 'unsigned' => true],
            'nama_peminta'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'tanggal_request'  => ['type' => 'DATETIME'],
            'status'           => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id_request', true);
        $this->forge->createTable('item_requests');

        // Tabel Request Details
        $this->forge->addField([
            'id_detail'  => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_request' => ['type' => 'INT', 'unsigned' => true],
            'id_barang'  => ['type' => 'INT', 'unsigned' => true],
            'jumlah'     => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id_detail', true);
        $this->forge->createTable('request_details');

        // Tabel Jenis Diklat
        $this->forge->addField([
            'id_diklat'  => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nama_diklat'=> ['type' => 'VARCHAR', 'constraint' => 100],
            'deskripsi'  => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id_diklat', true);
        $this->forge->createTable('jenis_diklat');

        // Tabel Kategori Aset
        $this->forge->addField([
            'id_kategori'   => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'kode_kategori' => ['type' => 'VARCHAR', 'constraint' => 50],
            'nama_kategori' => ['type' => 'VARCHAR', 'constraint' => 100],
            'deskripsi'     => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('kategori_aset');

        // Tabel Peminjaman
        $this->forge->addField([
            'id_peminjaman'               => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'user_id'                     => ['type' => 'INT', 'unsigned' => true],
            'id_aset'                     => ['type' => 'INT', 'unsigned' => true],
            'nama_aset'                   => ['type' => 'VARCHAR', 'constraint' => 100],
            'jumlah'                      => ['type' => 'INT'],
            'cc'                          => ['type' => 'VARCHAR', 'constraint' => 100],
            'telepon'                     => ['type' => 'VARCHAR', 'constraint' => 50],
            'keterangan'                  => ['type' => 'TEXT', 'null' => true],
            'tanggal_pengajuan'          => ['type' => 'DATE'],
            'tanggal_rencana_pengembalian' => ['type' => 'DATE'],
            'tanggal_pengembalian'       => ['type' => 'DATE', 'null' => true],
            'bukti_pengembalian'         => ['type' => 'TEXT', 'null' => true],
            'status_layanan'             => ['type' => 'VARCHAR', 'constraint' => 50],
            'status_peminjaman'          => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id_peminjaman', true);
        $this->forge->createTable('peminjaman');

        // Tabel Persediaan
        $this->forge->addField([
            'id_barang'   => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nama_barang'=> ['type' => 'VARCHAR', 'constraint' => 100],
            'deskripsi'  => ['type' => 'TEXT', 'null' => true],
            'jumlah'     => ['type' => 'INT'],
            'satuan'     => ['type' => 'VARCHAR', 'constraint' => 50],
            'nilai'      => ['type' => 'DOUBLE'],
            'sisa'       => ['type' => 'INT'],
            'pakai'      => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id_barang', true);
        $this->forge->createTable('persediaan');

        // Tabel Peserta
        $this->forge->addField([
            'id_peserta'     => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nama'           => ['type' => 'VARCHAR', 'constraint' => 100],
            'nip'            => ['type' => 'VARCHAR', 'constraint' => 50],
            'tempat_lahir'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'tanggal_lahir'  => ['type' => 'DATE'],
            'golruang'       => ['type' => 'VARCHAR', 'constraint' => 20],
            'nama_jabatan'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'instansi'       => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('id_peserta', true);
        $this->forge->createTable('peserta');

        // Tabel Peserta Diklat
        $this->forge->addField([
            'id_peserta_diklat'  => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_peserta'         => ['type' => 'INT', 'unsigned' => true],
            'id_diklat'          => ['type' => 'INT', 'unsigned' => true],
            'angkatan'           => ['type' => 'INT'],
            'tahun'              => ['type' => 'YEAR'],
            'sertifikat'         => ['type' => 'TEXT', 'null' => true],
            'judul_tugas_akhir'  => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id_peserta_diklat', true);
        $this->forge->createTable('peserta_diklat');

        // Tabel Request History
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_request'        => ['type' => 'INT', 'unsigned' => true],
            'status'            => ['type' => 'VARCHAR', 'constraint' => 50],
            'tanggal_perubahan' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('request_history');

        // Tabel Riwayat Inventaris
        $this->forge->addField([
            'id_riwayat'         => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_barang'          => ['type' => 'INT', 'unsigned' => true],
            'id_transaksi'       => ['type' => 'INT', 'unsigned' => true],
            'tipe'               => ['type' => 'VARCHAR', 'constraint' => 50],
            'jumlah_sebelumnya' => ['type' => 'INT'],
            'jumlah_baru'       => ['type' => 'INT'],
            'tanggal_perubahan' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id_riwayat', true);
        $this->forge->createTable('riwayat_barang');

        // Tabel Transaksi
        $this->forge->addField([
            'id_transaksi'      => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_barang'         => ['type' => 'INT', 'unsigned' => true],
            'id_user'           => ['type' => 'INT', 'unsigned' => true],
            'nama_peminta'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'tipe_transaksi'    => ['type' => 'VARCHAR', 'constraint' => 50],
            'jumlah'            => ['type' => 'INT'],
            'tanggal_transaksi' => ['type' => 'DATE'],
            'keterangan'        => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id_transaksi', true);
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('users');
        $this->forge->dropTable('aset');
        $this->forge->dropTable('aset_rusak');
        $this->forge->dropTable('item_requests');
        $this->forge->dropTable('request_details');
        $this->forge->dropTable('jenis_diklat');
        $this->forge->dropTable('kategori_aset');
        $this->forge->dropTable('peminjaman');
        $this->forge->dropTable('persediaan');
        $this->forge->dropTable('peserta');
        $this->forge->dropTable('peserta_diklat');
        $this->forge->dropTable('request_history');
        $this->forge->dropTable('riwayat_barang');
        $this->forge->dropTable('transaksi');
    }
}
