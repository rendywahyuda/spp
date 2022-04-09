<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Dompdf\Dompdf;
use App\Models\SiswaModel;
use App\Models\BendaharaModel;
use App\Models\KelasModel;
use App\Models\TahunPelajaranModel;
use App\Models\TransaksiModel;
use App\Models\SppKelasModel;
use App\Models\SppTahunModel;
use App\Models\SppAngkatanModel;

class Laporan extends BaseController
{
    protected $transaksiModel;
    protected $siswaModel;
    protected $kelasModel;
    protected $bendaharaModel;
    protected $sppKelasModel;
    protected $sppTahunModel;
    protected $sppAngkatanModel;

    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
        $this->siswaModel = new SiswaModel();
        $this->kelasModel = new KelasModel();
        $this->bendaharaModel = new BendaharaModel();
        $this->sppKelasModel = new SppKelasModel();
        $this->sppTahunModel = new SppTahunModel();
        $this->sppAngkatanModel = new SppAngkatanModel();
    }

    public function list_siswa($id_kelas)
    {
        $kelas = $this->sppKelasModel->getSppKelasWhere3('id_spp_kelas', $id_kelas);
        $sppKelas = $this->siswaModel->getSiswaWhere2('tahun_pelajaran', $kelas['tahun_pelajaran'], 'siswa.id_kelas', $kelas['id_kelas']);

        $data = [
            'title' => 'Data Rekap Siswa',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'siswa' => $sppKelas,
        ];

        return view('bendahara/list_siswa', $data);
    }

    public function rekap_siswa($id_kelas)
    {
        $hari = date('d');
        $tahun = date('Y');
        $bulan = date('m');

        switch ($bulan) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
            default:
                $bulan = "Tidak di ketahui";
                break;
        }

        $tanggal = "$hari $bulan $tahun";

        $wakel = $this->request->getVar('wakel');
        $kls = $this->sppKelasModel->getSppKelas2($id_kelas);
        $spp = $this->sppKelasModel->getSppKelasWhere3('id_spp_kelas', $id_kelas);
        $sppKelas = $this->siswaModel->getSiswaWhere2('tingkat', $spp['tingkat'], 'tahun_pelajaran', $spp['tahun_pelajaran'], 'siswa.id_kelas', $spp['id_kelas']);

        $data = [
            'title' => 'Rekap Keuangan Siswa',
            'siswa' => $sppKelas,
            'tanggal' => $tanggal,
            'wakel' => $wakel,
            'kelas' => $kls,
        ];

        $html = view('laporan/rekap_siswa', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        ob_clean();
        $dompdf->stream("rekap_keuangan_siswa.pdf");
    }

    public function kelas_siswa()
    {
        $tahunPelajaranModel = new TahunPelajaranModel();
        $tahunPelajaran = $tahunPelajaranModel->findAll();

        $kelasModel = new KelasModel();
        $kls = $kelasModel->findAll();

        $currentPage = $this->request->getVar('page_kelas') ? $this->request->getVar('page_kelas') : 1;

        $tahun = date('Y');
        $bulan = date('m');
        if ($bulan[1] <= 6) {
            $tapelsatu = $tahun - 1;
            $tapeldua = $tahun;
        } else {
            $tapelsatu = $tahun;
            $tapeldua = $tahun + 1;
        }

        $tapel = "$tapelsatu-$tapeldua";

        $sppKelas = $this->sppKelasModel->getSppKelasWhere4('tahun_pelajaran', $tapel);

        $data = [
            'title' => 'Data Rekap Kelas',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'pager' => $this->sppKelasModel->pager,
            'currentPage' => $currentPage,
            'siswaModel' => new SiswaModel(),
            'tahun_pelajaran' => $tahunPelajaran,
            'kelas' => $sppKelas,
            'tapel' => $tapel,
            'kls' => $kls
        ];

        return view('bendahara/kelas', $data);
    }

    public function setTapelRekap()
    {
        $tapel = $this->request->getVar('tahun_pelajaran');

        $currentPage = $this->request->getVar('page_kelas') ? $this->request->getVar('page_kelas') : 1;

        $siswaModel = new SiswaModel();
        $kelas = $this->sppKelasModel->filter($tapel);

        $no = 0 + (7 * ($currentPage - 1)); ?>
        <?php foreach ($kelas as $k) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $k['kelas']; ?></td>
                <td><?= $k['tahun_pelajaran']; ?></td>
                <td>
                    <?php $count = count($siswaModel->getSiswaWhere2('tingkat', $k['tingkat'], 'tahun_pelajaran', $k['tahun_pelajaran'], 'siswa.id_kelas', $k['id_kelas'])) ?>
                    <?php if ($count > 0) : ?>
                        <?= $count ?> siswa
                    <?php else : ?>
                        Belum Ada Siswa
                    <?php endif; ?>
                </td>
                <td><?php if ($k['biaya_pertahun'] > 0) : ?>
                        <?= $k['biaya_pertahun'] ?>
                    <?php else : ?>
                        0
                    <?php endif; ?>
                </td>
                <td><?php if ($k['total_biaya'] > 0) : ?>
                        <?= $k['total_biaya'] ?>
                    <?php else : ?>
                        0
                    <?php endif; ?></td>
                <td><?php if ($k['total_tunggakan'] > 0) : ?>
                        <?= $k['total_tunggakan'] ?>
                    <?php else : ?>
                        0
                    <?php endif; ?></td>
                <td><?php if ($k['total_transfer'] > 0) : ?>
                        <?= $k['total_transfer'] ?>
                    <?php else : ?>
                        0
                    <?php endif; ?></td>
                <td>
                    <a href="<?= base_url('/bendahara/' . $k['id_spp_kelas'] . '/laporan/rekap_siswa') ?>" type="button" class="btn btn-primary btn-sm"><i class="bx bx-printer"></i> Cetak</a>
                    <a href="<?= base_url('/bendahara/' . $k['id_spp_kelas'] . '/rekap/siswa') ?>" type="button" class="btn btn-primary btn-sm"><i class='bx bx-search' id="detail"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php
    }

    public function setKelasRekap()
    {
        $kls = $this->request->getVar('kelas');

        $currentPage = $this->request->getVar('page_kelas') ? $this->request->getVar('page_kelas') : 1;

        $siswaModel = new SiswaModel();
        $kelas = $this->sppKelasModel->filter2($kls);

        $no = 0 + (7 * ($currentPage - 1)); ?>
        <?php foreach ($kelas as $k) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td><?= $k['kelas']; ?></td>
                <td><?= $k['tahun_pelajaran']; ?></td>
                <td>
                    <?php $count = count($siswaModel->getSiswaWhere2('tingkat', $k['tingkat'], 'tahun_pelajaran', $k['tahun_pelajaran'], 'siswa.id_kelas', $k['id_kelas'])) ?>
                    <?php if ($count > 0) : ?>
                        <?= $count ?> siswa
                    <?php else : ?>
                        Belum Ada Siswa
                    <?php endif; ?>
                </td>
                <td><?php if ($k['biaya_pertahun'] > 0) : ?>
                        <?= $k['biaya_pertahun'] ?>
                    <?php else : ?>
                        0
                    <?php endif; ?>
                </td>
                <td><?php if ($k['total_biaya'] > 0) : ?>
                        <?= $k['total_biaya'] ?>
                    <?php else : ?>
                        0
                    <?php endif; ?></td>
                <td><?php if ($k['total_tunggakan'] > 0) : ?>
                        <?= $k['total_tunggakan'] ?>
                    <?php else : ?>
                        0
                    <?php endif; ?></td>
                <td><?php if ($k['total_transfer'] > 0) : ?>
                        <?= $k['total_transfer'] ?>
                    <?php else : ?>
                        0
                    <?php endif; ?></td>
                <td>
                    <a href="<?= base_url('/bendahara/' . $k['id_spp_kelas'] . '/laporan/rekap_siswa') ?>" type="button" class="btn btn-primary btn-sm"><i class="bx bx-printer"></i> Cetak</a>
                    <a href="<?= base_url('/bendahara/' . $k['id_spp_kelas'] . '/rekap/siswa') ?>" type="button" class="btn btn-primary btn-sm"><i class='bx bx-search' id="detail"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
<?php
    }

    public function rekap_keuangan()
    {
        $tahunPelajaranModel = new TahunPelajaranModel();
        $tahunPelajaran = $tahunPelajaranModel->findAll();

        $thnAngkatan = $this->sppAngkatanModel->findAll();

        $data = [
            'title' => 'Rekap Keuangan',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'tahun_pelajaran' => $tahunPelajaran,
            'angkatan' => $thnAngkatan
        ];

        return view('bendahara/rekap_keuangan', $data);
    }

    public function rekap_kelas()
    {
        $hari = date('d');
        $tahun = date('Y');
        $bulan = date('m');

        switch ($bulan) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
            default:
                $bulan = "Tidak di ketahui";
                break;
        }

        $tanggal = "$hari $bulan $tahun";

        $tingkat = $this->request->getVar('tingkat');
        $tahun_pelajaran = $this->request->getVar('tahun_pelajaran');

        if ($tingkat == 'Semua') {
            $kelas = $this->sppKelasModel->getSppKelasWhere6('tahun_pelajaran', $tahun_pelajaran);
        } else {
            $kelas = $this->sppKelasModel->getSppKelasWhere6('tahun_pelajaran', $tahun_pelajaran, 'tingkat', $tingkat);
        }

        $data = [
            'title' => 'Rekap Keuangan',
            'kelas' => $kelas,
            'tanggal' => $tanggal,
            'tapel' => $tahun_pelajaran,
            'tingkat' => $tingkat,
        ];

        $html = view('laporan/rekap_kelas', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        ob_clean();
        $dompdf->stream("rekap_keuangan_kelas.pdf");
    }

    public function rekap_tahunan()
    {
        $hari = date('d');
        $tahun = date('Y');
        $bulan = date('m');

        switch ($bulan) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
            default:
                $bulan = "Tidak di ketahui";
                break;
        }

        $tanggal = "$hari $bulan $tahun";

        $tahun_pelajaran = $this->request->getVar('tahun_pelajaran');

        $rekap = $this->sppTahunModel->getSppTahunWhere('tahun_pelajaran', $tahun_pelajaran);

        $data = [
            'title' => 'Rekap Tahunan',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'tapel' => $tahun_pelajaran,
            'tanggal' => $tanggal,
            'rekap' => $rekap
        ];

        $html = view('laporan/rekap_tahunan', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        ob_clean();
        $dompdf->stream("rekap_keuangan_tahunan.pdf");
    }

    public function rekap_angkatan()
    {
        $hari = date('d');
        $tahun = date('Y');
        $bulan = date('m');

        switch ($bulan) {
            case '01':
                $bulan = "Januari";
                break;
            case '02':
                $bulan = "Februari";
                break;
            case '03':
                $bulan = "Maret";
                break;
            case '04':
                $bulan = "April";
                break;
            case '05':
                $bulan = "Mei";
                break;
            case '06':
                $bulan = "Juni";
                break;
            case '07':
                $bulan = "Juli";
                break;
            case '08':
                $bulan = "Agustus";
                break;
            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;
            case '11':
                $bulan = "November";
                break;
            case '12':
                $bulan = "Desember";
                break;
            default:
                $bulan = "Tidak di ketahui";
                break;
        }

        $tanggal = "$hari $bulan $tahun";

        $tahun = $this->request->getVar('tahun');
        $rekap = $this->sppAngkatanModel->getSppAngkatanWhere('tahun', $tahun);

        $data = [
            'title' => 'Rekap Angkatan',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'tahun' => $tahun,
            'tanggal' => $tanggal,
            'rekap' => $rekap
        ];

        $html = view('laporan/rekap_angkatan', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        ob_clean();
        $dompdf->stream("rekap_keuangan_angkatan.pdf");
    }
}
