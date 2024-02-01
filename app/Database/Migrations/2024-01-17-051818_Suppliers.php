<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suppliers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'supplier_company' => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
            ],
            'phone' => [
                'type'           => 'CHAR',
                'constraint'     => '13',
            ],
            'address' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'description' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true
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
        $this->forge->addKey('id', true);
        $this->forge->createTable('suppliers');
    }

    public function down()
    {
        $this->forge->dropTable('suppliers');
    }
}
