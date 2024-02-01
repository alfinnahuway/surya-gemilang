<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransactionProduct extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'transaction_invoice' => [
                'type'           => 'CHAR',
                'constraint'     => '12',
            ],
            'items_barcode' => [
                'type'           => 'CHAR',
                'constraint'     => '8',
            ],
            'qty_product' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'created_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
        ]);
        $this->forge->addKey('transaction_invoice', false);
        $this->forge->createTable('transaction_product');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_product');
    }
}
