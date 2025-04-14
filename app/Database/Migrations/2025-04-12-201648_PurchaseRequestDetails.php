<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PurchaseRequestDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detail'  => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'id_request' => ['type' => 'INT', 'unsigned' => true],
            'id_barang'  => ['type' => 'INT', 'unsigned' => true],
            'jumlah'     => ['type' => 'INT'],
        ]);

        $this->forge->addKey('id_detail', true);

        // Tambahkan foreign key jika database mendukung
        $this->forge->addForeignKey('id_request', 'purchase_requests', 'id_request', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang', 'persediaan', 'id_barang', 'CASCADE', 'CASCADE');

        $this->forge->createTable('purchase_request_details');
    }

    public function down()
    {
        $this->forge->dropTable('purchase_request_details');
    }
}
