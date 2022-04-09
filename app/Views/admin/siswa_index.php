<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="sidebar-menu">
    <div class="sidebar-menu-content">
        <div class="aksi">
            <div class="aksi-content">
                <a href="<?= base_url('admin/siswa/tambah') ?>" class='btn btn-primary'>Tambah Siswa</a>
            </div>
            <form action="" method="get" class="pencarian">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari Disini ..." name="keyword" id="keyword">
                    <button class="input-group-text" name="submit" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <div class="filter2">
                <div class="filter-content">
                    <select name="kelas" class="form-select" aria-label="Default select example" id="kelas" value="">
                        <option value="" disabled selected hidden>Kelas</option>
                        <?php foreach ($kelas as $k) : ?>
                            <option value="<?= $k['kelas']; ?>"><?= $k['kelas']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
        </div>
        <div class="tabel">
            <table class="table" id="siswaTable">
                <thead class="thead-dark">
                    <tr class="table-dark">
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Tahun Pelajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + (6 * ($currentPage - 1)); ?>
                    <?php foreach ($siswa as $s) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $s['nis']; ?></td>
                            <td><?= $s['nama']; ?></td>
                            <td><?= $s['kelas']; ?></td>
                            <td><?= $s['jurusan']; ?></td>
                            <td><?= $s['tahun_pelajaran']; ?></td>
                            <td>
                                <a href="<?= base_url('/admin/' . $s['id_siswa'] . '/siswa/edit') ?>" class="btn btn-success btn-sm"><i class='bx bx-pencil' id="update"></i></a>
                                <!-- <a href="<?= base_url('/admin/' . $s['id_siswa'] . '/siswa/delete') ?>" class="btn btn-danger btn-sm btn-delete"><i class='bx bx-trash' id="delete"></i></a> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer>
    <div class="pages">
        <?= $pager->links('siswa', 'pagination'); ?>
    </div>
</footer>

<?= $this->endsection(); ?>