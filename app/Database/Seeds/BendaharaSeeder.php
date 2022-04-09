<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class BendaharaSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $dataPengguna = [
            [
                'id_relasi' => 1,
                'username' =>  '111',
                'role'  => 'bendahara',
                'password'    => password_hash('rahma', PASSWORD_BCRYPT),
                'created_at'  => Time::now()
            ],
            [
                'id_relasi' => 2,
                'username' =>  '222',
                'role'  => 'bendahara',
                'password'    => password_hash('dea', PASSWORD_BCRYPT),
                'created_at'  => Time::now()
            ],
            [
                'id_relasi' => 3,
                'username' =>  '333',
                'role'  => 'bendahara',
                'password'    => password_hash('rendy', PASSWORD_BCRYPT),
                'created_at'  => Time::now()
            ],
        ];
        $this->db->table('pengguna')->insertBatch($dataPengguna);

        $dataBendahara = [
            [
                'id_bendahara' => 1,
                'id_pengguna' => 2,
                'nama'        => 'Rahma',
                'nip'         => '111',
                'no_telepon'  => '088712369910',
                'profile'     => 'default_profile.png',
                'created_at'  => Time::now()
            ],
            [
                'id_bendahara' => 2,
                'id_pengguna' => 3,
                'nama'        => 'Dea',
                'nip'         => '222',
                'no_telepon'  => '081271237681',
                'profile'     => 'default_profile.png',
                'created_at'  => Time::now()
            ],
            [
                'id_bendahara' => 3,
                'id_pengguna' => 4,
                'nama'        => 'Rendy Wahyuda',
                'nip'         => '333',
                'no_telepon'  => '081237681321',
                'profile'     => 'default_profile.png',
                'created_at'  => Time::now()
            ],


        ];
        $this->db->table('bendahara')->insertBatch($dataBendahara);
    }
}
