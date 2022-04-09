<?php

namespace App\Models;

use CodeIgniter\Model;

class TunggakanModel extends Model
{
	protected $table = 'tunggakan';
	protected $allowedFields = ['id_siswa', 'tingkat_kelas', 'tunggakan', 'tahun_pelajaran', 'id_biaya_spp', 'biaya', 't_seragam', 't_bulanan', 't_bangunan', 't_ujikom', 't_prakerin'];
	protected $primaryKey = 'id_tunggakan';

	public function getTunggakan($id = false)
	{
		if ($id == false) {
			return $this->findAll();
		} elseif ($id == true) {
			return $this->where(['id_tunggakan' => $id])->first();
		}
	}

	public function getTunggakanWhere($field, $nilai, $field2 = false, $nilai2 = false, $field3 = false, $nilai3 = false)
	{
		return $this->where($field, $nilai)->where($field2, $nilai2)->where($field3, $nilai3)->findAll();
	}

	public function getBiayaSpp($id = false)
	{
		if ($id == false) {
			return $this->db->table('tunggakan')
				->join('biaya_spp', 'biaya_spp.id=tunggakan.id_biaya_spp')
				->get()->getResultArray();
		} elseif ($id == true) {
			return $this->db->table('tunggakan')->where('tunggakan.id_spp', $id)
				->join('biaya_spp', 'biaya_spp.id=tunggakan.id_biaya_spp')
				->get()->getResultArray();
		}
	}

	public function tunggakanSiswa()
	{
		return $this->db->query("SELECT * FROM tunggakanSiswa")->getResultArray();
	}
}
