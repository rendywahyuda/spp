<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
	protected $table = 'admin';
	protected $allowedFields = ['nama', 'id_pengguna', 'profile', 'nip', 'password',  'profile', 'updated_at', 'created_at'];
	protected $primaryKey = 'id_admin';
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	public function getAdmin($id = false)
	{
		if ($id == false) {
			return $this->findAll();
		} elseif ($id == true) {
			return $this->where(['id_admin' => $id])->first();
		}
	}
}
