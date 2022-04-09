<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TahunPelajaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tahun_pelajaran'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'tahun_pelajaran'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '10'
            ],


        ]);
        $this->forge->addKey('id_tahun_pelajaran', TRUE);
        $this->forge->createTable('tahun_pelajaran');
    }

    public function down()
    {
        $this->forge->dropTable('tahun_pelajaran');
    }
}
