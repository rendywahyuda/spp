<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BiayaSpp extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_biaya_spp'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'kode'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '20',
            ],
            'total'       => [
                'type'           => 'BIGINT',
                'constraint'     => '100',
            ],
            'seragam'       => [
                'type'           => 'BIGINT',
                'constraint'     => '100',
            ],
            'uang_bangunan'       => [
                'type'           => 'BIGINT',
                'constraint'     => '100',
            ],
            'spp_bulanan'       => [
                'type'           => 'BIGINT',
                'constraint'     => '100',
            ],
            'prakerin'       => [
                'type'           => 'BIGINT',
                'constraint'     => '100',
            ],
            'ujikom'       => [
                'type'           => 'BIGINT',
                'constraint'     => '100',
            ],
        ]);
        $this->forge->addKey('id_biaya_spp', TRUE);
        $this->forge->createTable('biaya_spp');
    }

    public function down()
    {
        $this->forge->dropTable('biaya_spp');
    }
}
