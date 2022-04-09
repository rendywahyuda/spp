<?php

namespace App\Models;

use CodeIgniter\Model;

class SppModel extends Model
{
    protected $table = 'spp';
    protected $allowedFields = ['id_siswa', 'tingkat_kelas', 'tunggakan', 'tahun_pelajaran', 'id_biaya_spp', 'biaya', 't_seragam', 't_bulanan', 't_bangunan', 't_ujikom', 't_prakerin'];
    protected $primaryKey = 'id_spp';

    public function getSppWhere($field, $nilai, $field2 = false, $nilai2 = false)
    {
        $builder = $this->db->table('spp')->where($field, $nilai)->where($field2, $nilai2);
        $builder->join('siswa', 'siswa.id_siswa = spp.id_siswa');
        return $builder->get()->getResultArray();
    }

    public function getSppWhere3()
    {
        $builder = $this->db->table('spp');
        $builder->join('siswa', 'siswa.id_siswa = spp.id_siswa');
        return $builder->get()->getResultArray();
    }

    public function getSpp($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } elseif ($id == true) {
            return $this->where(['id_spp' => $id])->first();
        }
    }

    public function getSppWhere2($field, $nilai, $field2 = false, $nilai2 = false, $field3 = false, $nilai3 = false)
    {
        return $this->where($field, $nilai)->where($field2, $nilai2)->where($field3, $nilai3)->findAll();
    }

    public function getBiayaSpp($id = false)
    {
        if ($id == false) {
            return $this->db->table('spp')
                ->join('biaya_spp', 'biaya_spp.id=spp.id_biaya_spp')
                ->get()->getResultArray();
        } elseif ($id == true) {
            return $this->db->table('spp')->where('spp.id_spp', $id)
                ->join('biaya_spp', 'biaya_spp.id=spp.id_biaya_spp')
                ->get()->getResultArray();
        }
    }
}
