<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\BendaharaModel;

class Auth extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Masuk'
        ];

        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required',
                'password' => 'required|validatePengguna[username,password]',
            ];

            $errors = [
                'password' => [
                    'validatePengguna' => 'Username dan Password tidak cocok'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
            } else {

                $penggunaModel = new PenggunaModel();
                $pengguna = $penggunaModel->where('username', $this->request->getVar('username'))->first();
                if ($pengguna['role'] === 'admin') {
                    $adminModel =  new AdminModel();
                    $admin = $adminModel->getAdmin($pengguna['id_relasi']);
                    $this->setAdminSession($pengguna, $admin);
                    session()->setFlashdata('login', 'Berhasil Login');
                    return redirect()->to('/admin/dashboard');
                } elseif ($pengguna['role'] === 'bendahara') {
                    $bendaharaModel =  new BendaharaModel();
                    $bendahara = $bendaharaModel->getBendahara($pengguna['id_relasi']);
                    $this->setBendaharaSession($pengguna, $bendahara);
                    session()->setFlashdata('login', 'Berhasil Login');
                    return redirect()->to('/bendahara/dashboard');
                } else {
                    $siswaModel =  new SiswaModel();
                    $siswa = $siswaModel->getSiswa($pengguna['id_relasi']);
                    $this->setSiswaSession($pengguna, $siswa);
                    session()->setFlashdata('login', 'Berhasil Login');
                    return redirect()->to('/siswa/dashboard');
                }
            }
        }

        return view('index', $data);
    }

    private function setAdminSession(...$admin)
    {
        $data = [
            'id_admin' => $admin[1]['id_admin'],
            'nama' => $admin[1]['nama'],
            'nip' => $admin[1]['nip'],
            'profile' => $admin[1]['profile'],
            'isAdminLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    public function Admin_logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    private function setSiswaSession(...$siswa)
    {
        $data = [
            'id_siswa' => $siswa[1]['id_siswa'],
            'nama' => $siswa[1]['nama'],
            'nis' => $siswa[1]['nis'],
            'profile' => $siswa[1]['profile'],
            'isSiswaLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    public function siswa_profile()
    {

        $data = [
            'title' => 'Profiles'
        ];
        helper(['form']);
        $model = new SiswaModel();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                // 'nama' => 'required',
                'nis' => 'is_unique[siswa.nis]',
                // 'jurusan' => 'required',
                'profile' => 'is_image[profile]|mime_in[profile,image/jpg,image/jpeg,image/png]'
            ];

            if ($this->request->getPost('password') != '') {
                $rules['password'] = 'required|min_length[8]|max_length[255]';
                $rules['password_confirm'] = 'matches[password]';
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $fileProfile = $this->request->getFile('profile');
                if ($fileProfile->getError() == 4) {
                    $profile = $this->request->getVar('oldProfile');
                } else {
                    $profile = $this->request->getPost('nama') . "_" . $fileProfile->getRandomName();
                    $fileProfile->move('img/profiles', $profile);

                    if ($this->request->getVar('oldProfile') != 'default_profile.png') {
                        unlink('img/profiles/' . $this->request->getVar('oldProfile'));
                    }
                }

                $newData = [
                    'id_siswa' => session()->get('id_siswa'),
                    'nama' => $this->request->getPost('nama'),
                    'nis' => $this->request->getPost('nis'),
                    'jurusan' => $this->request->getPost('jurusan'),
                    'profile' => $profile,
                ];
                if ($this->request->getPost('password') != '') {
                    $newData['password'] = $this->request->getPost('password');
                }
                $model->save($newData);

                session()->setFlashdata('success', 'Berhasil Diubah');
                return redirect()->to('/siswa/profile');
            }
        }

        $data['siswa'] = $model->where('id_siswa', session()->get('id_siswa'))->first();
        return view('siswa/profileSiswa', $data);
    }

    public function siswa_logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    private function setBendaharaSession(...$bendahara)
    {
        $data = [
            'id_bendahara' => $bendahara[1]['id_bendahara'],
            'nama' => $bendahara[1]['nama'],
            'nip' => $bendahara[1]['nip'],
            'profile' => $bendahara[1]['profile'],
            'isBendaharaLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }


    public function bendahara_profile()
    {

        $data = [
            'title' => 'Profiles'
        ];
        helper(['form']);
        $model = new BendaharaModel();

        if ($this->request->getMethod() == 'post') {

            $rules = [
                // 'nama' => 'required',
                'nip' => 'is_unique[bendahara.nip]',
                'no_telepon' => 'numeric',
                'profile' => 'is_image[profile]|mime_in[profile,image/jpg,image/jpeg,image/png]'
            ];

            if ($this->request->getPost('password') != '') {
                $rules['password'] = 'required|min_length[8]|max_length[255]';
                $rules['password_confirm'] = 'matches[password]';
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $fileProfile = $this->request->getFile('profile');
                if ($fileProfile->getError() == 4) {
                    $profile = $this->request->getVar('oldProfile');
                } else {
                    $profile = $this->request->getPost('nama') . "_" . $fileProfile->getRandomName();
                    $fileProfile->move('img/profiles', $profile);

                    if ($this->request->getVar('oldProfile') != 'default_profile.png') {
                        unlink('img/profiles/' . $this->request->getVar('oldProfile'));
                    }
                }

                $newData = [
                    'id_bendahara' => session()->get('id_bendahara'),
                    'nama' => $this->request->getPost('nama'),
                    'nip' => $this->request->getPost('nip'),
                    'no_telepon' => $this->request->getPost('no_telepon'),
                    'profile' => $profile,
                ];
                if ($this->request->getPost('password') != '') {
                    $newData['password'] = $this->request->getPost('password');
                }
                $model->save($newData);

                session()->setFlashdata('success', 'Berhasil Diubah');
                return redirect()->to('/bendahara/profile');
            }
        }

        $data['bendahara'] = $model->where('id_bendahara', session()->get('id_bendahara'))->first();
        return view('bendahara/profileBendahara', $data);
    }

    public function bendahara_logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
