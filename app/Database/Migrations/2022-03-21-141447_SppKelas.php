<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SppKelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_spp_kelas'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'id_kelas'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'tahun_pelajaran'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20'
            ],
            'biaya_pertahun'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
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

        $this->forge->addKey('id_spp_kelas', TRUE);
        // $this->forge->addForeignKey('id_kelas', 'kelas', 'id_kelas', 'CASCADE', 'CASCADE');
        $this->forge->createTable('spp_kelas');
    }

    public function down()
    {
        $this->forge->dropForeignKey('spp_kelas', 'spp_kelas_id_kelas_foreign');
        $this->forge->dropTable('spp_kelas');
    }
}
