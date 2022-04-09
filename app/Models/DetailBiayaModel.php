<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailBiayaModel extends Model
{
	protected $table = 'detail_biaya';
	protected $allowedFields = ['id_biaya_spp', 'tahun_pelajaran', 'tingkat'];
	protected $primaryKey = 'id_detail_biaya';

	public function getDetailBiaya($id = false)
	{
		if ($id == false) {
			return $this
				->join('biaya_spp', 'biaya_spp.id_biaya_spp = detail_biaya.id_biaya_spp')
				->select('*')
				->paginate(7, 'detail_spp');
		} elseif ($id == true) {
			return $this
				->join('biaya_spp', 'biaya_spp.id_biaya_spp = detail_biaya.id_biaya_spp')
				->where(['id_detail_biaya' => $id])->first();
		}
	}

	public function getDetailBiayaWhere($field, $nilai, $field2 = false, $nilai2 = false)
	{
		return $this->where($field, $nilai)->where($field2, $nilai2)
		->join('biaya_spp', 'biaya_spp.id_biaya_spp = detail_biaya.id_biaya_spp')->findAll();
	}
}
