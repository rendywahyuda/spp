<?php

namespace App\Models;

use CodeIgniter\Model;

class LogKelasModel extends Model
{
    protected $table = 'log_kelas';
    protected $allowedFields = ['kelas_lama', 'kelas_baru', 'tingkat_lama', 'tingkat_baru', 'pengguna', 'status', 'waktu'];
    protected $primaryKey = 'id_log_kelas';
}
