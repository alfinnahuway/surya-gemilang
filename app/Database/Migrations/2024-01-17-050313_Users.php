<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'unique'         => true,
            ],
            'username' => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'unique'         => true,
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'image' => [
                'type'           => 'VARCHAR',
                'constraint'     => '150',
                'null'           => true
            ],
            'role' => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
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
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
