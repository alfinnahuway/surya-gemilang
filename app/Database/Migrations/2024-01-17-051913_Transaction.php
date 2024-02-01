<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaction extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'invoice' => [
                'type'           => 'CHAR',
                'constraint'     => '12',
            ],
            'customer_id' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'total' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'discount' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'sub_total' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'cash' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'change' => [
                'type'           => 'INT',
                'constraint'     => '11',
            ],
            'note' => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
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
        $this->forge->addKey('invoice', true);
        $this->forge->createTable('transaction');
    }

    public function down()
    {
        $this->forge->dropTable('transaction');
    }
}
