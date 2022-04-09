<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailBiaya extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detail_biaya'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'id_biaya_spp'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'tahun_pelajaran'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'tingkat'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],

        ]);
        $this->forge->addKey('id_detail_biaya', TRUE);
        // $this->forge->addForeignKey('id_biaya_spp', 'biaya_spp', 'id_biaya_spp', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detail_biaya');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('detail_biaya', 'detail_biaya_id_biaya_spp_foreign');
        $this->forge->dropTable('detail_biaya');
    }
}
