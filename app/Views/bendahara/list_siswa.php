<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th scope="col">No.</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Total Biaya</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Tunggakan</th>
                    </tr>
                </thead>
                <?php $no = 0; ?>
                <?php foreach ($siswa as $s) : ?>
                    <tr>
                        <td><?= ++$no; ?></td>
                        <td><?= $s['nis']; ?></td>
                        <td><?= $s['nama']; ?></td>
                        <td><?= $s['total_biaya']; ?></td>
                        <td><?= $s['total_transfer']; ?></td>
                        <td><?= $s['total_tunggakan']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>