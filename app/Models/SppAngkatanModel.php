<?php

namespace App\Models;

use CodeIgniter\Model;

class SppAngkatanModel extends Model
{
    protected $table = 'spp_angkatan';
    protected $allowedFields = ['tahun', 'total_biaya', 'total_tunggakan', 'total_transfer'];
    protected $primaryKey = 'id_spp_angkatan';

    public function getSppAngkatan($id = false)
    {
        if ($id == false) {
            return $this->paginate(7, 'tahun_pelajaran');
        } elseif ($id == true) {
            return $this->where(['id_spp_angkatan' => $id])->first();
        }
    }

    public function getSppAngkatanWhere($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)
            ->where($field2, $nilai2)
            ->findAll();
    }
}
