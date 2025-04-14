<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PurchaseRequests extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_request'       => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'user_id'          => ['type' => 'INT', 'unsigned' => true],
            'nama_peminta'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'tanggal_request'  => ['type' => 'DATETIME'],
            'status'           => [
                'type'       => 'ENUM',
                'constraint' => ['diproses', 'disetujui', 'ditolak'],
                'default'    => 'diproses'
            ],
        ]);

        $this->forge->addKey('id_request', true);
        $this->forge->createTable('purchase_requests');
    }

    public function down()
    {
        $this->forge->dropTable('purchase_requests');
    }
}
