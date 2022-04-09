<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>NIS Lama</th>
                        <th>NIS Baru</th>
                        <th>Nama Lama</th>
                        <th>Nama Baru</th>
                        <th>Jurusan Lama</th>
                        <th>Jurusan Baru</th>
                        <th>Status</th>
                        <th>Pengguna</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($siswa as $s) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <?php if ($s['nis_lama'] == "") : ?>
                                <td> - </td>
                            <?php else : ?>
                                <td><?= $s['nis_lama']; ?></td>
                            <?php endif; ?>
                            <td><?= $s['nis_baru']; ?></td>
                            <?php if ($s['nama_lama'] == "") : ?>
                                <td> - </td>
                            <?php else : ?>
                                <td><?= $s['nama_lama']; ?></td>
                            <?php endif; ?>
                            <td><?= $s['nama_baru']; ?></td>
                            <?php if ($s['jurusan_lama'] == "") : ?>
                                <td> - </td>
                            <?php else : ?>
                                <td><?= $s['jurusan_lama']; ?></td>
                            <?php endif; ?>
                            <td><?= $s['jurusan_baru']; ?></td>
                            <td><?= $s['status']; ?></td>
                            <td><?= $s['pengguna']; ?></td>
                            <td><?= $s['waktu']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>