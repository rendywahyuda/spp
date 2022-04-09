<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Kelas</th>
                        <th>Tunggakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($siswa as $s) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $s['nis']; ?></td>
                            <td><?= $s['nama']; ?></td>
                            <td><?= $s['jurusan']; ?></td>
                            <td><?= $s['tingkat_kelas']; ?></td>
                            <?php if ($s['tunggakan'] == null) : ?>
                                <td>0</td>
                            <?php else : ?>
                                <td><?= $s['tunggakan']; ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>