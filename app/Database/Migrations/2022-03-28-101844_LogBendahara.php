<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogBendahara extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_log_bendahara'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'nip_lama'       => [
                'type'           => 'BIGINT',
                'constraint'     => '10',
            ],
            'nip_baru'       => [
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
            'no_telepon_lama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'no_telepon_baru'       => [
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
        $this->forge->addKey('id_log_bendahara', TRUE);
        $this->forge->createTable('log_bendahara');

        $this->db->query("CREATE TRIGGER `insert_bendahara` AFTER INSERT ON `bendahara` 
        FOR EACH ROW INSERT INTO log_bendahara 
        VALUES(null, '', new.nip, '', new.nama, '', new.no_telepon, 'Admin', 'Inserted', NOW());");

        $this->db->query("CREATE TRIGGER `update_bendahara` AFTER UPDATE ON `bendahara` 
        FOR EACH ROW INSERT INTO log_bendahara 
        VALUES(null, old.nip, new.nip, old.nama, new.nama, old.no_telepon, new.no_telepon, 'Bendahara', 'Updated', NOW());");

        $this->db->query("CREATE TRIGGER `delete_bendahara` AFTER DELETE ON `bendahara` 
        FOR EACH ROW INSERT INTO log_bendahara 
        VALUES(null, old.nip, '', old.nama, '', old.no_telepon, '', 'Admin', 'Deleted', NOW());");
    }

    public function down()
    {
        $this->db->query("DROP TRIGGER IF EXISTS `insert_bendahara`");
        $this->db->query("DROP TRIGGER IF EXISTS `update_bendahara`");
        $this->db->query("DROP TRIGGER IF EXISTS `delete_bendahara`");
        $this->forge->dropTable('log_bendahara');
    }
}
