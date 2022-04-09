<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\SiswaModel;
use App\Models\BendaharaModel;
use App\Models\KelasModel;
use App\Models\TransaksiModel;
use App\Models\SppModel;
use App\Models\DetailBiayaModel;
use App\Models\TahunPelajaranModel;
use App\Models\TunggakanModel;
use App\Models\SppKelasModel;
use App\Models\SppTahunModel;
use App\Models\SppAngkatanModel;
use App\Models\PenggunaModel;
use App\Models\BiayaSppModel;

class Siswa extends BaseController
{
    protected $siswaModel;
    protected $transaksiModel;
    protected $adminModel;
    protected $bendaharaModel;
    protected $detailBiayaModel;
    protected $sppAngkatanModel;
    protected $penggunaModel;
    protected $tunggakanModel;
    protected $kelasModel;
    protected $sppTahunModel;
    protected $sppModel;
    protected $tahunPelajaranModel;
    protected $biayaSppModel;
    protected $sppKelasModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
        $this->transaksiModel = new TransaksiModel();
        $this->adminModel = new AdminModel();
        $this->bendaharaModel = new BendaharaModel();
        $this->detailBiayaModel = new DetailBiayaModel();
        $this->sppAngkatanModel = new SppAngkatanModel();
        $this->penggunaModel = new PenggunaModel();
        $this->tunggakanModel = new TunggakanModel();
        $this->kelasModel = new KelasModel();
        $this->sppTahunModel = new SppTahunModel();
        $this->sppModel = new SppModel();
        $this->tahunPelajaranModel = new TahunPelajaranModel();
        $this->biayaSppModel = new BiayaSppModel();
        $this->sppKelasModel = new SppKelasModel();
    }

    public function index()
    {
        helper(['form']);
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $siswa =  $this->siswaModel->siswaSearch($keyword);
        } else {
            $siswa = $this->siswaModel->siswaSearch();
        }

        $currentPage = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;

        $kelasModel = new KelasModel();
        $kls = $kelasModel->findAll();

        $data = [
            'title' => 'Siswa',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'siswa' => $siswa,
            'pager' => $this->siswaModel->pager,
            'currentPage' => $currentPage,
            'kelas' => $kls
        ];
        return view('/admin/siswa_index', $data);
    }

    public function setKelas()
    {
        $kelas = $this->request->getVar('kelas');

        $currentPage = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;

        $siswa = $this->siswaModel->filter($kelas);

        $no = 1 + (6 * ($currentPage - 1));
        foreach ($siswa as $s) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $s['nis']; ?></td>
                <td><?= $s['nama']; ?></td>
                <td><?= $s['kelas']; ?></td>
                <td><?= $s['jurusan']; ?></td>
                <td><?= $s['tahun_pelajaran']; ?></td>
                <td>
                    <a href="<?= base_url('/admin/' . $s['id_siswa'] . '/siswa/edit') ?>" class="btn btn-success btn-sm"><i class='bx bx-pencil' id="update"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
<?php
    }

    public function create()
    {
        helper(['form']);
        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();
        function tapel()
        {
            $tahunAwal = 2015;
            $tahunAkhir = $tahunAwal + 1;
            $a = 1;
            $b = 30;
            $tapel = [];
            do {
                $tapel[] = implode('-', [$tahunAwal, $tahunAkhir]);
                $tahunAwal++;
                $tahunAkhir++;
                $a++;
            } while ($a <= $b);
            return $tapel;
        }

        $jurusan = json_decode(file_get_contents(WRITEPATH . "data_siswa.json"), true);
        $data = [
            'jurusan' => $jurusan['jurusan'],
            'title' => 'Tambah Data Siswa',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'kelas' => $kelas,
            'tahun_pelajaran' => tapel(),
            'validation' => \Config\Services::validation(),
            'jurusan' => $jurusan['jurusan'],
        ];
        return view('/admin/siswa_create', $data);
    }


    public function store()
    {
        if (!$this->validate([
            'nama' => 'required',
            'nis' => 'required|is_unique[siswa.nis]',
            'jurusan' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/siswa/tambah')->withInput()->with('validation', $validation);
        }

        $kelas = $this->kelasModel->getKelas($this->request->getVar('id_kelas'));
        $tingkatSkrg =  $kelas['tingkat'];
        $tahunPelajaran = explode('-',  $this->request->getVar('tahun_pelajaran'));
        $tapelAwal = $tahunPelajaran[0];
        $tapelAkhir = $tahunPelajaran[1];
        $thnAwal = $tahunPelajaran[0];
        $thnAkhir = $tahunPelajaran[1];
        switch ($kelas['tingkat']) {
            case '10':
                $angkatan = $tapelAkhir + 2;
                break;
            case '11':
                $angkatan = $tapelAkhir + 1;
                break;
            case '12':
                $angkatan = $tapelAkhir + 0;
                break;

            default:
                # code...
                break;
        }

        $thnpel = $this->tahunPelajaranModel->getTapelWhere('tahun_pelajaran', $this->request->getVar('tahun_pelajaran'));
        if (count($thnpel) == 0) {
            $this->tahunPelajaranModel->save([
                'tahun_pelajaran' => $this->request->getVar('tahun_pelajaran')
            ]);
        }
        $thnpel = $this->tahunPelajaranModel->getTapelWhere('tahun_pelajaran', $this->request->getVar('tahun_pelajaran'))[0];

        $this->penggunaModel->save([
            'username' => $this->request->getVar('nis'),
            'role' => 'siswa',
            'password' => $this->request->getVar('nis')
        ]);
        $pengguna = $this->penggunaModel->getPenggunaWhere('username', $this->request->getVar('nis'))[0];
        $this->siswaModel->save([
            'id_kelas' => $this->request->getVar('id_kelas'),
            'id_pengguna' => $pengguna['id_pengguna'],
            'angkatan' => $angkatan,
            'nis' => $this->request->getVar('nis'),
            'profile' => 'default_profile.png',
            'nama' => $this->request->getVar('nama'),
            'id_tahun_pelajaran' => $thnpel['id_tahun_pelajaran'],
            'total_tunggakan' => 0,
            'total_biaya' => 0,
            'total_transfer' => 0,
            'jurusan' => $this->request->getVar('jurusan'),
        ]);

        $siswa = $this->siswaModel->getSiswaWhere('nis', $this->request->getVar('nis'))[0];
        $this->penggunaModel->update(
            $pengguna['id_pengguna'],
            [
                'id_relasi' => $siswa['id_siswa']
            ]
        );

        do {
            $detailBiaya = $this->detailBiayaModel->getDetailBiayaWhere('tahun_pelajaran', implode('-', [$tapelAwal, $tapelAkhir]), 'tingkat', $kelas['tingkat']);
            $thn = $this->tahunPelajaranModel->getTapelWhere('tahun_pelajaran', implode('-', [$tapelAwal, $tapelAkhir]));
            if (count($thn) === 0) {
                $this->tahunPelajaranModel->save([
                    'tahun_pelajaran' => implode('-', [$tapelAwal, $tapelAkhir])
                ]);
            }

            if (count($detailBiaya) !== 0) {
                $this->sppModel->save([
                    'id_siswa' => $siswa['id_siswa'],
                    'tahun_pelajaran' => implode('-', [$tapelAwal, $tapelAkhir]),
                    'tingkat_kelas' => $kelas['tingkat'],
                    'biaya' => $detailBiaya[0]['total'],
                    'id_biaya_spp' => $detailBiaya[0]['id_biaya_spp'],
                    't_seragam' => $detailBiaya[0]['seragam'],
                    't_bulanan' => $detailBiaya[0]['spp_bulanan'],
                    't_bangunan' => $detailBiaya[0]['uang_bangunan'],
                    't_prakerin' => $detailBiaya[0]['prakerin'],
                    't_ujikom' => $detailBiaya[0]['ujikom'],
                ]);
                $this->tunggakanModel->save([
                    'id_siswa' => $siswa['id_siswa'],
                    'tahun_pelajaran' => implode('-', [$tapelAwal, $tapelAkhir]),
                    'tingkat_kelas' => $kelas['tingkat'],
                    'id_biaya_spp' => $detailBiaya[0]['id_biaya_spp'],
                    'tunggakan' => $detailBiaya[0]['total'],
                    't_seragam' => $detailBiaya[0]['seragam'],
                    't_bulanan' => $detailBiaya[0]['spp_bulanan'],
                    't_bangunan' => $detailBiaya[0]['uang_bangunan'],
                    't_prakerin' => $detailBiaya[0]['prakerin'],
                    't_ujikom' => $detailBiaya[0]['ujikom'],
                ]);

                // SPP Kelas
                $kls = $this->kelasModel->getKelas();
                for ($ikelas = 0; $ikelas < count($kls); $ikelas++) {
                    $sppKelas = $this->sppKelasModel->getSppKelasWhere5('tahun_pelajaran', implode('-', [$tapelAwal, $tapelAkhir]), 'id_kelas', $kls[$ikelas]['id_kelas']);

                    if (count($sppKelas) == 0) {
                        $this->sppKelasModel->save([
                            'id_kelas' => $kls[$ikelas]['id_kelas'],
                            'tahun_pelajaran' => implode('-', [$tapelAwal, $tapelAkhir]),
                            'tingkat' => $kls[$ikelas]['tingkat'],
                            'biaya_pertahun' => $detailBiaya[0]['total']
                        ]);
                    }
                }
                // end SPP Kelas

            } else {
                $this->sppModel->save([
                    'id_siswa' => $siswa['id_siswa'],
                    'tahun_pelajaran' => implode('-', [$tapelAwal, $tapelAkhir]),
                    'tingkat_kelas' => $kelas['tingkat']
                ]);
                $this->tunggakanModel->save([
                    // 'id_biaya_spp'
                    'id_siswa' => $siswa['id_siswa'],
                    'tahun_pelajaran' => implode('-', [$tapelAwal, $tapelAkhir]),
                    'tingkat_kelas' => $kelas['tingkat']
                ]);
                // SPP Kelas
                $kls = $this->kelasModel->getKelas();
                for ($ikelas = 0; $ikelas < count($kls); $ikelas++) {
                    $sppKelas = $this->sppKelasModel->getSppKelasWhere5('tahun_pelajaran', implode('-', [$tapelAwal, $tapelAkhir]), 'id_kelas', $kls[$ikelas]['id_kelas']);
                    if (count($sppKelas) == 0) {
                        $this->sppKelasModel->save([
                            'id_kelas' => $kls[$ikelas]['id_kelas'],
                            'tahun_pelajaran' => implode('-', [$tapelAwal, $tapelAkhir]),
                        ]);
                    }
                }
                // end SPP Kelas
            }
            $tapelAwal++;
            $tapelAkhir++;
            $kelas['tingkat']++;
        } while ($kelas['tingkat'] <= 12);

        $tunggakan = $this->tunggakanModel->getTunggakanWhere('tunggakan.id_siswa', $siswa['id_siswa'], 'tingkat_kelas', $tingkatSkrg)[0];
        $spp = $this->sppModel->getSppWhere('spp.id_siswa', $siswa['id_siswa'], 'tingkat_kelas', $tingkatSkrg)[0];
        $this->siswaModel->update(
            $siswa['id_siswa'],
            [
                'total_tunggakan' => $tunggakan['tunggakan'],
                'total_biaya' => $spp['biaya']
            ]
        );
        $sppKelas = $this->sppKelasModel->getSppKelasWhere('spp_kelas.id_kelas', $siswa['id_kelas'], 'tahun_pelajaran', implode('-', [$thnAwal, $thnAkhir]))[0];
        $this->sppKelasModel->update(
            $sppKelas['id_spp_kelas'],
            [
                'total_biaya' => $sppKelas['total_biaya'] + $spp['biaya'],
                'total_tunggakan' => $sppKelas['total_tunggakan'] + $tunggakan['tunggakan'],
            ]
        );
        $sppTahun = $this->sppTahunModel->getSppTahunWhere('tahun_pelajaran', implode('-', [$thnAwal, $thnAkhir]), 'tingkat', $tingkatSkrg);
        if (count($sppTahun) === 0) {
            $this->sppTahunModel->save([
                'id_tahun_pelajaran' => $thnpel['id_tahun_pelajaran'],
                'tingkat' => $tingkatSkrg,
            ]);
        }
        $sppTahun = $this->sppTahunModel->getSppTahunWhere('tahun_pelajaran', implode('-', [$thnAwal, $thnAkhir]), 'tingkat', $tingkatSkrg)[0];
        $this->sppTahunModel->update(
            $sppTahun['id_spp_tahun'],
            [
                'total_biaya' => $sppTahun['total_biaya'] + $spp['biaya'],
                'total_tunggakan' => $sppTahun['total_tunggakan'] + $tunggakan['tunggakan']
            ]
        );

        $sppAngkatan = $this->sppAngkatanModel->getSppAngkatanWhere('tahun', $angkatan);
        if (count($sppAngkatan) === 0) {
            $this->sppAngkatanModel->save([
                'tahun' => $angkatan,
            ]);
        }
        $sppAngkatan = $this->sppAngkatanModel->getSppAngkatanWhere('tahun', $angkatan)[0];
        $this->sppAngkatanModel->update(
            $sppAngkatan['id_spp_angkatan'],
            [
                'total_biaya' => $sppAngkatan['total_biaya'] + $spp['biaya'],
                // 'total_biaya' => $sppAngkatan['total_biaya'] + $tunggakan['tunggakan'],
                'total_tunggakan' => $sppAngkatan['total_tunggakan'] + $tunggakan['tunggakan']
            ]
        );

        $idAngkatan = $this->sppAngkatanModel->getSppAngkatanWhere('tahun', $angkatan)[0];
        $this->siswaModel->update(
            $siswa['id_siswa'],
            [
                'id_spp_angkatan' => $idAngkatan['id_spp_angkatan'],
            ]
        );

        session()->setFlashdata('success', 'Berhasil Ditambahkan');
        return redirect()->to('admin/siswa');
    }

    public function detail($id)
    {

        $detail  = [
            'kelas'  => $this->siswaModel->getKelas($id)[0],
            'tunggakan' => $this->siswaModel->getTunggakanWhere('id_siswa', $id)[0]
        ];

        $data = [
            'title' => 'Detail Data Siswa',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'detail' => $detail
        ];

        return view('admin/siswa_detail', $data);
    }

    public function edit($id)
    {
        helper(['form']);
        $kelasModel = new KelasModel();
        $SppModel = new SppModel();
        $tapelModel = new TahunPelajaranModel();
        $tahunSpp =  $SppModel->getSppWhere('siswa.id_siswa', $id);
        $newTahunSPP = [];
        foreach ($tahunSpp as $TS) {
            $newTahunSPP[] = $TS['tahun_pelajaran'];
        }
        $idtapel = [];
        for ($i = 0; $i < count($newTahunSPP); $i++) {
            try {
                $idtapel[] = $tapelModel->getTapelWhere('tahun_pelajaran', $newTahunSPP[$i])[0];
            } catch (\Throwable $th) {
                //throw $th;
                session()->setFlashdata('info', 'Mohon Tambahkan Tahun Pelajaran Baru');
                return redirect()->to('/admin/tahun_pelajaran');
            }
        }

        $jurusan = json_decode(file_get_contents(WRITEPATH . "data_siswa.json"), true);
        $data = [
            'title' => 'Ubah Data Siswa',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'validation' => \Config\Services::validation(),
            'siswa' => $this->siswaModel->getSiswa($id),
            'tapel' => $idtapel,
            'kelas' => $kelasModel->findAll(),
            'jurusan' => $jurusan['jurusan'],
        ];

        return view('admin/siswa_edit', $data);
    }

    public function update($id)
    {
        //jika level kelas naik, artinya siswa naik kelas
        $oldNis = $this->siswaModel->getSiswa($this->request->getVar('id'));

        if ($oldNis['nis'] == $this->request->getVar('nis')) {
            $rule_nis = 'required';
        } else {
            $rule_nis = 'required|is_unique[siswa.nis]';
        }
        if (!$this->validate([
            'nama' => 'required',
            'nis' => $rule_nis,
            'jurusan' => 'required',
            'id_kelas' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/' . $this->request->getVar('id') . '/siswa/edit')->withInput()->with('validation', $validation);
        }

        // caranya ambil data siswa lama dan ditambah 1 tahun lalu komparasi
        $dataLama = $this->siswaModel->getSiswa($id);
        $tingkatLanjut = (int)$dataLama['tingkat'] + 1;

        //siswa update tahun pelajaran. diambil dari tapel spp
        $s = $this->sppModel->getSppWhere('spp.id_siswa', $id, 'tingkat_kelas', $tingkatLanjut)[0];
        $tapelSelanjutnya = $this->tahunPelajaranModel->getTapelWhere('tahun_pelajaran', $s['tahun_pelajaran'])[0];

        // harusnya tapelselanjutnya diambil dari tabel spp
        $tapelAktif = $dataLama['tahun_pelajaran'];
        $pengguna = $this->penggunaModel->getPengguna($dataLama['id_pengguna']);
        $this->penggunaModel->update(
            $pengguna['id_pengguna'],
            [
                'username' => $this->request->getVar('nis'),
                'password' => $this->request->getVar('nis')
            ]
        );

        $this->siswaModel->update(
            $id,
            [
                'nama' => $this->request->getVar('nama'),
                'nis' => $this->request->getVar('nis'),
                'jurusan' => $this->request->getVar('jurusan'),
                'id_kelas' => $this->request->getVar('id_kelas'),
            ]
        );
        $dataBaru = $this->siswaModel->getSiswa($id);
        $tingkatBaru = $dataBaru['tingkat'];

        // $thnpel = $this->tahunPelajaranModel->getTahunPelajaran($dataLama['id_tahun_pelajaran']);

        //komparasi
        // maka jika siswa naik kelas, ambil sisa tunggakan tahun lalu dan gabungkan ke dalam tunggakan yang baru
        if ($tingkatBaru == $tingkatLanjut) {
            $this->siswaModel->update(
                $id,
                [
                    'id_tahun_pelajaran' => $tapelSelanjutnya['id_tahun_pelajaran'],
                ]
            );
            $dataBaru = $this->siswaModel->getSiswa($id);


            $tunggakanModel = new TunggakanModel();
            $sisaTunggakan = $tunggakanModel->getTunggakanWhere('tunggakan.id_siswa', $id, 'tahun_pelajaran', $tapelAktif)[0];
            $dataSisa = [
                't_seragam' => $sisaTunggakan['t_seragam'],
                't_bulanan' => $sisaTunggakan['t_bulanan'],
                't_bangunan' => $sisaTunggakan['t_bangunan'],
                't_prakerin' => $sisaTunggakan['t_prakerin'],
                't_ujikom' => $sisaTunggakan['t_ujikom'],
                'tunggakan' => $sisaTunggakan['tunggakan'],
            ];

            //sisa biaya tahun kelas dan tahun palajaran yang lalu ditambahkan ke kelas dan atahun pelajaran yang baru
            $tunggakanSelanjutnya = $tunggakanModel->getTunggakanWhere('tunggakan.id_siswa', $id, 'tahun_pelajaran', $dataBaru['tahun_pelajaran'])[0];

            $id_tunggakan = $tunggakanSelanjutnya['id_tunggakan'];
            $dataTunggakanAktif = [
                't_seragam' => $tunggakanSelanjutnya['t_seragam'] + $dataSisa['t_seragam'],
                't_bulanan' => $tunggakanSelanjutnya['t_bulanan'] + $dataSisa['t_bulanan'],
                't_bangunan' => $tunggakanSelanjutnya['t_bangunan'] + $dataSisa['t_bangunan'],
                't_prakerin' => $tunggakanSelanjutnya['t_prakerin'] + $dataSisa['t_prakerin'],
                't_ujikom' => $tunggakanSelanjutnya['t_ujikom'] + $dataSisa['t_ujikom'],
                'tunggakan' => $tunggakanSelanjutnya['tunggakan'] + $dataSisa['tunggakan'],
            ];

            $tunggakanModel->update($id_tunggakan, [
                't_seragam' => $dataTunggakanAktif['t_seragam'],
                't_bulanan' => $dataTunggakanAktif['t_bulanan'],
                't_bangunan' => $dataTunggakanAktif['t_bangunan'],
                't_prakerin' => $dataTunggakanAktif['t_prakerin'],
                't_ujikom' => $dataTunggakanAktif['t_ujikom'],
                'tunggakan' => $dataTunggakanAktif['tunggakan'],
            ]);

            $kelas = $this->siswaModel->getSiswa($id)['kelas'];
            $sppKelasModel = new SppKelasModel();
            $NextSppKelas = $sppKelasModel->getSppKelasWhere('tahun_pelajaran', $dataBaru['tahun_pelajaran'], 'kelas', $kelas)[0];
            $idNextSppKelas = $NextSppKelas['id_spp_kelas'];
            $tunggakanNextSppKelas = $NextSppKelas['total_tunggakan'];

            // jika sppkelas tahun berikutnya sudah terisi
            if ($NextSppKelas['biaya_pertahun'] !== Null) {

                //ambil biaya spp dr tabel spp aja
                $sppModel = new SppModel();
                $totalawal = $NextSppKelas['total_biaya'];
                $currentSpp = $sppModel->getSppWhere('spp.id_siswa', $id, 'tingkat_kelas', $dataBaru['tingkat'])[0];
                $sppKelasModel->update(
                    $idNextSppKelas,
                    [
                        'total_tunggakan' => $tunggakanNextSppKelas + $dataTunggakanAktif['tunggakan'],
                        'total_biaya' => $totalawal + $currentSpp['biaya']
                    ]
                );
                $sppTahunSaatIni = $this->sppTahunModel->getSppTahunWhere('tahun_pelajaran', $dataBaru['tahun_pelajaran'], 'tingkat', $dataBaru['tingkat'])[0];
                $idSppTahun = $sppTahunSaatIni['id_spp_tahun'];

                //tambahkan total biaya spptahun karena jumlah siswa bertambah
                // $totalSppPerTahun = $sppTahunSaatIni['total_biaya'] + $sppTahunSaatIni['biaya_pertahun'];
                $totalTunggakanSppTahun = $sppTahunSaatIni['total_tunggakan'] + $dataTunggakanAktif['tunggakan'];
                $this->sppTahunModel->update(
                    $idSppTahun,
                    [
                        'total_biaya' => $totalTunggakanSppTahun,
                        // 'total_biaya' => $totalSppPerTahun,
                        'total_tunggakan' => $totalTunggakanSppTahun
                    ]
                );
            } else {
                $sppKelasModel->update(
                    $idNextSppKelas,
                    [
                        'total_tunggakan' => $tunggakanNextSppKelas + $dataTunggakanAktif['tunggakan']
                    ]
                );
            }

            //menentukan total biaya tabel siswa ditentukan dari tabel spp
            //field biaya
            $jmlBiaya = $this->sppModel->getSppWhere('spp.id_siswa', $id);
            $jmlh = 0;
            foreach ($jmlBiaya as $jb) {
                $jmlh += $jb['biaya'];
            }

            $this->siswaModel->update($id, [
                'total_tunggakan' => $dataTunggakanAktif['tunggakan'],
                'total_biaya' => $dataTunggakanAktif['tunggakan']
            ]);
        }

        // ohh ya jangan lupa tambah tabel baru untuk mentrack biaya asli spp siswa
        session()->setFlashdata('success', 'Berhasil Diubah');

        return redirect()->to('/admin/siswa');
    }

    public function dashboard()
    {
        $tunggakan = $this->siswaModel->getSiswa(session()->get('id_siswa'))['total_tunggakan'];
        $spp = $this->siswaModel->getSiswa(session()->get('id_siswa'))['total_biaya'];
        $kelas = $this->siswaModel->getSiswa(session()->get('id_siswa'))['kelas'];
        $transaksi =  $this->transaksiModel;

        $data = [
            'title' => 'Dashboard',
            'siswa' => $this->siswaModel->where('id_siswa', session()->get('id_siswa'))->first(),
            'tunggakan' => $tunggakan,
            'spp' => $spp,
            'kelas' => $kelas,
            'jumlah' => $transaksi->where('id_siswa', session()->get('id_siswa'))->findAll(),
            'transaksi' => $transaksi->where('status !=', 'pending')->findAll(),
            'history' => $this->transaksiModel->where('id_siswa', session()->get('id_siswa'))->where('status', 'pending')->findAll()
        ];
        return view('siswa/dashboardSiswa', $data);
    }

    public function detail_spp()
    {
        $tunggakanModel = new TunggakanModel();
        $siswa = $this->siswaModel->getSiswa(session()->get('id_siswa'));
        $biaya = $tunggakanModel->where('id_siswa', $siswa['id_siswa'], 'tingkat_kelas', $siswa['tingkat'], 'tahun_pelajaran', $siswa['tahun_pelajaran'])->first();

        $data = [
            'title' => 'Detail Spp',
            'siswa' => $siswa,
            'biaya' => $biaya,
        ];
        return view('siswa/detail_spp', $data);
    }

    public function siswa_detail($id_siswa)
    {
        $data = [
            'title' => 'Siswa',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'siswa' => $this->siswaModel->getTunggakanWhere('id_siswa', $id_siswa)
        ];
        return view('bendahara/detail_siswa', $data);
    }

    public function list_penerima_kip()
    {
        helper(['form']);
        $pkip = $this->siswaModel->getSppWhere('no_kip !=', NULL);

        $data = [
            'title' => 'Data Siswa Penerima KIP',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'pkip' => $pkip,
            'validation' => \Config\Services::validation()
        ];
        return view('bendahara/list_penerima_kip', $data);
    }

    public function showSiswa()
    {
        $data = [
            'title' => 'Tampil Siswa',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'siswa' => $this->siswaModel->showSiswa()
        ];

        return view('admin/procedure_tampil_siswa', $data);
    }

    public function tunggakan_siswa()
    {
        $data = [
            'title' => 'Tunggakan Siswa',
            'admin' => $this->adminModel->where('id_admin', session()->get('id_admin'))->first(),
            'siswa' => $this->tunggakanModel->tunggakanSiswa()
        ];

        return view('admin/view_tunggakan_siswa', $data);
    }
}
