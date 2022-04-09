<?php

namespace App\Models;

use CodeIgniter\Model;

class SppKelasModel extends Model
{
    protected $table = 'spp_kelas';
    protected $allowedFields = ['id_kelas', 'tingkat', 'tahun_pelajaran', 'biaya_pertahun', 'total_biaya', 'total_tunggakan', 'total_transfer'];
    protected $primaryKey = 'id_spp_kelas';

    public function getSppKelas($id = false)
    {
        if ($id == false) {
            return $this->paginate(7, 'kelas');
        } elseif ($id == true) {
            return $this->where(['id_spp_kelas' => $id])->first();
        }
    }

    public function getSppKelas2($id = false)
    {
        if ($id == false) {
            return $this->join('kelas', 'kelas.id_kelas=spp_kelas.id_kelas')->paginate(7, 'kelas');
        } elseif ($id == true) {
            return $this->join('kelas', 'kelas.id_kelas=spp_kelas.id_kelas')->where(['id_spp_kelas' => $id])->first();
        }
    }

    public function getSppKelasWhere($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)
            ->where($field2, $nilai2)
            ->join('kelas', 'kelas.id_kelas=spp_kelas.id_kelas')
            ->findAll();
    }

    public function getSppKelasWhere2($field, $nilai, $field2, $nilai2)
    {
        return $this->where($field, $nilai)
            ->where($field2, $nilai2)
            ->join('kelas', 'kelas.id_kelas=spp_kelas.id_kelas');
    }

    public function getSppKelasWhere3($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)
            ->join('kelas', 'kelas.id_kelas=spp_kelas.id_kelas')->first();
    }

    public function getSppKelasWhere4($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)
            ->join('kelas', 'kelas.id_kelas=spp_kelas.id_kelas')
            ->paginate(7, 'kelas');
    }

    public function getSppKelasWhere5($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)
            ->where($field2, $nilai2)
            ->findAll();
    }

    public function getSppKelasWhere6($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)
            ->where($field2, $nilai2)
            ->join('kelas', 'kelas.id_kelas=spp_kelas.id_kelas')
            ->findAll();
    }

    public function filter($tapel)
    {
        return $this->table('spp_kelas')
            ->like('tahun_pelajaran', $tapel)
            ->join('kelas', 'kelas.id_kelas=spp_kelas.id_kelas')
            // ->paginate(7, 'kelas');
            ->findAll();
    }

    public function filter2($kls)
    {
        return $this->table('spp_kelas')
            ->like('kelas', $kls)
            ->join('kelas', 'kelas.id_kelas=spp_kelas.id_kelas')
            // ->paginate(7, 'kelas');
            ->findAll();
    }
}
