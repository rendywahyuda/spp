<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="aksi">
            <div class="aksi-content">
                <a href="<?= base_url('admin/kelas/tambah') ?>" type="button" class="btn btn-primary">Tambah Kelas</a>
            </div>
        </div>
        <div class="container">
            <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
        </div>
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th scope="col">No.</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <?php $no = 1 + (6 * ($currentPage - 1)); ?>
                <?php foreach ($kelas as $k) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $k['kelas']; ?></td>
                        <td>
                            <a href="<?= base_url('/admin/' . $k['id_kelas'] . '/kelas/edit') ?>" type="button" class="btn btn-success btn-sm"><i class='bx bx-pencil' id="update"></i></a>
                            <a href="<?= base_url('/admin/' . $k['id_kelas'] . '/kelas/delete') ?>" type="button" class="btn btn-danger btn-sm btn-delete"><i class='bx bx-trash' id="delete"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="pages">
        <?= $pager->links('kelas', 'pagination'); ?>
    </div>
</footer>

<?= $this->endsection(); ?>