<?php

namespace App\Models;

use CodeIgniter\Model;

class BendaharaModel extends Model
{
    protected $table = 'bendahara';
    protected $allowedFields = ['nama', 'nip', 'profile', 'id_pengguna', 'no_telepon', 'updated_at', 'created_at'];
    protected $primaryKey = 'id_bendahara';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getPetugas($id = false)
    {
        if ($id == false) {
            return $this->paginate(6, 'bendahara');
        } elseif ($id == true) {
            return $this->where(['id_bendahara' => $id])->first();
        }
    }
    public function getBendaharaWhere($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)->where($field2, $nilai2)->findAll();
    }


    public function getBendahara($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } elseif ($id == true) {
            return $this->where(['id_bendahara' => $id])->first();
        }
    }


    public function getPetugas2($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } elseif ($id == true) {
            return $this->where(['id_bendahara' => $id])->first();
        }
    }

    public function petugasSearch($keyword)
    {
        $builder = $this->table('petugas');
        $builder->like('nama', $keyword);
        return $builder;
    }

    public function showBendahara()
    {
        return $this->db->query("CALL showBendahara()")->getResultArray();
    }
}
