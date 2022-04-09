<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="aksi">
            <div class="aksi-content-2">
                <a href="<?= base_url('bendahara/spp/tambah') ?>" class="btn btn-primary">Tambah SPP</a>
                <a href="<?= base_url('bendahara/biayaspp') ?>" class="btn btn-primary">Biaya SPP</a>
            </div>
        </div>
        <div class="container">
            <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
        </div>
        <div class="tabel">
            <table class="table" id="siswaTable">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>Tahun Pelajaran</th>
                        <th>Tingkat Kelas</th>
                        <th>Seragam</th>
                        <th>SPP</th>
                        <th>Bangunan</th>
                        <th>Ujikom</th>
                        <th>Prakerin</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + (7 * ($currentPage - 1)); ?>
                    <?php foreach ($detail_biaya as $db) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $db['tahun_pelajaran']; ?></td>
                            <td><?= $db['tingkat']; ?></td>
                            <td><?= $db['seragam']; ?></td>
                            <td><?= $db['uang_bangunan']; ?></td>
                            <td><?= $db['spp_bulanan']; ?></td>
                            <td><?= $db['prakerin']; ?></td>
                            <td><?= $db['ujikom']; ?></td>
                            <td><?= $db['seragam'] + $db['uang_bangunan'] + $db['spp_bulanan'] + $db['prakerin'] + $db['ujikom']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="pages">
        <?= $pager->links('detail_spp', 'pagination'); ?>
    </div>
</footer>

<?= $this->endsection(); ?>