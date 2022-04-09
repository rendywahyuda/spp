<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="aksi">
            <form action="" method="get" class="pencarian">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Disini ..." name="keyword" id="keyword">
                    <button class="input-group-text" name="submit" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <div class="filter2">
                <div class="filter-content">
                    <select name="kelas" class="form-select" aria-label="Default select example" id="kelas" value="">
                        <option value="" disabled selected hidden>Kelas</option>
                        <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k['kelas']; ?>"><?= $k['kelas']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
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
        </div>
        <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
        <div class="tabel">
            <table class="table" id="transaksi">
                <thead>
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Bulan</th>
                        <th>Tahun Pelajaran</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 + (7 * ($currentPage - 1));  ?>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="pages">
        <?= $pager->links('history', 'pagination'); ?>
    </div>
</footer>

<?= $this->endsection(); ?>