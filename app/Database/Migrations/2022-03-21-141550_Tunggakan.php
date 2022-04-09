<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tunggakan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tunggakan'          => [
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
            'tunggakan'       => [
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

        $this->forge->addKey('id_tunggakan', TRUE);
        // $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_biaya_spp', 'biaya_spp', 'id_biaya_spp', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tunggakan');

        $this->db->query("CREATE VIEW tunggakanSiswa AS
        SELECT siswa.id_siswa, nis, nama, jurusan, tingkat_kelas, tunggakan
        FROM siswa INNER JOIN tunggakan
        ON siswa.id_siswa = tunggakan.id_siswa;");
    }

    public function down()
    {
        // $this->forge->dropForeignKey('tunggakan', 'tunggakan_id_siswa_foreign');
        // $this->forge->dropForeignKey('tunggakan', 'tunggakan_id_biaya_spp_foreign');
        $this->db->query("DROP VIEW `tunggakanSiswa`");
        $this->forge->dropTable('tunggakan');
    }
}
