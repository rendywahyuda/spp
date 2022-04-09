<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SppTahun extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_spp_tahun'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'id_tahun_pelajaran'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'tingkat'          => [
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

        $this->forge->addKey('id_spp_tahun', TRUE);
        // $this->forge->addForeignKey('id_tahun_pelajaran', 'tahun_pelajaran', 'id_tahun_pelajaran', 'CASCADE', 'CASCADE');
        $this->forge->createTable('spp_tahun');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('spp_tahun', 'spp_tahun_id_tahun_pelajaran_foreign');
        $this->forge->dropTable('spp_tahun');
    }
}
