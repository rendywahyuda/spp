<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>NIP Lama</th>
                        <th>NIP Baru</th>
                        <th>Nama Lama</th>
                        <th>Nama Baru</th>
                        <th>No. Telepon Lama</th>
                        <th>No. Telepon Baru</th>
                        <th>Status</th>
                        <th>Pengguna</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($bendahara as $b) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <?php if ($b['nip_lama'] == "") : ?>
                                <td> - </td>
                            <?php else : ?>
                                <td><?= $b['nip_lama']; ?></td>
                            <?php endif; ?>
                            <td><?= $b['nip_baru']; ?></td>
                            <?php if ($b['nama_lama'] == "") : ?>
                                <td> - </td>
                            <?php else : ?>
                                <td><?= $b['nama_lama']; ?></td>
                            <?php endif; ?>
                            <td><?= $b['nama_baru']; ?></td>
                            <?php if ($b['no_telepon_lama'] == "") : ?>
                                <td> - </td>
                            <?php else : ?>
                                <td><?= $b['no_telepon_lama']; ?></td>
                            <?php endif; ?>
                            <td><?= $b['no_telepon_baru']; ?></td>
                            <td><?= $b['status']; ?></td>
                            <td><?= $b['pengguna']; ?></td>
                            <td><?= $b['waktu']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>