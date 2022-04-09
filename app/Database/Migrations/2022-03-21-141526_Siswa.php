<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_siswa'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'id_pengguna'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'id_tahun_pelajaran'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'id_kelas'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'id_spp_angkatan'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'angkatan'       => [
                'type'           => 'INT',
                'constraint'     => '5',
            ],
            'nis'       => [
                'type'           => 'BIGINT',
                'constraint'     => '10',
            ],
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'jurusan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'profile'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'total_tunggakan'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            'total_biaya'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            'total_transfer'       => [
                'type'           => 'INT',
                'constraint'     => '20',
                'NULL'             => TRUE
            ],
            'updated_at'       => [
                'type'           => 'DATETIME'
            ],
            'created_at'       => [
                'type'           => 'DATETIME'
            ],

        ]);
        $this->forge->addKey('id_siswa', TRUE);
        // $this->forge->addForeignKey('id_kelas', 'kelas', 'id_kelas', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_pengguna', 'pengguna', 'id_pengguna', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_tahun_pelajaran', 'tahun_pelajaran', 'id_tahun_pelajaran', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_spp_angkatan', 'spp_angkatan', 'id_spp_angkatan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('siswa');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('siswa', 'siswa_id_kelas_foreign');
        // $this->forge->dropForeignKey('siswa', 'siswa_id_pengguna_foreign');
        // $this->forge->dropForeignKey('siswa', 'siswa_id_tahun_pelajaran_foreign');
        // $this->forge->dropForeignKey('siswa', 'siswa_id_spp_angkatan_foreign');
        $this->forge->dropTable('siswa');
    }
}
