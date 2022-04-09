<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="aksi">
            <div class="aksi-content">
                <a href="<?= base_url("bendahara/laporan/rekap_keuangan") ?>" class='btn btn-primary'>Rekap Keuangan</a>
            </div>
            <div class="filter">
                <div class="filter-content">
                    <select name="tahun_pelajaran" class="form-select" aria-label="Default select example" id="tahun_pelajaran" value="">
                        <option value="" disabled selected hidden>Tahun Pelajaran</option>
                        <?php foreach ($tahun_pelajaran as $tp) : ?>
                            <option value="<?= $tp['tahun_pelajaran']; ?>">Tahun Pelajaran <?= $tp['tahun_pelajaran']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="filter2">
                <div class="filter-content">
                    <select name="kelas" class="form-select" aria-label="Default select example" id="kelas" value="">
                        <option value="" disabled selected hidden>Kelas</option>
                        <?php foreach ($kls as $k) : ?>
                            <option value="<?= $k['kelas']; ?>"><?= $k['kelas']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="tabel">
            <table class="table text-center" id="RekapKelas">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th scope="col">No.</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Tahun Pelajaran</th>
                        <th scope="col">Jumlah Siswa</th>
                        <th scope="col">Biaya 1 Tahun</th>
                        <th scope="col">Total Biaya</th>
                        <th scope="col">Total Tunggakan</th>
                        <th scope="col">Total Dibayar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <?php $no = 0 + (7 * ($currentPage - 1)); ?>
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
                            <a href="<?= base_url('/bendahara/' . $k['id_spp_kelas'] . '/laporan/rekap_siswa') ?>" type="button" class="btn btn-primary btn-sm rekap"><i class="bx bx-printer"></i> Cetak</a>
                            <a href="<?= base_url('/bendahara/' . $k['id_spp_kelas'] . '/rekap/siswa') ?>" type="button" class="btn btn-primary btn-sm rekap"><i class='bx bx-search' id="detail"></i> Lihat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="pages">
        <?= $pager->links('kelas', 'pagination'); ?>
    </div>
</footer>

<?= $this->endsection(); ?>