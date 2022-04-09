<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\KelasModel;
use App\Models\TahunPelajaranModel;
use App\Models\SppKelasModel;
use App\Models\DetailBiayaModel;

class TahunPelajaran extends BaseController
{
    protected $AdminModel;
    protected $TahunPelajaranModel;
    protected $kelasModel;
    protected $sppKelasModel;
    protected $detailBiayaModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->tahunPelajaranModel = new TahunPelajaranModel();
        $this->kelasModel = new KelasModel();
        $this->sppKelasModel = new SppKelasModel();
        $this->detailBiayaModel = new DetailBiayaModel();
    }

    public function index()
    {
        $tapel = $this->tahunPelajaranModel->getTahunPelajaran();
        $currentPage = $this->request->getVar('page_tahun_pelajaran') ? $this->request->getVar('page_tahun_pelajaran') : 1;
        $data = [
            'title' => 'Tahun Pelajaran',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'tapel' => $tapel,
            'pager' => $this->tahunPelajaranModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('/admin/tapel_index', $data);
    }

    public function create()
    {
        helper(['form']);
        function tapel()
        {
            $tahunAwal = 2015;
            $tahunAkhir = $tahunAwal + 1;
            $a = 1;
            $b = 50;
            $tapel = [];
            do {
                $tapel[] = implode('-', [$tahunAwal, $tahunAkhir]);
                $tahunAwal++;
                $tahunAkhir++;
                $a++;
            } while ($a <= $b);
            return $tapel;
        }

        $data = [
            'title' => 'Tambah Data Tahun Pelajaran',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'tapel' => tapel(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/tapel_create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'tahun_pelajaran' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/tahun_pelajaran/tambah')->withInput()->with('validation', $validation);
        }

        //cari semua kelas
        $kelas = $this->kelasModel->getKelas();
        for ($class = 0; $class < count($kelas); $class++) {

            $this->sppKelasModel->save([
                'id_kelas' => $kelas[$class]['id_kelas'],
                'tahun_pelajaran' => $this->request->getVar('tahun_pelajaran'),
            ]);
        }

        $this->tahunPelajaranModel->save([
            'tahun_pelajaran' => $this->request->getVar('tahun_pelajaran'),
        ]);
        session()->setFlashdata('success', 'Berhasil Ditambahkan');
        return redirect()->to('admin/tahun_pelajaran');
    }

    public function edit($id)
    {
        helper(['form']);
        function tapel2()
        {
            $tahunAwal = 2015;
            $tahunAkhir = $tahunAwal + 1;
            $a = 1;
            $b = 50;
            $tapel = [];
            do {
                $tapel[] = implode('-', [$tahunAwal, $tahunAkhir]);
                $tahunAwal++;
                $tahunAkhir++;
                $a++;
            } while ($a <= $b);
            return $tapel;
        }
        $data = [
            'title' => 'Ubah Tahun Pelajaran',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'validation' => \Config\Services::validation(),
            'tapel' => $this->tahunPelajaranModel->getTahunPelajaran($id),
            'tahun_pelajaran' => tapel2()
        ];
        return view('admin/tapel_edit', $data);
    }

    public function update($id)
    {
        $oldTapel = $this->tahunPelajaranModel->getTahunPelajaran($this->request->getVar('id'));
        if ($oldTapel['tahun_pelajaran'] == $this->request->getVar('tahun_pelajaran')) {
            $rule_tapel = 'required';
        } else {
            $rule_tapel = 'required';
        }
        if (!$this->validate([
            'tahun_pelajaran' => $rule_tapel,
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/' . $this->request->getVar('id') . '/tahun_pelajaran/edit')->withInput()->with('validation', $validation);
        }

        $this->tahunPelajaranModel->save([
            'id_tahun_pelajaran' => $id,
            'tahun_pelajaran' => $this->request->getVar('tahun_pelajaran'),
        ]);

        session()->setFlashdata('success', 'Berhasil Diubah');

        return redirect()->to('/admin/tahun_pelajaran');
    }

    public function delete($id)
    {
        $this->tahunPelajaranModel->delete($id);
        session()->setFlashdata('success', 'Berhasil Dihapus');
        return redirect()->to('/admin/tahun_pelajaran');
    }

    public function showTapel()
    {
        $data = [
            'title' => 'Tampil Tahun Pelajaran',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'tapel' => $this->tahunPelajaranModel->showTapel()
        ];

        return view('admin/procedure_tampil_tapel', $data);
    }
}
