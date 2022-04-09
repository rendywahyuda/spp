<?= $this->extend('layout/siswa/templateSiswa'); ?>

<?= $this->section('bodySiswa'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="aksi mb-3">
            <!-- <form action="" method="get" class="pencarian">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Disini ..." name="keyword" id="keyword">
                    <button class="input-group-text" name="submit" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form> -->
            <div class="filter">
                <div class="filter-content">
                    <select name="tahun_pelajaran" class="form-select" aria-label="Default select example" id="tahun_pelajaran" value="">
                        <option value="" disabled selected hidden>Tahun Pelajaran</option>
                        <?php foreach ($tapel as $t) : ?>
                            <option value="<?= $t['tahun_pelajaran'] ?>">Tahun Pelajaran <?= $t['tahun_pelajaran']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="filter2">
                <div class="filter-content">
                    <select name="bulan" class="form-select" aria-label="Default select example" id="bulan" value="">
                        <option value="" disabled selected hidden>Bulan</option>
                        <?php foreach ($bulan as $m) : ?>
                            <option value="<?= $m ?>"><?= $m; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="tabel">
            <table class="table" id="historySiswaPending">
                <thead>
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>Bulan</th>
                        <th>Tahun Pelajaran</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 + (7 * ($currentPage - 1)); ?>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="pages">
        <?= $pager->links('transaksi', 'pagination'); ?>
    </div>
</footer>

<?= $this->endsection(); ?>