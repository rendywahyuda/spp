<?php

namespace App\Models;

use CodeIgniter\Model;

class SppTahunModel extends Model
{
    protected $table = 'spp_tahun';
    protected $allowedFields = ['id_tahun_pelajaran', 'tingkat', 'tahun_pelajaran', 'biaya_pertahun', 'total_biaya', 'total_tunggakan', 'total_transfer'];
    protected $primaryKey = 'id_spp_tahun';

    public function getSppTahun($id = false)
    {
        if ($id == false) {
            return $this->paginate(7, 'tahun_pelajaran');
        } elseif ($id == true) {
            return $this->where(['id_spp_tahun' => $id])->first();
        }
    }

    public function getSppTahunWhere($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)
            ->where($field2, $nilai2)
            ->join('tahun_pelajaran', 'tahun_pelajaran.id_tahun_pelajaran=spp_tahun.id_tahun_pelajaran')
            ->findAll();
    }
}
