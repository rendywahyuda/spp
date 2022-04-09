<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Spp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_spp'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'id_siswa'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'id_biaya_spp'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'tahun_pelajaran'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '20'
            ],
            'tingkat_kelas'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '5'
            ],
            'biaya'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            't_seragam'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            't_bulanan'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            't_bangunan'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            't_prakerin'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            't_ujikom'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
        ]);

        $this->forge->addKey('id_spp', TRUE);
        // $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_biaya_spp', 'biaya_spp', 'id_biaya_spp', 'CASCADE', 'CASCADE');
        $this->forge->createTable('spp');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('spp', 'spp_id_siswa_foreign');
        // $this->forge->dropForeignKey('spp', 'spp_id_biaya_spp_foreign');
        $this->forge->dropTable('spp');
    }
}
