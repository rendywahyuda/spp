<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\LogSiswaModel;
use App\Models\LogBendaharaModel;
use App\Models\LogKelasModel;
use App\Models\LogTahunPelajaranModel;

class Pages extends BaseController
{
    protected $adminModel;
    protected $logSiswaModel;
    protected $logBendaharaModel;
    protected $logKelasModel;
    protected $logTahunPelajaranModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->logSiswaModel = new LogSiswaModel();
        $this->logKelasModel = new LogKelasModel();
        $this->logTahunPelajaranModel = new LogTahunPelajaranModel();
        $this->logBendaharaModel = new LogBendaharaModel();
    }

    public function log_siswa()
    {
        $data = [
            'title' => 'Log Siswa',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'siswa' => $this->logSiswaModel->findAll(),
        ];

        return view('/admin/log_siswa', $data);
    }

    public function log_bendahara()
    {
        $data = [
            'title' => 'Log Bendahara',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'bendahara' => $this->logBendaharaModel->findAll(),
        ];

        return view('/admin/log_bendahara', $data);
    }

    public function log_kelas()
    {
        $data = [
            'title' => 'Log Kelas',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'kelas' => $this->logKelasModel->findAll(),
        ];

        return view('/admin/log_kelas', $data);
    }

    public function log_tahun_pelajaran()
    {
        $data = [
            'title' => 'Log Tahun Pelajaran',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'tahun_pelajaran' => $this->logTahunPelajaranModel->findAll(),
        ];

        return view('/admin/log_tahun_pelajaran', $data);
    }

    public function user_guide()
    {
        $data = [
            'title' => 'Panduan',
        ];

        return view('/pagers/user_guide', $data);
    }
}
