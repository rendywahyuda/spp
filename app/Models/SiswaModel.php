<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table = 'siswa';
    protected $allowedFields = ['nama', 'id_pengguna', 'id_tahun_pelajaran', 'id_spp_angkatan', 'angkatan', 'profile', 'nis', 'jurusan', 'total_tunggakan', 'total_biaya', 'total_transfer', 'id_kelas', 'updated_at', 'created_at'];
    protected $primaryKey = 'id_siswa';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getSiswa($id = false)
    {
        if ($id == false) {
            return $this
                ->join('kelas', 'kelas.id_kelas=siswa.id_kelas')
                ->join('tahun_pelajaran', 'tahun_pelajaran.id_tahun_pelajaran=siswa.id_tahun_pelajaran')
                ->findAll();
        } elseif ($id == true) {
            return $this
                ->where(['siswa.id_siswa' => $id])
                ->join('kelas', 'kelas.id_kelas=siswa.id_kelas')
                ->join('tahun_pelajaran', 'tahun_pelajaran.id_tahun_pelajaran=siswa.id_tahun_pelajaran')
                ->first();
        }
    }

    public function siswaSearch($keyword = false)
    {
        if ($keyword == false) {
            return $this->table('siswa')
                ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
                ->join('tahun_pelajaran', 'tahun_pelajaran.id_tahun_pelajaran = siswa.id_tahun_pelajaran')
                ->paginate(6, 'siswa');
        } elseif ($keyword == true) {
            return $this->table('siswa')
                ->like('nama', $keyword)
                ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
                ->join('tahun_pelajaran', 'tahun_pelajaran.id_tahun_pelajaran = siswa.id_tahun_pelajaran')
                ->paginate(6, 'siswa');
        }
    }

    public function getSiswaWhere($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)
            ->where($field2, $nilai2)
            ->join('kelas', 'kelas.id_kelas=siswa.id_kelas')
            ->join('tahun_pelajaran', 'tahun_pelajaran.id_tahun_pelajaran=siswa.id_tahun_pelajaran')
            ->findAll();
    }

    public function getSiswaWhere2($field, $nilai, $field2 = false, $nilai2 = false, $field3 = false, $nilai3 = false)
    {
        return $this->where($field, $nilai)
            ->where($field2, $nilai2)
            ->where($field3, $nilai3)
            ->join('kelas', 'kelas.id_kelas=siswa.id_kelas')
            ->join('tahun_pelajaran', 'tahun_pelajaran.id_tahun_pelajaran=siswa.id_tahun_pelajaran')
            ->findAll();
    }

    public function getKelas($id = false)
    {
        if ($id == false) {
            return $this->db->table('siswa')
                ->join('kelas', 'kelas.id_kelas=siswa.id_kelas')
                ->get()->getResultArray();
        } elseif ($id == true) {
            return $this->db->table('siswa')->where('siswa.id', $id)
                ->join('kelas', 'kelas.id_kelas=siswa.id_kelas')
                ->get()->getResultArray();
        }
    }

    public function getSppWhere($field, $nilai)
    {
        $builder = $this->db->table('siswa')->where($field, $nilai);
        $builder->select('*');
        return $builder->get()->getResultArray();
    }

    public function getTunggakanWhere($field, $nilai)
    {
        return $this->db->table('siswa')
            ->where($field, $nilai)
            ->select('*')
            ->get()->getResultArray();
    }

    public function getTunggakanWhere2($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->db->table('siswa')
            ->where($field, $nilai, $field2, $nilai2)
            ->select('*')
            ->get()->getResultArray();
    }

    public function filter($kelas)
    {
        return $this->table('siswa')
            ->like('kelas', $kelas)
            ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
            ->join('tahun_pelajaran', 'tahun_pelajaran.id_tahun_pelajaran = siswa.id_tahun_pelajaran')
            // ->paginate(6, 'siswa');
            ->findAll();
    }

    public function showSiswa()
    {
        return $this->db->query("CALL showSiswa()")->getResultArray();
    }
}
