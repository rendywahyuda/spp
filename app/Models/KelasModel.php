<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $allowedFields = ['kelas', 'tingkat'];
    protected $primaryKey = 'id_kelas';

    public function getKelas($id = false)
    {
        if ($id == false) {
            return $this->paginate(7, 'kelas');
        } elseif ($id == true) {
            return $this->where(['id_kelas' => $id])->first();
        }
    }

    public function getKelas2($id = false)
    {
        if ($id == false) {
            return $this->paginate(6, 'kelas');
        } elseif ($id == true) {
            return $this->where(['id_kelas' => $id])->first();
        }
    }

    public function getKelas3($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } elseif ($id == true) {
            return $this->where(['id_kelas' => $id])->first();
        }
    }

    public function getKelas4($id_kelas = false)
    {
        if ($id_kelas == false) {
            return $this->findAll();
        } elseif ($id_kelas == true) {
            return $this->where(['id_kelas' => $id_kelas])->first();
        }
    }

    public function getKelasWhere($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)->where($field2, $nilai2)->findAll();
    }

    public function insertKelas($idKelas, $kelas, $tingkat)
    {
        $sql = "CALL insertKelas(?, ?, ?)";
        $result = $this->db->query($sql, [$idKelas, $kelas, $tingkat]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function showKelas()
    {
        return $this->db->query("CALL showKelas()")->getResultArray();
    }
}
