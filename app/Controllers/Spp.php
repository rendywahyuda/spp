<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SppModel;
use App\Models\SiswaModel;
use App\Models\BendaharaModel;
use App\Models\BiayaSppModel;
use App\Models\DetailBiayaModel;
use App\Models\TahunPelajaranModel;
use App\Models\TunggakanModel;
use App\Models\SppKelasModel;
use App\Models\SppTahunModel;
use App\Models\SppAngkatanModel;
use App\Models\KelasModel;

class Spp extends BaseController
{
    protected $sppModel;
    protected $sppTahunModel;
    protected $sppKelasModel;
    protected $siswaModel;
    protected $biayaSppModel;
    protected $bendaharaModel;
    protected $tunggakanModel;
    protected $sppAngkatanModel;
    protected $detailBiayaModel;
    protected $kelasModel;
    protected $tahunPelajaranModel;

    public function __construct()
    {
        $this->sppModel = new SppModel();
        $this->sppTahunModel = new SppTahunModel();
        $this->sppKelasModel = new SppKelasModel();
        $this->siswaModel = new SiswaModel();
        $this->biayaSppModel = new BiayaSppModel();
        $this->bendaharaModel = new BendaharaModel();
        $this->tunggakanModel = new TunggakanModel();
        $this->sppAngkatanModel = new SppAngkatanModel();
        $this->detailBiayaModel = new DetailBiayaModel();
        $this->kelasModel = new KelasModel();
        $this->tahunPelajaranModel = new TahunPelajaranModel();
    }

    public function index()
    {
        helper(['form']);

        $detailBiaya = $this->detailBiayaModel->getDetailBiaya();
        $currentPage = $this->request->getVar('page_spp') ? $this->request->getVar('page_spp') : 1;

        $data = [
            'title' => 'Spp',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'detail_biaya' => $detailBiaya,
            'validation' => \Config\Services::validation(),
            'pager' => $this->detailBiayaModel->pager,
            'currentPage' => $currentPage,
        ];
        return view('bendahara/spp_index', $data);
    }

    public function create()
    {
        helper(['form']);

        $tapelModel = new TahunPelajaranModel();
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

        $biayaSppModel = new BiayaSppModel();
        $biayaSpp = $biayaSppModel->findAll();
        $detailBiaya = $this->detailBiayaModel->getDetailBiaya();
        $data = [
            'title' => 'Tambah Spp',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'tapel' => tapel(),
            'detail_biaya' => $detailBiaya,
            'biayaSpp' => $biayaSpp,
            'validation' => \Config\Services::validation()
        ];
        return view('bendahara/spp_pertahun_create', $data);
    }

    public function store()
    {

        // $tp = explode('=', $this->request->getVar('tahun_pelajaran'));
        $detailBiaya = $this->detailBiayaModel->getDetailBiayaWhere('tahun_pelajaran', $this->request->getVar('tahun_pelajaran'), 'tingkat', $this->request->getVar('kelas'));
        switch ($this->request->getVar('kelas')) {
            case '12':
                $tahunAngkatan = 0;
                break;
            case '11':
                $tahunAngkatan = 1;
                break;
            case '10':
                $tahunAngkatan = 2;
                break;
            default:
                break;
        }
        $tapel = explode('-', $this->request->getVar('tahun_pelajaran'));
        $tahunKelulusanAwal = (int)$tapel[0];
        $tahunKelulusanAkhir = (int)$tapel[1];

        $tahunKelulusanAwal += $tahunAngkatan;
        $tahunKelulusanAkhir += $tahunAngkatan;

        if (count($detailBiaya) === 0) {

            $tahunPelajaran  = $this->tahunPelajaranModel->getTapelWhere('tahun_pelajaran', $this->request->getVar('tahun_pelajaran'));
            if (count($tahunPelajaran)  === 0) {
                $this->tahunPelajaranModel->save([
                    'tahun_pelajaran' => $this->request->getVar('tahun_pelajaran')
                ]);
            }

            $kls = $this->kelasModel->getKelas();
            for ($ikelas = 0; $ikelas < count($kls); $ikelas++) {
                $sppKelas = $this->sppKelasModel->getSppKelasWhere5('tahun_pelajaran', $this->request->getVar('tahun_pelajaran'), 'id_kelas', $kls[$ikelas]['id_kelas']);
                if (count($sppKelas) == 0) {
                    $this->sppKelasModel->save([
                        'id_kelas' => $kls[$ikelas]['id_kelas'],
                        'tahun_pelajaran' => $this->request->getVar('tahun_pelajaran'),
                        // 'tingkat' => $kls[$ikelas]['tingkat'],
                    ]);
                }
            }
            $tahunPel = $this->tahunPelajaranModel->getTapelWhere('tahun_pelajaran', $this->request->getVar('tahun_pelajaran'))[0];

            $siswaModel = new SiswaModel();
            $tunggakanModel = new TunggakanModel();
            $biayaSppModel = new BiayaSppModel();
            $biayaSpp = $biayaSppModel->getBiayaSpp($this->request->getVar('biaya_spp'));
            // 1. jadi, disini system bakal nyari IDSISWA yang sesuai dengan tahun ajaran, dan tingkat kelas yg dipilih
            $siswa = $siswaModel->getSiswaWhere('siswa.id_tahun_pelajaran', $tahunPel['id_tahun_pelajaran'], 'tingkat', $this->request->getVar('kelas'));
            $jmlhSiswa =  (int)count($siswa);
            $sppAngkatan = $this->sppAngkatanModel->getSppAngkatanWhere('tahun', $tahunKelulusanAkhir);

            $sppSiswa = $this->sppModel->getSppWhere('tingkat_kelas', 12, 'tahun_pelajaran', implode('-', [$tahunKelulusanAwal, $tahunKelulusanAkhir]));

            if (count($sppAngkatan) > 0) {
                $this->sppAngkatanModel->update(
                    $sppAngkatan[0]['id_spp_angkatan'],
                    [
                        'total_biaya' => $sppAngkatan[0]['total_biaya'] + ($biayaSpp['total'] * count($sppSiswa)),
                        'total_tunggakan' => $sppAngkatan[0]['total_tunggakan'] + ($biayaSpp['total'] * count($sppSiswa)),
                    ]
                );
            }

            $biaya = [
                $biayaSpp['seragam'],
                $biayaSpp['uang_bangunan'],
                $biayaSpp['spp_bulanan'],
                $biayaSpp['prakerin'],
                $biayaSpp['ujikom'],
            ];

            $jmlh_biaya = 0;
            for ($i = 0; $i < count($biaya); $i++) {
                $jmlh_biaya += $biaya[$i];
            }

            $idNewSiswa = [];
            foreach ($siswa as $s) {
                $idNewSiswa[] = $s['id_siswa'];
            }

            $sppModel = new SppModel();
            //2. KEMUDIAN SYSTEM AKAN NYARI DI TABEL SPP SESUAI DENGAN TAHUN DAN TINGKAT KELAS
            $idSpp = $sppModel->getSppWhere('tahun_pelajaran', $this->request->getVar('tahun_pelajaran'), 'tingkat_kelas', $this->request->getVar('kelas'));
            $idTunggakan = $tunggakanModel->getTunggakanWhere('tahun_pelajaran', $this->request->getVar('tahun_pelajaran'), 'tingkat_kelas', $this->request->getVar('kelas'));
            $idNewSpp = [];
            foreach ($idSpp as $ids) {
                $idNewSpp[] = $ids['id_spp'];
            }

            // ambil tunggakan tahun sebelumnya
            $idNewTunggakan = [];
            foreach ($idTunggakan as $idt) {
                $idNewTunggakan[] = $idt['id_tunggakan'];
            }

            for ($a = 0; $a < count($idSpp); $a++) {
                $sppModel->update(
                    $idNewSpp[$a],
                    [
                        'id_biaya_spp' => $this->request->getVar('biaya_spp'),
                        'biaya' => $jmlh_biaya,
                        't_seragam' => $biayaSpp['seragam'],
                        't_bangunan' => $biayaSpp['uang_bangunan'],
                        't_bulanan' => $biayaSpp['spp_bulanan'],
                        't_prakerin' => $biayaSpp['prakerin'],
                        't_ujikom' => $biayaSpp['ujikom'],
                    ]
                );

                //ambil tunggakan jika siswa telah dinaikan kelas lebih dahulu
                $gabungTunggakan = $tunggakanModel->getTunggakanWhere('id_tunggakan', $idNewTunggakan[$a])[0];

                $hasilTunggakan = [
                    't_seragam' => $gabungTunggakan['t_seragam'] + $biayaSpp['seragam'],
                    't_bulanan' => $gabungTunggakan['t_bulanan'] + $biayaSpp['spp_bulanan'],
                    't_bangunan' => $gabungTunggakan['t_bangunan'] + $biayaSpp['uang_bangunan'],
                    't_prakerin' => $gabungTunggakan['t_prakerin'] + $biayaSpp['prakerin'],
                    't_ujikom' => $gabungTunggakan['t_ujikom'] + $biayaSpp['ujikom'],
                ];

                $tunggakanModel->update(
                    $idNewTunggakan[$a],
                    [
                        'id_biaya_spp' => $this->request->getVar('biaya_spp'),
                        'tunggakan' => $jmlh_biaya + $gabungTunggakan['tunggakan'],
                        't_seragam' => $hasilTunggakan['t_seragam'],
                        't_bulanan' => $hasilTunggakan['t_bulanan'],
                        't_bangunan' => $hasilTunggakan['t_bangunan'],
                        't_prakerin' => $hasilTunggakan['t_prakerin'],
                        't_ujikom' => $hasilTunggakan['t_ujikom'],
                    ]
                );
            }

            //3.  NAH KEMUDIAN BARU SYSTEM BAKAL MASUKIN TOTAL TUNGGAKAN DAN TOTAL BIAYA KE TABEL SISWA DARI POIN NO 1
            // NAH KALAU YG POIN 1 GA ADA HASIL YANG COCOK, OTOMATIS SYSTEM GA AKAN NGEUPDATE TOTAL TUNGGAKAN DAN BIAYA DARI TABEL SISWA
            for ($c = 0; $c < count($idNewSiswa); $c++) {
                //Tunggakan
                $tunggakanSiswa =  $tunggakanModel->getTunggakanWhere('tunggakan.id_siswa', $idNewSiswa[$c]);
                $tunggakan = [];
                foreach ($tunggakanSiswa as $tggkn) {
                    $tunggakan[] = $tggkn['tunggakan'];
                }

                $jmlh_tunggakan = 0;
                for ($i = 0; $i < count($tunggakan); $i++) {
                    $jmlh_tunggakan += $tunggakan[$i];
                }

                $spp = $sppModel->getSppWhere('spp.id_siswa', $idNewSiswa[$c]);

                $bs = [];
                foreach ($spp as $s) {
                    $bs[] = $s['biaya'];
                }
                $totalBiaya = 0;
                for ($t = 0; $t < count($bs); $t++) {
                    if ($bs[$t] !== null) {
                        $totalBiaya += $bs[$t];
                    }
                }

                $this->siswaModel->save([
                    'id_siswa' => $idNewSiswa[$c],
                    'total_tunggakan' => $jmlh_tunggakan,
                    'total_biaya' => $totalBiaya,
                ]);
            }

            $this->detailBiayaModel->save([
                'tahun_pelajaran' => $this->request->getVar('tahun_pelajaran'),
                'tingkat' => $this->request->getVar('kelas'),
                'id_biaya_spp' => $this->request->getVar('biaya_spp')
            ]);

            // ambil spp kelas berdasarkan tapel dan tingkat
            $sppKelasModel = new SppKelasModel();
            //cari
            $sppKelas = $sppKelasModel->getSppKelasWhere('tingkat', $this->request->getVar('kelas'), 'tahun_pelajaran', $this->request->getVar('tahun_pelajaran'));
            if (count($sppKelas) > 0) {

                for ($isk = 0; $isk <  count($sppKelas); $isk++) {
                    //ambil kelas dan tapel siswa (perkelas)
                    $siswaModel = new SiswaModel();
                    $siswa = $siswaModel->getSiswaWhere('kelas', $sppKelas[$isk]['kelas']);

                    $totalSpp = 0;
                    $totalTunggakan = 0;
                    for ($s = 0; $s < count($siswa); $s++) {
                        $idSiswa = $siswa[$s]['id_siswa'];
                        $sppModel = new SppModel();
                        $tunggakanModel = new TunggakanModel();
                        //ambil biaya dan tunggakan tiap siswwa
                        $biaya = $sppModel->getSppWhere('spp.id_siswa', $idSiswa, 'tahun_pelajaran', $this->request->getVar('tahun_pelajaran'));
                        $tunggakan = $tunggakanModel->getTunggakanWhere('tunggakan.id_siswa', $idSiswa, 'tahun_pelajaran', $this->request->getVar('tahun_pelajaran'));
                        if (count($biaya) !== 0) {
                            $bspp = $biaya[0]['biaya'];
                            $tnggkn = $tunggakan[0]['tunggakan'];
                            $totalSpp += $bspp;
                            $totalTunggakan += $tnggkn;
                        } else {
                            //tambahkan
                            $bspp = 0;
                            $tnggkn = 0;
                            $totalSpp += $bspp;
                            $totalTunggakan += $tnggkn;
                        }
                    }

                    $idSppKelas = $sppKelas[$isk]['id_spp_kelas'];
                    $sppKelasModel->update(
                        $idSppKelas,
                        [
                            'biaya_pertahun' => $biayaSpp['total'],
                            'total_biaya' => $totalSpp,
                            'total_tunggakan' => $totalTunggakan
                        ]
                    );
                }
            }
            $sppKelas = $this->sppKelasModel->getSppKelasWhere('tingkat', $this->request->getVar('kelas'), 'tahun_pelajaran', $this->request->getVar('tahun_pelajaran'));
            $totalBiayaSppKelas = 0;
            $totalTunggakanSppKelas = 0;
            $totalTransferSppKelas = 0;
            for ($isp = 0; $isp < count($sppKelas); $isp++) {
                $totalBiayaSppKelas += $sppKelas[$isp]['total_biaya'];
                $totalTunggakanSppKelas += $sppKelas[$isp]['total_tunggakan'];
                $totalTransferSppKelas += $sppKelas[$isp]['total_transfer'];
            }
            $byspp = $this->biayaSppModel->getBiayaSpp($this->request->getVar('biaya_spp'));
            $sppTahun = $this->sppTahunModel->getSppTahunWhere('tahun_pelajaran', $this->request->getVar('tahun_pelajaran'), 'tingkat', $this->request->getVar('kelas'));
            if (count($sppTahun) === 0) {
                $this->sppTahunModel->save([
                    'id_tahun_pelajaran' => $tahunPel['id_tahun_pelajaran'],
                    'tingkat' => $this->request->getVar('kelas'),
                    // 'tahun_pelajaran' => $this->request->getVar('tahun_pelajaran'),
                    'biaya_pertahun' => $byspp['total'],
                    'total_biaya' => $totalBiayaSppKelas,
                    'total_tunggakan' => $totalTunggakanSppKelas,
                    'total_transfer' => $totalTransferSppKelas
                ]);
            } else {
                $this->sppTahunModel->update(
                    $sppTahun[0]['id_spp_tahun'],
                    [
                        'biaya_pertahun' => $byspp['total'],
                        'total_biaya' => $totalBiayaSppKelas,
                        'total_tunggakan' => $totalTunggakanSppKelas,
                        'total_transfer' => $totalTransferSppKelas
                    ]
                );
            }

            session()->setFlashdata('success', 'Berhasil Ditambahkan');
            return redirect()->to('/bendahara/spp');
        } else {
            session()->setFlashdata('message', 'Telah Ditambahkan Sebelumnya');
            return redirect()->to('/bendahara/spp/tambah');
        }
    }
}
