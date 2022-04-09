<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin'          => [
                'type'           => 'INT',
                'constraint'     => '5',
            ],
            'id_pengguna'       => [
                'type'           => 'INT',
                'constraint'     => '5',
                'unsigned'       => TRUE,
            ],
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'nip'       => [
                'type'           => 'BIGINT',
                'constraint'     => '15',
            ],
            'profile'    => [
                'type' => 'VARCHAR',
                'constraint'    => '100'
            ],
            'updated_at'       => [
                'type'           => 'DATETIME'
            ],
            'created_at'       => [
                'type'           => 'DATETIME'
            ],

        ]);
        $this->forge->addKey('id_admin', TRUE);
        // $this->forge->addForeignKey('id_pengguna', 'pengguna', 'id_pengguna', 'CASCADE', 'CASCADE');
        $this->forge->createTable('admin');

        $dataPengguna = [
            [
                'id_relasi' => 1,
                'username' =>  '123456',
                'role'  => 'admin',
                'password'    => password_hash('admin123', PASSWORD_BCRYPT),
                'created_at'  => Time::now()
            ]
        ];
        $this->db->table('pengguna')->insertBatch($dataPengguna);

        $dataAdmin = [
            [
                'id_admin' => 1,
                'id_pengguna' => 1,
                'nama'        => 'Admin',
                'profile'     => 'default_profile.png',
                'nip'         => '123456',
                'created_at'  => Time::now()
            ],
        ];
        $this->db->table('admin')->insertBatch($dataAdmin);
    }

    public function down()
    {
        // $this->forge->dropForeignKey('admin', 'admin_id_pengguna_foreign');
        $this->forge->dropTable('admin');
    }
}
