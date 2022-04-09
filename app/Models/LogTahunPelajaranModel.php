<?php

namespace App\Models;

use CodeIgniter\Model;

class LogTahunPelajaranModel extends Model
{
    protected $table = 'log_tahun_pelajaran';
    protected $allowedFields = ['tahun_pelajaran_lama', 'tahun_pelajaran_baru', 'pengguna', 'status', 'waktu'];
    protected $primaryKey = 'id_log_tahun_pelajaran';
}
