<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogTahunPelajaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_log_tahun_pelajaran'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'tahun_pelajaran_lama'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '10'
            ],
            'tahun_pelajaran_baru'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '10'
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
            ]

        ]);
        $this->forge->addKey('id_log_tahun_pelajaran', TRUE);
        $this->forge->createTable('log_tahun_pelajaran');

        $this->db->query("CREATE TRIGGER `insert_tahun_pelajaran` AFTER INSERT ON `tahun_pelajaran` 
        FOR EACH ROW INSERT INTO log_tahun_pelajaran 
        VALUES(null, '', new.tahun_pelajaran, 'Admin', 'Inserted', NOW());");

        $this->db->query("CREATE TRIGGER `update_tahun_pelajaran` AFTER UPDATE ON `tahun_pelajaran` 
        FOR EACH ROW INSERT INTO log_tahun_pelajaran 
        VALUES(null, old.tahun_pelajaran, new.tahun_pelajaran, 'Admin', 'Updated', NOW());");

        $this->db->query("CREATE TRIGGER `delete_tahun_pelajaran` AFTER DELETE ON `tahun_pelajaran` 
        FOR EACH ROW INSERT INTO log_tahun_pelajaran 
        VALUES(null, old.tahun_pelajaran, '', 'Admin', 'Deleted', NOW());");
    }

    public function down()
    {
        $this->db->query("DROP TRIGGER IF EXISTS `insert_tahun_pelajaran`");
        $this->db->query("DROP TRIGGER IF EXISTS `update_tahun_pelajaran`");
        $this->db->query("DROP TRIGGER IF EXISTS `delete_tahun_pelajaran`");
        $this->forge->dropTable('log_tahun_pelajaran');
    }
}
