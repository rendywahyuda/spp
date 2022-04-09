<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="aksi">
            <div class="aksi-content">
                <a href="<?= base_url('admin/bendahara/tambah') ?>" type="button" class="btn btn-primary">Tambah Petugas</a>
            </div>
            <form action="" method="get" class="pencarian">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Disini ..." name="keyword" id="keyword">
                    <button class="input-group-text" name="submit" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
        </div>
        <div class="container">
            <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
        </div>
        <div class="tabel">
            <table class="table">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <?php $no = 1 + (6 * ($currentPage - 1)); ?>
                <?php foreach ($petugas as $p) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p['nip']; ?></td>
                        <td><?= $p['nama']; ?></td>
                        <td><?= $p['no_telepon']; ?></td>
                        <td>
                            <a href="<?= base_url('/admin/' . $p['id_bendahara'] . '/bendahara/edit') ?>" type="button" class="btn btn-success btn-sm"><i class='bx bx-pencil'></i></a>
                            <a href="<?= base_url('/admin/' . $p['id_bendahara'] . '/bendahara/delete') ?>" type="button" class="btn btn-danger btn-sm btn-delete" id="delete"><i class='bx bx-trash'></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="pages">
        <?= $pager->links('bendahara', 'pagination'); ?>
    </div>
</footer>

<?= $this->endsection(); ?>