<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\KelasModel;
use App\Models\SppKelasModel;
use App\Models\TahunPelajaranModel;
use App\Models\DetailBiayaModel;

class Kelas extends BaseController
{
    protected $AdminModel;
    protected $KelasModel;
    protected $SppKelasModel;
    protected $TahunPelajaranModel;
    protected $DetailBiayaModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->kelasModel = new KelasModel();
        $this->sppKelasModel = new SppKelasModel();
        $this->tahunPelajaranModel = new TahunPelajaranModel();
        $this->detailBiayaModel = new DetailBiayaModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_kelas') ? $this->request->getVar('page_kelas') : 1;
        $kelas = $this->kelasModel->getKelas2();
        $data = [
            'title' => 'Kelas',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'kelas' => $kelas,
            'pager' => $this->kelasModel->pager,
            'currentPage' => $currentPage,

        ];

        return view('/admin/kelas_index', $data);
    }

    public function create()
    {
        helper(['form']);
        $kelas = $this->kelasModel->getKelas();

        $data = [
            'title' => 'Tambah Data Kelas',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'kelas' => $kelas,
            'validation' => \Config\Services::validation()
        ];
        return view('admin/kelas_create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'kelas' => 'required',
            'tingkat' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/kelas/tambah')->withInput()->with('validation', $validation);
        }

        //Daftarkan terlebih dahulu kelas
        $this->kelasModel->save([
            'kelas' => $this->request->getVar('kelas'),
            'tingkat' => $this->request->getVar('tingkat'),
        ]);

        //Dapatkan id kelasnya dengan cara mencari dengan kelas ddan tingkat
        $id_kelas = $this->kelasModel->getKelasWhere('kelas', $this->request->getVar('kelas'), 'tingkat', $this->request->getVar('tingkat'))[0]['id_kelas'];

        $tapel = $this->tahunPelajaranModel->findAll();
        $detailBiaya = [];
        for ($i = 0; $i < count($tapel); $i++) {
            $detailBiaya = $this->detailBiayaModel->getDetailBiayaWhere('tahun_pelajaran', $tapel[$i]['tahun_pelajaran'], 'tingkat', $this->request->getVar('tingkat'));

            //Buat sppkelas berdasarkan tahun pelajaran
            //Jika detail biaya telah ditentukan oleh bendahara ambil totalnya
            if (count($detailBiaya) > 0) {
                $biayaPertahun = $detailBiaya[0]['total'];
                $this->sppKelasModel->save([
                    'id_kelas' => $id_kelas,
                    'tahun_pelajaran' => $tapel[$i]['tahun_pelajaran'],
                    'biaya_pertahun' => $biayaPertahun,
                ]);
            } else {
                $this->sppKelasModel->save([
                    'id_kelas' => $id_kelas,
                    'tahun_pelajaran' => $tapel[$i]['tahun_pelajaran'],
                ]);
            }
        }

        session()->setFlashdata('success', 'Berhasil ditambahkan');
        return redirect()->to('admin/kelas');
    }

    public function detail($id)
    {
        $kelas = new KelasModel();
        $data = [
            'title' => 'Detail Data Siswa',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'kelas' => $kelas->getKelas($id),
        ];
        return view('admin/kelas_detail', $data);
    }

    public function edit($id)
    {
        helper(['form']);
        $data = [
            'title' => 'Ubah Kelas',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'validation' => \Config\Services::validation(),
            'kelas' => $this->kelasModel->getKelas($id),
        ];
        return view('admin/kelas_edit', $data);
    }

    public function update($id)
    {
        $oldKelas = $this->kelasModel->getKelas($this->request->getVar('id'));
        if ($oldKelas['kelas'] == $this->request->getVar('kelas')) {
            $rule_nis = 'required';
        } else {
            $rule_nis = 'required|is_unique[kelas.kelas]';
        }
        if (!$this->validate([
            'kelas' => $rule_nis,
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/' . $this->request->getVar('id') . '/kelas/edit')->withInput()->with('validation', $validation);
        }

        $this->kelasModel->save([
            'id_kelas' => $id,
            'kelas' => $this->request->getVar('kelas'),
            'tingkat' => $this->request->getVar('tingkat')
        ]);

        session()->setFlashdata('success', 'Berhasil Diubah');

        return redirect()->to('/admin/kelas');
    }

    public function delete($id)
    {
        $this->kelasModel->delete($id);
        session()->setFlashdata('success', 'Berhasil Dihapus');
        return redirect()->to('/admin/kelas');
    }

    public function showKelas()
    {
        $data = [
            'title' => 'Tampil Kelas',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'kelas' => $this->kelasModel->showKelas()
        ];

        return view('admin/procedure_tampil_kelas', $data);
    }

    public function insertKelas()
    {
        helper(['form', 'url']);

        $data = [
            'title' => 'Tambah Kelas',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/procedure_tambah_kelas', $data);
    }

    public function insertKelasStore()
    {
        helper(['form', 'url']);

        if (!$this->validate([
            'kelas' => 'required',
            'tingkat' => 'required|numeric',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('admin/procedure_tambah_kelas')->withInput()->with('validation', $validation);
        } else {
            $idKelas = NULL;
            $kelas = $this->request->getVar('kelas');
            $tingkat = $this->request->getVar('tingkat');
            $result = $this->kelasModel->insertKelas($idKelas, $kelas, $tingkat);

            if ($result) {
                session()->setFlashdata('success', 'Kelas Berhasil Ditambahkan');
                return redirect()->to('/admin/procedure_tambah_kelas');
            } else {
                session()->setFlashdata('errors', 'Coba Periksa Kembali');
                return redirect()->to('/admin/procedure_tambah_kelas');
            }
        }
    }
}
