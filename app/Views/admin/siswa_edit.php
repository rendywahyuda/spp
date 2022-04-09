<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="card-crud">
    <div class="card-crud-content">
        <div class="card text-center">
            <div class="card-header">
                Form Ubah Data Siswa
            </div>
            <div class="card-body">
                <form action="/siswa/update/<?= $siswa['id_siswa'] ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name='id' value="<?= $siswa['id_siswa'] ?>">
                    <input type='hidden' name='oldNis' value="<?= $siswa['nis'] ?>">
                    <div class="row mb-3">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" name="nis" class="form-control <?= ($validation->hasError('nis')) ? 'is-invalid' : ''; ?>" id="nis" value="<?= (old('nis')) ? old('nis') : $siswa['nis'] ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nis'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" value="<?= (old('nama')) ? old('nama') : $siswa['nama'] ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="id_kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select name="id_kelas" class="form-control" id="id_kelas" value="<?= set_value('id_kelas'); ?>" required>
                                <option value="<?= $siswa['id_kelas']; ?>" hidden><?= $siswa['kelas']; ?></option>
                                <?php foreach ($kelas as $k) : ?>
                                    <option value="<?= $k['id_kelas'] ?>"><?= $k['kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('kelas'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-10">
                            <select name="jurusan" class="form-control <?= ($validation->hasError('jurusan')) ? 'is-invalid' : ''; ?>" value="<?= (old('jurusan')) ? old('jurusan') : $siswa['jurusan'] ?>" id='jurusan' required>
                                <option value="<?= $siswa['jurusan']; ?>" hidden><?= $siswa['jurusan']; ?></option>
                                <?php foreach ($jurusan as $j) : ?>
                                    <option value="<?= $j ?>"><?= $j ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('jurusan'); ?></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Ubah</button>
                </form>
            </div>
        </div>


        <?= $this->endsection(); ?>