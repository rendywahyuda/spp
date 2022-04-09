<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kelas'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'kelas'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'tingkat'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '5',
            ]
        ]);
        $this->forge->addKey('id_kelas', TRUE);
        $this->forge->createTable('kelas');
    }

    public function down()
    {
        $this->forge->dropTable('kelas');
    }
}
