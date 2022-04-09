<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="aksi">
            <div class="aksi-content-2">
                <a href="<?= base_url('bendahara/biayaspp/tambah') ?>" class="btn btn-primary">Tambah Biaya SPP</a>
            </div>
        </div>
        <div class="container">
            <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
        </div>
        <div class="tabel">
            <table class="table">
                <thead>
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Seragam</th>
                        <th>Spp Bulanan</th>
                        <th>Uang Bangunan</th>
                        <th>Prakerin</th>
                        <th>Ujikom</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0 + (7 * ($currentPage - 1)); ?>
                    <?php foreach ($biayaSpp as $bs) : ?>
                        <tr>
                            <td><?= ++$no; ?></td>
                            <td><?= $bs['kode']; ?></td>
                            <td><?= $bs['seragam']; ?></td>
                            <td><?= $bs['spp_bulanan']; ?></td>
                            <td><?= $bs['uang_bangunan']; ?></td>
                            <td><?= $bs['prakerin']; ?></td>
                            <td><?= $bs['ujikom']; ?></td>
                            <td><?= $bs['seragam'] + $bs['spp_bulanan'] + $bs['uang_bangunan'] + $bs['prakerin'] + $bs['ujikom']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="pages">
        <?= $pager->links('biaya_spp', 'pagination'); ?>
    </div>
</footer>

<?= $this->endsection(); ?>