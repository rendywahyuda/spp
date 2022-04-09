<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class Bendahara extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bendahara'          => [
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
            'nama'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'nip'       => [
                'type'           => 'BIGINT',
                'constraint'     => '15',
            ],
            'no_telepon'       => [
                'type'           => 'VARCHAR',
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
        $this->forge->addKey('id_bendahara', TRUE);
        // $this->forge->addForeignKey('id_pengguna', 'pengguna', 'id_pengguna', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bendahara');

        // $dataPengguna = [
        //     [
        //         'id_relasi' => 1,
        //         'username' =>  '190651111',
        //         'role'  => 'bendahara',
        //         'password'    => password_hash('rahma', PASSWORD_BCRYPT),
        //         'created_at'  => Time::now()
        //     ],
        //     [
        //         'id_relasi' => 2,
        //         'username' =>  '190651222',
        //         'role'  => 'bendahara',
        //         'password'    => password_hash('dea', PASSWORD_BCRYPT),
        //         'created_at'  => Time::now()
        //     ],
        //     [
        //         'id_relasi' => 3,
        //         'username' =>  '190651333',
        //         'role'  => 'bendahara',
        //         'password'    => password_hash('rendy', PASSWORD_BCRYPT),
        //         'created_at'  => Time::now()
        //     ],
        // ];
        // $this->db->table('pengguna')->insertBatch($dataPengguna);

        // $dataBendahara = [
        //     [
        //         'id_bendahara' => 1,
        //         'id_pengguna' => 2,
        //         'nama'        => '190651111',
        //         'nip'         => '111',
        //         'no_telepon'  => '088712369910',
        //         'profile'     => 'default_profile.png',
        //         'created_at'  => Time::now()
        //     ],
        //     [
        //         'id_bendahara' => 2,
        //         'id_pengguna' => 3,
        //         'nama'        => 'Dea',
        //         'nip'         => '190651222',
        //         'no_telepon'  => '081271237681',
        //         'profile'     => 'default_profile.png',
        //         'created_at'  => Time::now()
        //     ],
        //     [
        //         'id_bendahara' => 3,
        //         'id_pengguna' => 4,
        //         'nama'        => 'Rendy Wahyuda',
        //         'nip'         => '190651333',
        //         'no_telepon'  => '081237681321',
        //         'profile'     => 'default_profile.png',
        //         'created_at'  => Time::now()
        //     ],
        // ];
        // $this->db->table('bendahara')->insertBatch($dataBendahara);
    }

    public function down()
    {
        // $this->forge->dropForeignKey('bendahara', 'bendahara_id_pengguna_foreign');
        $this->forge->dropTable('bendahara');
    }
}
