<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\BendaharaModel;
use App\Models\SiswaModel;
use App\Models\KelasModel;

class Admin extends BaseController
{
	protected $AdminModel;
	protected $bendaharaModel;
	protected $siswaModel;
	protected $kelasModel;

	public function __construct()
	{
		$this->adminModel = new AdminModel();
		$this->bendaharaModel = new BendaharaModel();
		$this->siswaModel = new SiswaModel();
		$this->kelasModel = new KelasModel();
	}

	public function dashboard()
	{
		$data = [
			'title' => 'Dashboard',
			'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
			'jumlah_petugas' => $this->bendaharaModel->getPetugas2(),
			'jumlah_siswa' => $this->siswaModel->getSiswa(),
			'jumlah_kelas' => $this->kelasModel->getKelas3()
		];
		return view('admin/dashboardAdmin', $data);
	}
}
