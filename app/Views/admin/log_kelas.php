<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>Kelas Lama</th>
                        <th>Kelas Baru</th>
                        <th>Tingkat Lama</th>
                        <th>Tingkat Baru</th>
                        <th>Status</th>
                        <th>Pengguna</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($kelas as $k) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <?php if ($k['kelas_lama'] == "") : ?>
                                <td> - </td>
                            <?php else : ?>
                                <td><?= $k['kelas_lama']; ?></td>
                            <?php endif; ?>
                            <td><?= $k['kelas_baru']; ?></td>
                            <?php if ($k['tingkat_lama'] == "") : ?>
                                <td> - </td>
                            <?php else : ?>
                                <td><?= $k['tingkat_lama']; ?></td>
                            <?php endif; ?>
                            <td><?= $k['tingkat_baru']; ?></td>
                            <td><?= $k['status']; ?></td>
                            <td><?= $k['pengguna']; ?></td>
                            <td><?= $k['waktu']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>