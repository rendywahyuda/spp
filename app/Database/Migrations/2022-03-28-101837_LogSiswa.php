<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_log_siswa'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'nis_lama'       => [
                'type'           => 'BIGINT',
                'constraint'     => '10',
            ],
            'nis_baru'       => [
                'type'           => 'BIGINT',
                'constraint'     => '10',
            ],
            'nama_lama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'nama_baru'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'jurusan_lama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'jurusan_baru'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'pengguna'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'status'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'waktu'       => [
                'type'           => 'DATETIME'
            ],

        ]);
        $this->forge->addKey('id_log_siswa', TRUE);
        $this->forge->createTable('log_siswa');

        $this->db->query("CREATE TRIGGER `insert_siswa` AFTER INSERT ON `siswa`
        FOR EACH ROW INSERT INTO log_siswa 
        VALUES(null, '', new.nis, '', new.nama, '', new.jurusan, 'Admin', 'Inserted', NOW());");

        $this->db->query("CREATE TRIGGER `update_siswa` AFTER UPDATE ON `siswa` 
        FOR EACH ROW INSERT INTO log_siswa 
        VALUES(null, old.nis, new.nis,  old.nama, new.nama, old.jurusan, new.jurusan, 'Siswa', 'Updated', NOW());");
    }

    public function down()
    {
        $this->db->query("DROP TRIGGER IF EXISTS `insert_siswa`");
        $this->db->query("DROP TRIGGER IF EXISTS `update_siswa`");
        $this->forge->dropTable('log_siswa');
    }
}
