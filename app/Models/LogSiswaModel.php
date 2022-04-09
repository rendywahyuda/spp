<?php

namespace App\Models;

use CodeIgniter\Model;

class LogSiswaModel extends Model
{
    protected $table = 'log_siswa';
    protected $allowedFields = ['nis_lama', 'nis_baru', 'nama_lama', 'nama_baru', 'jurusan_lama',  'jurusan_baru', 'pengguna', 'status', 'waktu'];
    protected $primaryKey = 'id_log_siswa';
}
