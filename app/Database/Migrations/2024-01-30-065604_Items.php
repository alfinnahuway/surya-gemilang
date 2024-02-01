<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Items extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'barcode' => [
                'type'           => 'CHAR',
                'constraint'     => '8',
                'unique'         => true,
            ],
            'product' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'category_id' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'unit_id' => [
                'type'           => 'INT',
                'constraint'     => '5',
            ],
            'supplier_id' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'stock' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'product_image' => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => true
            ],
            'price' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'description' => [
                'type'           => 'TEXT',
                'null'           => true,
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
        $this->forge->addKey('barcode', true);
        $this->forge->createTable('items');
    }

    public function down()
    {
        $this->forge->dropTable('items');
    }
}
