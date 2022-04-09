<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SppAngkatan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_spp_angkatan'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'tahun'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20'
            ],
            'total_biaya'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            'total_tunggakan'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            'total_transfer'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
        ]);

        $this->forge->addKey('id_spp_angkatan', TRUE);
        $this->forge->createTable('spp_angkatan');
    }

    public function down()
    {
        $this->forge->dropTable('spp_angkatan');
    }
}
