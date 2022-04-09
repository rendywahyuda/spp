<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunPelajaranModel extends Model
{
	protected $table = 'tahun_pelajaran';
	protected $allowedFields = ['tahun_pelajaran'];
	protected $primaryKey = 'id_tahun_pelajaran';

	public function getTahunPelajaran($id = false)
	{
		if ($id == false) {
			return $this->paginate(6, 'tahun_pelajaran');
		} elseif ($id == true) {
			return $this->where(['id_tahun_pelajaran' => $id])->first();
		}
	}

	public function getTapelWhere($field, $nilai)
	{
		return $this->where($field, $nilai)->findAll();
	}

	public function showTapel()
	{
		return $this->db->query("CALL showTahunPelajaran()")->getResultArray();
	}
}
