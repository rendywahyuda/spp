<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogKelas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_log_kelas'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'kelas_lama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'kelas_baru'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'tingkat_lama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '5',
            ],
            'tingkat_baru'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '5',
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

        $this->forge->addKey('id_log_kelas', TRUE);
        $this->forge->createTable('log_kelas');

        $this->db->query("CREATE TRIGGER `insert_kelas` AFTER INSERT ON `kelas` \r\n
        FOR EACH ROW INSERT INTO log_kelas \r\n
        VALUES(null, '', new.kelas, '', new.tingkat, 'admin', 'Inserted', NOW());");

        $this->db->query("CREATE TRIGGER `update_kelas` AFTER UPDATE ON `kelas` \r\n
        FOR EACH ROW INSERT INTO log_kelas \r\n
        VALUES(null, old.kelas, new.kelas, old.tingkat, new.tingkat, 'Admin', 'Updated', NOW());");

        $this->db->query("CREATE TRIGGER `delete_kelas` AFTER DELETE ON `kelas` \r\n
        FOR EACH ROW INSERT INTO log_kelas \r\n
        VALUES(null, old.kelas, '', old.tingkat, '', 'Admin', 'Deleted', NOW());");
    }

    public function down()
    {
        $this->db->query("DROP TRIGGER IF EXISTS `insert_kelas`");
        $this->db->query("DROP TRIGGER IF EXISTS `update_kelas`");
        $this->db->query("DROP TRIGGER IF EXISTS `delete_kelas`");
        $this->forge->dropTable('log_kelas');
    }
}
