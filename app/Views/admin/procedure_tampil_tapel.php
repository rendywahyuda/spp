<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>Tahun Pelajaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($tapel as $tp) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $tp['tahun_pelajaran']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>