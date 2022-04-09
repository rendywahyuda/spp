<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>Tahun Pelajaran Lama</th>
                        <th>Tahun Pelajaran Baru</th>
                        <th>Status</th>
                        <th>Pengguna</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($tahun_pelajaran as $tapel) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <?php if ($tapel['tahun_pelajaran_lama'] == "") : ?>
                                <td> - </td>
                            <?php else : ?>
                                <td><?= $tapel['tahun_pelajaran_lama']; ?></td>
                            <?php endif; ?>
                            <td><?= $tapel['tahun_pelajaran_baru']; ?></td>
                            <td><?= $tapel['status']; ?></td>
                            <td><?= $tapel['pengguna']; ?></td>
                            <td><?= $tapel['waktu']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>