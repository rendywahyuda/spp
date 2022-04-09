<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($bendahara as $b) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['nip']; ?></td>
                            <td><?= $b['nama']; ?></td>
                            <td><?= $b['no_telepon']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>