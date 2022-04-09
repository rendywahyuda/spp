<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
	protected $table = 'pengguna';
	protected $allowedFields = ['id_pengguna', 'id_relasi' ,'username', 'role', 'password', 'updated_at', 'created_at'];
	protected $primaryKey = 'id_pengguna';
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $beforeInsert = ['beforeInsert'];
	protected $beforeUpdate = ['beforeUpdate'];

	public function getPengguna($id = false)
    {
        if ($id == false) {
            return $this->paginate(7, 'pengguna');
        } elseif ($id == true) {
            return $this->where(['id_pengguna' => $id])->first();
        }
    }
	public function getPenggunaWhere($field, $nilai, $field2 = false, $nilai2 = false)
    {
        return $this->where($field, $nilai)->where($field2, $nilai2)->findAll();
    }

	protected function beforeInsert(array $data)
	{
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function beforeUpdate(array $data)
	{
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function passwordHash(array $data)
	{
		if (isset($data['data']['password']))
			$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

		return $data;
	}
}
