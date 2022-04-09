<?php

namespace App\Models;

use CodeIgniter\Model;

class LogBendaharaModel extends Model
{
    protected $table = 'log_bendahara';
    protected $allowedFields = ['nip_lama', 'nip_baru', 'nama_lama', 'nama_baru', 'no_telepon_lama',  'no_telepon_baru', 'pengguna', 'status', 'waktu'];
    protected $primaryKey = 'id_log_bendahara';
}
