<?php

namespace App\Controllers;

use App\Models\SppModel;
use App\Models\TunggakanModel;
use App\Models\KelasModel;
use App\Models\SiswaModel;
use App\Models\AdminModel;
use App\Models\BendaharaModel;
use App\Models\TransaksiModel;
use App\Models\TahunPelajaranModel;
use App\Models\SppKelasModel;
use App\Models\SppTahunModel;
use App\Models\SppAngkatanModel;
use App\Controllers\BaseController;

class Transaksi extends BaseController
{
    protected $transaksiModel;
    protected $bendaharaModel;
    protected $siswaModel;
    protected $sppAngkatanModel;
    protected $adminModel;
    protected $sppModel;
    protected $sppTahunModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->siswaModel = new SiswaModel();
        $this->bendaharaModel = new BendaharaModel();
        $this->adminModel = new AdminModel();
        $this->sppAngkatanModel = new SppAngkatanModel();
        $this->sppTahunModel = new SppTahunModel();
        $this->sppModel = new SppModel();
    }

    // Siswa Transaksi
    public function transaksi()
    {
        helper(['form']);

        $bulanygudah = $this->transaksiModel->getTransaksiBulan(session()->get('id_transaksi'));
        $arr = [];
        for ($i = 0; $i < count($bulanygudah); $i++) {
            $arr[] =  $bulanygudah[$i]['spp_bulan'];
        }

        // $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        // $spp = ['Seragam', 'Uang Bangunan', 'Spp Bulanan', 'Prakerin', 'Ujikom'];

        $bulan = json_decode(file_get_contents(WRITEPATH . "data_siswa.json"), true);
        $spp = json_decode(file_get_contents(WRITEPATH . "data_siswa.json"), true);

        $months = array_diff($bulan['bulan'], $arr);

        $data = [
            'title' => 'Transaksi',
            'bulan' => $months,
            'spp' => $spp['spp'],
            'validation' => \Config\Services::validation(),
            'siswa' => $this->siswaModel->where('id_siswa', session()->get('id_siswa'))->first()
        ];
        return view('siswa/transaksi', $data);
    }

    public function transaksi_save()
    {

        if (!$this->validate([
            'jenis_spp'  => 'required',
            'jenis_pembayaran'  => 'required',
            'nominal_bayar'  => 'required|numeric',
            'bukti_pembayaran' => 'is_image[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpg,image/jpeg,image/png]'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/siswa/transaksi')->withInput()->with('validation', $validation);
        } else {

            $fileBuktiPembayaran = $this->request->getFile('bukti_pembayaran');
            $buktiPembayaran = $this->request->getPost('nominal_bayar') . "_" . $fileBuktiPembayaran->getRandomName();
            $fileBuktiPembayaran->move('img/bukti_pembayaran', $buktiPembayaran);

            $tunggakanModel = new TunggakanModel();
            $sppModel = new SppModel();
            $siswa = $this->siswaModel->getSiswa(session()->get('id_siswa'));
            $tahunPelajaran = $siswa['tahun_pelajaran'];
            $kelas_siswa = $siswa['kelas'];
            $kelas = $siswa['tingkat'];
            $idTunggakan = $tunggakanModel->getTunggakanWhere('tahun_pelajaran', $tahunPelajaran, 'tingkat_kelas', $kelas, 'id_siswa', $siswa['id_siswa'])[0]['id_tunggakan'];
            $idSpp = $sppModel->getSppWhere2('tahun_pelajaran', $tahunPelajaran, 'tingkat_kelas', $kelas, 'id_siswa', $siswa['id_siswa'])[0]['id_spp'];

            $this->transaksiModel->save([
                'id_siswa' => session()->get('id_siswa'),
                'id_tunggakan' => $idTunggakan,
                'id_spp' => $idSpp,
                'nominal_bayar' => $this->request->getVar('nominal_bayar'),
                'jenis_pembayaran' => $this->request->getVar('jenis_pembayaran'),
                'id_bendahara'    => 'null',
                'kelas' => $kelas_siswa,
                'nama_siswa' => $this->request->getVar('nama'),
                'spp_bulan' => $this->request->getVar('spp_bulan'),
                'jenis_spp' => $this->request->getVar('jenis_spp'),
                'tahun_pelajaran' => $tahunPelajaran,
                'status'    => 'pending',
                'notes' => 'null',
                'bukti_pembayaran'  => $buktiPembayaran
            ]);
        }
        session()->setFlashdata('success', 'Berhasil Dikirim');
        return redirect()->to('/siswa/transaksi');
    }

    public function history()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pencarian = $this->transaksiModel->searchAccept($keyword);
        } else {
            $pencarian = $this->transaksiModel;
        }

        $currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

        $siswa = $this->siswaModel->getSiswa(session()->get('id_siswa'))['id_siswa'];
        $this->tunggakanModel = new TunggakanModel();
        $tahunPelajaran = $this->tunggakanModel->where('id_siswa', $siswa)->findAll();

        $arr = [];
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $bulan = array_diff($months, $arr);

        $data = [
            'title' => 'Riwayat Transaksi',
            'history' => $pencarian->where('id_siswa', session()->get('id_siswa'))->where('status !=', 'pending')->paginate(7, 'transaksi'),
            'pager' => $this->transaksiModel->pager,
            'currentPage' => $currentPage,
            'tapel' => $tahunPelajaran,
            'bulan' => $bulan,
            'siswa' => $this->siswaModel->where('id_siswa', session()->get('id_siswa'))->first()
        ];
        return view('siswa/history', $data);
    }

    public function history_bulan()
    {
        $bulan = $this->request->getVar('bulan');

        $currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

        $history = $this->transaksiModel->filterBulan($bulan);

        $no = 0 + (7 * ($currentPage - 1)); ?>
        <?php foreach ($history as $h) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $h['spp_bulan']; ?></td>
                <td><?= $h['tahun_pelajaran']; ?></td>
                <td><?= $h['nominal_bayar']; ?></td>
                <td><?= $h['status']; ?></td>
                <td><?= $h['created_at']; ?></td>
                <td>
                    <a href="<?= base_url("/siswa/riwayat/" . $h['id_transaksi'] . "/detail") ?>" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php
    }

    public function history_tapel_siswa()
    {
        $tahun_pelajaran = $this->request->getVar('tahun_pelajaran');

        $currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

        $history = $this->transaksiModel->filtertapelSiswa($tahun_pelajaran);

        $no = 0 + (7 * ($currentPage - 1)); ?>
        <?php foreach ($history as $h) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $h['spp_bulan']; ?></td>
                <td><?= $h['tahun_pelajaran']; ?></td>
                <td><?= $h['nominal_bayar']; ?></td>
                <td><?= $h['status']; ?></td>
                <td><?= $h['created_at']; ?></td>
                <td>
                    <a href="<?= base_url("/siswa/riwayat/" . $h['id_transaksi'] . "/detail") ?>" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php
    }

    public function siswa_riwayat_pending()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $pencarian = $this->transaksiModel->searchPending($keyword);
        } else {
            $pencarian = $this->transaksiModel;
        }

        $currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

        $siswa = $this->siswaModel->getSiswa(session()->get('id_siswa'))['id_siswa'];
        $this->tunggakanModel = new TunggakanModel();
        $tahunPelajaran = $this->tunggakanModel->where('id_siswa', $siswa)->findAll();
        $arr = [];
        $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $bulan = array_diff($months, $arr);

        $data = [
            'title' => ' Menunggu Konfirmasi',
            'history'   => $pencarian->where('id_siswa', session()->get('id_siswa'))->where('status', 'pending')->paginate(7, 'transaksi'),
            'pager' => $this->transaksiModel->pager,
            'currentPage' => $currentPage,
            'siswa' => $this->siswaModel->where('id_siswa', session()->get('id_siswa'))->first(),
            'tapel' => $tahunPelajaran,
            'bulan' => $bulan,
        ];
        return view('siswa/history_pending', $data);
    }

    public function history_bulan2()
    {
        $bulan = $this->request->getVar('bulan');

        $currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

        $history = $this->transaksiModel->filterBulan2($bulan);

        $no = 0 + (7 * ($currentPage - 1)); ?>
        <?php foreach ($history as $h) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $h['spp_bulan']; ?></td>
                <td><?= $h['tahun_pelajaran']; ?></td>
                <td><?= $h['nominal_bayar']; ?></td>
                <td><?= $h['status']; ?></td>
                <td><?= $h['created_at']; ?></td>
                <td>
                    <a href="<?= base_url("/siswa/riwayat/" . $h['id_transaksi'] . "/detail") ?>" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php
    }

    public function history_tapel_siswa2()
    {
        $tahun_pelajaran = $this->request->getVar('tahun_pelajaran');

        $currentPage = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

        $history = $this->transaksiModel->filtertapelSiswa2($tahun_pelajaran);

        $no = 0 + (7 * ($currentPage - 1)); ?>
        <?php foreach ($history as $h) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $h['spp_bulan']; ?></td>
                <td><?= $h['tahun_pelajaran']; ?></td>
                <td><?= $h['nominal_bayar']; ?></td>
                <td><?= $h['status']; ?></td>
                <td><?= $h['created_at']; ?></td>
                <td>
                    <a href="<?= base_url("/siswa/riwayat/" . $h['id_transaksi'] . "/detail") ?>" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php
    }

    public function siswa_history_detail($id_transaksi)
    {
        $detail = $this->transaksiModel->getTransaksi($id_transaksi);
        if ($detail['status'] == 'pending' || $detail['status'] == 'auto') {
            $detail = $this->transaksiModel->getTransaksi($id_transaksi);
        } else {
            $detail = $this->transaksiModel->getPetugasWhere('id_transaksi', $id_transaksi)[0];
        }

        $data = [
            'title' => 'Detail Riwayat',
            'detail' => $detail,
            'siswa' => $this->siswaModel->where('id_siswa', session()->get('id_siswa'))->first()
        ];
        return view('siswa/history_detail', $data);
    }

    // Bendahara Transaksi
    public function transaksi_new()
    {
        helper(['form']);
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $transaksi = $this->transaksiModel->petugasSearchPending($keyword);
        } else {
            $transaksi = $this->transaksiModel->petugasSearchPending();
        }

        $currentPage = $this->request->getVar('page_history') ? $this->request->getVar('page_history') : 1;

        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();

        $tahunPelajaranModel = new TahunPelajaranModel();
        $tahunPelajaran = $tahunPelajaranModel->findAll();

        $data = [
            'title' => 'Transaksi',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'transaksi' => $transaksi,
            'pager' => $this->transaksiModel->pager,
            'currentPage' => $currentPage,
            'kelas' => $kelas,
            'tahun_pelajaran' => $tahunPelajaran,
        ];

        return view('bendahara/transaksi_new', $data);
    }

    public function transaksi_kelas()
    {
        $kls = $this->request->getVar('kelas');

        $currentPage = $this->request->getVar('page_history') ? $this->request->getVar('page_history') : 1;

        $transaksi = $this->transaksiModel->filter($kls);

        $no = 0 + (7 * ($currentPage - 1));  ?>
        <?php foreach ($transaksi as $t) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $t['nama_siswa']; ?></td>
                <td><?= $t['kelas']; ?></td>
                <td><?= $t['spp_bulan']; ?></td>
                <td><?= $t['tahun_pelajaran']; ?></td>
                <td><?= $t['nominal_bayar']; ?></td>
                <td><?= $t['status']; ?></td>
                <td>
                    <a href="/bendahara/transaksi/new/<?= $t['id_transaksi'] ?>/detail" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php
    }

    public function transaksi_tapel()
    {
        $tapel = $this->request->getVar('tahun_pelajaran');

        $currentPage = $this->request->getVar('page_history') ? $this->request->getVar('page_history') : 1;

        $transaksi = $this->transaksiModel->filter2($tapel);

        $no = 0 + (7 * ($currentPage - 1));  ?>
        <?php foreach ($transaksi as $t) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $t['nama_siswa']; ?></td>
                <td><?= $t['kelas']; ?></td>
                <td><?= $t['spp_bulan']; ?></td>
                <td><?= $t['tahun_pelajaran']; ?></td>
                <td><?= $t['nominal_bayar']; ?></td>
                <td><?= $t['status']; ?></td>
                <td>
                    <a href="/bendahara/transaksi/new/<?= $t['id_transaksi'] ?>/detail" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php
    }

    public function transaksi_new_detail($id)
    {
        helper(['form']);
        $transaksi = $this->transaksiModel->getSiswa($id);
        $idTunggakan = $transaksi[0]['id_tunggakan'];
        $tunggakanModel = new TunggakanModel();
        $tunggakan = $tunggakanModel->getTunggakan($idTunggakan);
        $biaya = [
            't_seragam' => $tunggakan['t_seragam'],
            't_bangunan' => $tunggakan['t_bangunan'],
            't_bulanan' => $tunggakan['t_bulanan'],
            't_prakerin' => $tunggakan['t_prakerin'],
            't_ujikom' => $tunggakan['t_ujikom'],
        ];

        $biayaOpt = [];
        foreach ($biaya as $by => $value) {
            $lable = ucfirst(explode("_", $by)[1]);

            if ($value <= 0) {
                $biayaOpt[] = [
                    'nemval' => $by,
                    'lable' => $lable,
                    'jmlh' => $value,
                    'opt' => 'disabled'
                ];
            } else {
                $biayaOpt[] = [
                    'nemval' => $by,
                    'lable' => $lable,
                    'jmlh' => $value,
                    'opt' => 'enabled'
                ];
            }
        }

        $data = [
            'title' => 'Transaksi',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'transaksi' => $transaksi[0],
            'biaya' => $biayaOpt
        ];
        return view('bendahara/transaksi_new_detail', $data);
    }

    public function transaksi_confirm($id_transaksi)
    {
        if ($this->request->getVar('status') == 'accept') {
            //ambilData Siswa
            $idSiswa = $this->transaksiModel->getTransaksi($id_transaksi)['id_siswa'];

            $sppAkhir = $this->sppModel->getSppWhere('spp.id_siswa', $idSiswa, 'tingkat_kelas', '12')[0];
            $tahunAkhir = explode('-', $sppAkhir['tahun_pelajaran'])[1];
            $sppAngkatan = $this->sppAngkatanModel->getSppAngkatanWhere('tahun', $tahunAkhir)[0];
            $this->sppAngkatanModel->update(
                $sppAngkatan['id_spp_angkatan'],
                [
                    'total_tunggakan' => $sppAngkatan['total_tunggakan'] - $this->request->getVar('nominal_bayar'),
                    'total_transfer' => $sppAngkatan['total_transfer'] + $this->request->getVar('nominal_bayar')
                ]
            );

            $siswa = $this->siswaModel->getSiswa($idSiswa);
            $kelass = $siswa['kelas'];
            $tingkat = $siswa['tingkat'];
            $tapels = $siswa['tahun_pelajaran'];
            $sppKelasModel = new SppKelasModel();
            $sppKelass = $sppKelasModel->getSppKelasWhere('kelas', $kelass, 'tahun_pelajaran', $tapels)[0];
            $tunggakanSppKelas = $sppKelass['total_tunggakan'];
            $transferSppKelas = $sppKelass['total_transfer'];
            $totalTransferSppKelas = $transferSppKelas + $this->request->getVar('nominal_bayar');
            $sisaTungggakanSppKelas = $tunggakanSppKelas - $this->request->getVar('nominal_bayar');
            $sppTahun = $this->sppTahunModel->getSppTahunWhere('tahun_pelajaran', $tapels, 'tingkat', $tingkat);
            if (count($sppTahun) > 0) {
                $idST = $sppTahun[0]['id_spp_tahun'];
                $tunggakanST = $sppTahun[0]['total_tunggakan'];
                $this->sppTahunModel->update(
                    $idST,
                    [
                        'total_transfer' => $sppTahun[0]['total_transfer'] + $this->request->getVar('nominal_bayar'),
                        'total_tunggakan' => $tunggakanST - $this->request->getVar('nominal_bayar')
                    ]
                );
            }
            $sppKelasModel->update(
                $sppKelass['id_spp_kelas'],
                [
                    'total_tunggakan' => $sisaTungggakanSppKelas,
                    'total_transfer' => $totalTransferSppKelas
                ]
            );

            $nominalBayar = $this->request->getVar('nominal_bayar');
            $tunggakanModel = new TunggakanModel();
            $tunggakan = $tunggakanModel->getTunggakan($this->request->getVar('id_tunggakan'));

            $jenis_spp = $this->request->getVar('jenis_spp');
            if ($jenis_spp == "t_seragam") {
                $biayaSeragam = $tunggakan['t_seragam'] - $nominalBayar;
                $biayaBangunan = $tunggakan['t_bangunan'] - 0;
                $biayaBulanan = $tunggakan['t_bulanan'] - 0;
                $biayaPrakerin = $tunggakan['t_prakerin'] - 0;
                $biayaUjikom = $tunggakan['t_ujikom'] - 0;
            } else  if ($jenis_spp == "t_bangunan") {
                $biayaSeragam = $tunggakan['t_seragam'] - 0;
                $biayaBangunan = $tunggakan['t_bangunan'] - $nominalBayar;
                $biayaBulanan = $tunggakan['t_bulanan'] - 0;
                $biayaPrakerin = $tunggakan['t_prakerin'] - 0;
                $biayaUjikom = $tunggakan['t_ujikom'] - 0;
            } else  if ($jenis_spp == "t_bulanan") {
                $biayaSeragam = $tunggakan['t_seragam'] - 0;
                $biayaBangunan = $tunggakan['t_bangunan'] - 0;
                $biayaBulanan = $tunggakan['t_bulanan'] - $nominalBayar;
                $biayaPrakerin = $tunggakan['t_prakerin'] - 0;
                $biayaUjikom = $tunggakan['t_ujikom'] - 0;
            } else  if ($jenis_spp == "t_Prakerin") {
                $biayaSeragam = $tunggakan['t_seragam'] - 0;
                $biayaBangunan = $tunggakan['t_bangunan'] - 0;
                $biayaBulanan = $tunggakan['t_bulanan'] - 0;
                $biayaPrakerin = $tunggakan['t_prakerin'] - $nominalBayar;
                $biayaUjikom = $tunggakan['t_ujikom'] - 0;
            } else  if ($jenis_spp == "t_ujikom") {
                $biayaSeragam = $tunggakan['t_seragam'] - 0;
                $biayaBangunan = $tunggakan['t_bangunan'] - 0;
                $biayaBulanan = $tunggakan['t_bulanan'] - 0;
                $biayaPrakerin = $tunggakan['t_prakerin'] - 0;
                $biayaUjikom = $tunggakan['t_ujikom'] - $nominalBayar;
            }

            // ambil data siswa terus cari tahu tahunpelajaran saat membayar
            $transaksi = $this->transaksiModel->getTransaksi($id_transaksi);

            // ambil data tunggakan sesuai tapel yang aktif saat bayar, terus kurangi tunggakannya
            $dataTunggakan = $tunggakanModel->getTunggakanWhere('id_tunggakan', $this->request->getVar('id_tunggakan'), 'tahun_pelajaran', $transaksi['tahun_pelajaran']);
            $tunggakanPerTahun = $dataTunggakan[0]['tunggakan'] - $nominalBayar;
            $idTunggakan = $dataTunggakan[0]['id_tunggakan'];

            if ($tunggakanPerTahun < 0) {
                // agar menghindari hasil yg minus
                //1. ambil dulu tunggakan tahun berikutnya walaupun dia belum naik kelas
                $tunggakan = $tunggakanModel->getTunggakanWhere('siswa.id_siswa', $this->request->getVar('id_tunggakan'));

                //2. ammbil kumpulan id nya aja
                $tunggakanID = [];
                foreach ($tunggakan as $s) {
                    $tunggakanID[] = $s['id_tunggakan'];
                }

                //3. dapatkan id yang akan aktif berikutnya
                for ($index = 0; $index < count($tunggakanID); $index++) {
                    $activeID = $tunggakanID[$index] === $idTunggakan;
                    if ($activeID) {
                        $nextID = next($tunggakanID);
                    }
                }

                $tunggakanModel->update($nextID, [
                    'tunggakan' => $tunggakanPerTahun,
                    't_seragam' => $biayaSeragam,
                    't_bulanan' => $biayaBulanan,
                    't_prakerin' => $biayaPrakerin,
                    't_ujikom' => $biayaUjikom,
                    't_bangunan' => $biayaBangunan,
                ]);
            } else {
                //mengurangi sisa tunggakan pada tabel biaya spp
                //dan mengurangi sisa seragam, bulanan,prakerin, bangunan
                $tunggakanModel->update($idTunggakan, [
                    'tunggakan' => $tunggakanPerTahun,
                    't_seragam' => $biayaSeragam,
                    't_bulanan' => $biayaBulanan,
                    't_prakerin' => $biayaPrakerin,
                    't_ujikom' => $biayaUjikom,
                    't_bangunan' => $biayaBangunan,
                ]);
            }

            $this->transaksiModel->update($id_transaksi, [
                'id_bendahara' => $this->request->getVar('id_bendahara'),
                'status' => $this->request->getVar('status'),
                'notes' => $this->request->getVar('notes')
            ]);

            // ambil data siswa, kurangi total tunggakan
            $totalTransfer = $this->transaksiModel->getTransaksiWhere('id_siswa', $transaksi['id_siswa'], 'status', 'accept');
            $totalTF = 0;
            for ($ttf = 0; $ttf < count($totalTransfer); $ttf++) {
                $totalTF += $totalTransfer[$ttf]['nominal_bayar'];
            }

            $siswa = $this->siswaModel->getSiswa($transaksi['id_siswa']);
            $sisaTunggakan = $siswa['total_tunggakan'] - $nominalBayar;
            $this->siswaModel->update($transaksi['id_siswa'], [
                'total_tunggakan' => $sisaTunggakan,
                'total_transfer' => $totalTF
            ]);
        } else {

            $this->transaksiModel->update($id_transaksi, [
                'id_bendahara' => $this->request->getVar('id_bendahara'),
                'status' => $this->request->getVar('status'),
                'notes' => $this->request->getVar('notes')
            ]);
        }

        session()->setFlashdata('success', 'Data Berhasil Diubah');
        return redirect()->to('/bendahara/transaksi');
    }

    public function petugas_history()
    {
        helper(['form']);
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $histories = $this->transaksiModel->petugasHistory($keyword);
        } else {
            $histories = $this->transaksiModel->petugasHistory();
        }
        $currentPage = $this->request->getVar('page_history') ? $this->request->getVar('page_history') : 1;

        $kelasModel = new KelasModel();
        $kelas = $kelasModel->findAll();

        $tahunPelajaranModel = new TahunPelajaranModel();
        $tahunPelajaran = $tahunPelajaranModel->findAll();

        $data = [
            'title' => 'Riwayat Transaksi',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'histories' => $histories,
            'pager' => $this->transaksiModel->pager,
            'currentPage' => $currentPage,
            'kelas' => $kelas,
            'tahun_pelajaran' => $tahunPelajaran,
        ];
        return view('bendahara/history', $data);
    }

    public function history_kelas()
    {
        $kls = $this->request->getVar('kelas');

        $currentPage = $this->request->getVar('page_history') ? $this->request->getVar('page_history') : 1;

        $histories = $this->transaksiModel->filterHistory($kls);

        $no = 0 + (7 * ($currentPage - 1)); ?>
        <?php foreach ($histories as $history) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $history['nama_siswa']; ?></td>
                <td><?= $history['kelas']; ?></td>
                <td><?= $history['spp_bulan']; ?></td>
                <td><?= $history['tahun_pelajaran']; ?></td>
                <td><?= $history['nominal_bayar']; ?></td>
                <td><?= $history['status']; ?></td>
                <td><?= $history['created_at']; ?></td>
                <td>
                    <a href="<?= base_url("/bendahara/riwayat/" . $history['id_transaksi'] . "/detail") ?>" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php
    }

    public function history_tapel()
    {
        $tapel = $this->request->getVar('tahun_pelajaran');

        $currentPage = $this->request->getVar('page_history') ? $this->request->getVar('page_history') : 1;

        $histories = $this->transaksiModel->filterHistory2($tapel);

        $no = 0 + (7 * ($currentPage - 1)); ?>
        <?php foreach ($histories as $history) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $history['nama_siswa']; ?></td>
                <td><?= $history['kelas']; ?></td>
                <td><?= $history['spp_bulan']; ?></td>
                <td><?= $history['tahun_pelajaran']; ?></td>
                <td><?= $history['nominal_bayar']; ?></td>
                <td><?= $history['status']; ?></td>
                <td><?= $history['created_at']; ?></td>
                <td>
                    <a href="<?= base_url("/bendahara/riwayat/" . $history['id_transaksi'] . "/detail") ?>" class="btn btn-primary btn-sm">Detail</a>
                </td>
            </tr>
        <?php endforeach; ?>
<?php
    }

    public function petugas_history_detail($id_transaksi)
    {
        $transaksi = $this->transaksiModel->getSiswa($id_transaksi);
        $tunggakanModel = new TunggakanModel();
        $idTunggakan = $transaksi[0]['id_tunggakan'];
        $tunggakan = $tunggakanModel->getTunggakan($idTunggakan);
        $biaya = [
            't_seragam' => $tunggakan['t_seragam'],
            't_bangunan' => $tunggakan['t_bangunan'],
            't_bulanan' => $tunggakan['t_bulanan'],
            't_prakerin' => $tunggakan['t_prakerin'],
            't_ujikom' => $tunggakan['t_ujikom'],
        ];

        $biayaOpt = [];
        foreach ($biaya as $by => $value) {
            $lable = ucfirst(explode("_", $by)[1]);

            if ($value <= 0) {
                $biayaOpt[] = [
                    'nemval' => $by,
                    'lable' => $lable,
                    'jmlh' => $value,
                    'opt' => 'checked disabled'
                ];
            } else {
                $biayaOpt[] = [
                    'nemval' => $by,
                    'lable' => $lable,
                    'jmlh' => $value,
                    'opt' => 'disabled'
                ];
            }
        }

        $data = [
            'title' => 'Detail Riwayat Transaksi',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'detail' => $transaksi[0],
            'tes' => $biayaOpt

        ];

        return view('bendahara/history_detail', $data);
    }

    public function transfer_kip()
    {
        if (!$this->validate([
            'nominal_bayar' => 'required',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/bendahara/list_penerima_kip')->withInput()->with('validation', $validation);
        }

        $siswaModel = new SiswaModel();
        $pkip = $siswaModel->getSppWhere('no_kip !=', NULL);

        $sppModel = new SppModel();


        foreach ($pkip as $penerima) {
            $spp =  $sppModel->getSpp($penerima['id']);

            $tunggakan = $spp['tunggakan'] - $this->request->getVar('nominal_bayar');
            if ($spp['tunggakan'] > 0) {
                $sppModel->save([
                    'id_spp' => $spp['id_spp'],
                    'tunggakan' => $tunggakan,
                ]);
            }

            $this->transaksiModel->save([
                'nama_siswa' => $penerima['nama'],
                'id_spp' => $penerima['id_spp'],
                'id_siswa' => $penerima['id_siswa'],
                'nominal_bayar' => $this->request->getVar('nominal_bayar'),
                'id_petugas' => 0,
                'jenis_pembayaran' => 'operator',
                'bukti_pembayaran' => 'operator',
                'spp_bulan' => '-',
                'status' => 'auto',
            ]);
        }

        session()->setFlashdata('success', 'Dana Berhasil Di Berhasil kirimkan');
        return redirect()->to('bendahara/list_penerima_kip');
    }
}
