<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="aksi">
            <div class="aksi-content">
                <a href="<?= base_url('admin/tahun_pelajaran/tambah') ?>" type="button" class="btn btn-primary">Tambah Tahun Pelajaran</a>
            </div>
        </div>
        <div class="container">
            <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
            <div class="swall" data-swall="<?= session()->get('info') ?>"></div>
        </div>
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th scope="col">No.</th>
                        <th scope="col">Tahun Pelajaran</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <?php $no = 1 + (6 * ($currentPage - 1)); ?>
                <?php foreach ($tapel as $tp) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $tp['tahun_pelajaran']; ?></td>
                        <td>
                            <a href="<?= base_url('/admin/' . $tp['id_tahun_pelajaran'] . '/tahun_pelajaran/edit') ?>" type="button" class="btn btn-success btn-sm"><i class='bx bx-pencil' id="update"></i></a>
                            <a href="<?= base_url('/admin/' . $tp['id_tahun_pelajaran'] . '/tahun_pelajaran/delete') ?>" type="button" class="btn btn-danger btn-sm btn-delete"><i class='bx bx-trash' id="delete"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="pages">
        <?= $pager->links('tahun_pelajaran', 'pagination'); ?>
    </div>
</footer>

<?= $this->endsection(); ?>