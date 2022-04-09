<?php

namespace App\Models;

use CodeIgniter\Model;

class BiayaSppModel extends Model
{
    protected $table = 'biaya_spp';
    protected $allowedFields = ['kode', 'total', 'seragam', 'spp_bulanan', 'uang_bangunan', 'prakerin', 'ujikom'];
    protected $primaryKey = 'id_biaya_spp';

    public function getBiayaSpp($id = false)
    {
        if ($id == false) {
            return $this->orderBy('id_biaya_spp', 'DESC')->paginate(6, 'biaya_spp');
        } elseif ($id == true) {
            return $this->where(['id_biaya_spp' => $id])->first();
        }
    }

    public function select()
    {
        $builder = $this->table('biaya_spp');
        return $query   = $builder->get();
    }

    public function getBiayaSppWhere($field, $nilai)
    {
        return $this->where($field, $nilai)->orderBy('id', 'DESC')->findAll();
    }
}
