<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengguna extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengguna'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'id_relasi'       => [
                'type'           => 'BIGINT',
                'constraint'     => '100',
                'NULL'             => TRUE
            ],
            'username'    => [
                'type' => 'BIGINT',
                'constraint'    => '100'
            ],
            'role'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '15',
            ],
            'password'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'updated_at'       => [
                'type'           => 'DATETIME'
            ],
            'created_at'       => [
                'type'           => 'DATETIME'
            ],

        ]);
        $this->forge->addKey('id_pengguna', TRUE);
        $this->forge->createTable('pengguna');
    }

    public function down()
    {
        $this->forge->dropTable('pengguna');
    }
}
