<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
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
}
