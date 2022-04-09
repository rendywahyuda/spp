<?php

namespace App\Controllers;

use App\Models\BendaharaModel;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\TransaksiModel;
use App\Models\AdminModel;
use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class Bendahara extends BaseController
{
    protected $bendaharaModel;
    protected $transaksiModel;
    protected $kelasModel;
    protected $siswaModel;
    protected $adminModel;
    protected $penggunaModel;

    public function __construct()
    {
        $this->bendaharaModel = new BendaharaModel();
        $this->transaksiModel = new TransaksiModel();
        $this->kelasModel = new KelasModel();
        $this->siswaModel = new SiswaModel();
        $this->adminModel = new AdminModel();
        $this->penggunaModel = new PenggunaModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $bendahara =  $this->bendaharaModel->bendaharaSearch($keyword);
        } else {
            $bendahara = $this->bendaharaModel;
        }

        $bendahara = $this->bendaharaModel->getPetugas();
        $currentPage = $this->request->getVar('page_bendahara') ? $this->request->getVar('page_bendahara') : 1;
        $data = [
            'title' => 'Bendahara',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'petugas' => $bendahara,
            'pager' => $this->bendaharaModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('/admin/bendahara_index', $data);
    }

    public function create()
    {
        helper(['form']);
        $bendahara = $this->bendaharaModel->getBendahara('paginate');

        $data = [
            'title' => 'Tambah Data Petugas',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'petugas' => $bendahara,
            'validation' => \Config\Services::validation()
        ];
        return view('/admin/bendahara_create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nama' => 'required',
            'nip' => 'required|is_unique[bendahara.nip]',
            'no_telepon' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/bendahara/tambah')->withInput()->with('validation', $validation);
        }
        $this->penggunaModel->save([
            'username' => $this->request->getVar('nip'),
            'role' => 'bendahara',
            'password' => $this->request->getVar('nip')
        ]);
        $pengguna = $this->penggunaModel->getPenggunaWhere('username', $this->request->getVar('nip'))[0];
        $this->bendaharaModel->save([
            'id_pengguna' => $pengguna['id_pengguna'],
            'nama' => $this->request->getVar('nama'),
            'nip' => $this->request->getVar('nip'),
            'profile' => 'default_profile.png',
            'no_telepon' => $this->request->getVar('no_telepon'),
        ]);
        $bendahara = $this->bendaharaModel->getBendaharaWhere('nip', $this->request->getVar('nip'))[0];
        $this->penggunaModel->update(
            $pengguna['id_pengguna'],
            [
                'id_relasi' => $bendahara['id_bendahara']
            ]
        );
        session()->setFlashdata('success', 'Berhasil Ditambahkan');
        return redirect()->to('admin/bendahara');
    }

    public function edit($id)
    {
        helper(['form']);
        $data = [
            'title' => 'Ubah Data Petugas',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'validation' => \Config\Services::validation(),
            'bendahara' => $this->bendaharaModel->getPetugas($id),
        ];
        return view('admin/bendahara_edit', $data);
    }

    public function update($id)
    {
        $oldNip = $this->bendaharaModel->getPetugas($this->request->getVar('id'));
        if ($oldNip['nip'] == $this->request->getVar('nip')) {
            $rule_nis = 'required';
        } else {
            $rule_nis = 'required|is_unique[bendahara.nip]';
        }
        if (!$this->validate([
            'nama' => 'required',
            'nip' => $rule_nis,
            'no_telepon' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/' . $this->request->getVar('id') . '/bendahara/edit')->withInput()->with('validation', $validation);
        }
        $pengguna = $this->penggunaModel->getPengguna($oldNip['id_pengguna']);
        $this->penggunaModel->update(
            $pengguna['id_pengguna'],
            [
                'username' => $this->request->getVar('nip'),
                'password' => $this->request->getVar('nip')
            ]
        );

        $this->bendaharaModel->save([
            'id_bendahara' => $id,
            'nama' => $this->request->getVar('nama'),
            'nip' => $this->request->getVar('nip'),
            'no_telepon' => $this->request->getVar('no_telepon'),
        ]);

        session()->setFlashdata('success', 'Berhasil Diubah');

        return redirect()->to('/admin/bendahara');
    }

    public function delete($id)
    {
        $bendahara = $this->bendaharaModel->getBendahara($id);
        $pengguna = $this->penggunaModel->getPenggunaWhere('username', $bendahara['nip'])[0];
        $this->penggunaModel->delete($pengguna['id_pengguna']);
        $this->bendaharaModel->delete($id);
        session()->setFlashdata('success', 'Berhasil Dihapus');
        return redirect()->to('/admin/bendahara');
    }


    public function dashboard()
    {
        $history = $this->transaksiModel->getSiswaWhere('status', 'pending');
        $transaksi = $this->transaksiModel->getSiswaWhere('status != ', 'pending');

        $data = [
            'title' => 'Dashboard',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'transaksi' => $transaksi,
            'history' => $history,
            'jumlah_transaksi' => $this->transaksiModel->findAll(),
            'jumlah_siswa' => $this->siswaModel->getSiswa(),
            'jumlah_kelas' => $this->kelasModel->findAll()
        ];
        return view('bendahara/dashboardBendahara', $data);
    }

    public function showBendahara()
    {
        $data = [
            'title' => 'Tampil Bendahara',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'bendahara' => $this->bendaharaModel->showBendahara()
        ];

        return view('admin/procedure_tampil_bendahara', $data);
    }
}
