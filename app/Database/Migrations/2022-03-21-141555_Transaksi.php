<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'id_siswa'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE
            ],
            'id_spp'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE
            ],
            'id_tunggakan'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE
            ],
            'id_bendahara'          => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE
            ],
            'nama_siswa'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
            ],
            'kelas'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'spp_bulan'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'tahun_pelajaran'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'nominal_bayar'          => [
                'type'           => 'INT',
                'constraint'     => '100',
            ],
            'jenis_spp'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'jenis_pembayaran'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'bukti_pembayaran'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100'
            ],
            'status'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '100'
            ],
            'notes'          => [
                'type'          => 'TEXT',
                'NULL'             => TRUE
            ],
            'updated_at'           => [
                'type'          => 'DATETIME'
            ],
            'created_at'           => [
                'type'          => 'DATETIME'
            ],


        ]);
        $this->forge->addKey('id_transaksi', TRUE);
        // $this->forge->addForeignKey('id_siswa', 'siswa', 'id_siswa', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_spp', 'spp', 'id_spp', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_tunggakan', 'tunggakan', 'id_tunggakan', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('id_bendahara', 'bendahara', 'id_bendahara', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        // $this->forge->dropForeignKey('transaksi', 'transaksi_id_siswa_foreign');
        // $this->forge->dropForeignKey('transaksi', 'transaksi_id_spp_foreign');
        // $this->forge->dropForeignKey('transaksi', 'transaksi_id_tunggakan_foreign');
        // $this->forge->dropForeignKey('transaksi', 'transaksi_id_bendahara_foreign');
        $this->forge->dropTable('transaksi');
    }
}
