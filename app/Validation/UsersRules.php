<?php

namespace App\Validation;

use App\Models\SiswaModel;
use App\Models\BendaharaModel;
use App\Models\AdminModel;
use App\Models\PenggunaModel;

class UsersRules
{

  public function validatePengguna(string $str, string $fields, array $data)
  {
    $penggunaModel = new PenggunaModel();
    $pengguna = $penggunaModel->where('username', $data['username'])->first();

    if (!$pengguna)
      return false;

    return password_verify($data['password'], $pengguna['password']);
  }
  // public function validateSiswa(string $str, string $fields, array $data)
  // {
  //   $model = new SiswaModel();
  //   $siswa = $model->where('nis', $data['nis'])->first();

  //   if (!$siswa)
  //     return false;

  //   return password_verify($data['password'], $siswa['password']);
  // }

  // public function validatePetugas(string $str, string $fields, array $data)
  // {
  //   $model = new BendaharaModel();
  //   $petugas = $model->where('nip', $data['nip'])->first();

  //   if (!$petugas)
  //     return false;

  //   return password_verify($data['password'], $petugas['password']);
  // }

  // public function validateOperator(string $str, string $fields, array $data)
  // {
  //   $model = new AdminModel();
  //   $operator = $model->where('nip', $data['nip'])->first();

  //   if (!$operator) {
  //     return false;
  //   }

  //   return password_verify($data['password'], $operator['password']);
  // }
}
