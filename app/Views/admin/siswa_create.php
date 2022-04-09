<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="card-crud">
    <div class="card-crud-content">
        <div class="card text-center">
            <div class="card-header">
                Form Tambah Siswa
            </div>
            <div class="card-body">
                <form action="/siswa/store" method="post">
                    <div class="row mb-3">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" name="nis" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" id="nis" value="<?= set_value('nis'); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nis'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" value="<?= set_value('nama'); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select name="id_kelas" class="form-control <?= ($validation->hasError('id_kelas')) ? 'is-invalid' : ''; ?>" id="id_kelas" value="<?= set_value('id_kelas'); ?>" required>
                                <option value="" disabled selected hidden>Pilih Kelas ...</option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['id_kelas'] ?>"><?= $k['kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('id_kelas'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select name="jurusan" class="form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : ''; ?>" value="<?= set_value('jurusan'); ?>" id='jurusan' required>
                                <option value="" disabled selected hidden>Pilih Jurusan ...</option>
                                <?php foreach ($jurusan as $j) : ?>
                                    <option value="<?= $j ?>"><?= $j ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('jurusan'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun_pelajaran" class="col-sm-2 col-form-label">Tahun Pelajaran</label>
                        <div class="col-sm-10">
                            <select name="tahun_pelajaran" class="form-control" id="tahun_pelajaran" value="<?= set_value('tahun_pelajaran'); ?>" required>
                                <option value="" disabled selected hidden>Pilih Tahun Pelajaran ...</option>
                                <?php foreach ($tahun_pelajaran as $tp) : ?>
                                    <option value="<?= $tp ?>">Tahun Pelajaran <?= $tp ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('id_tahun_pelajaran'); ?></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
            </div>
        </div>

        <?= $this->endsection(); ?>