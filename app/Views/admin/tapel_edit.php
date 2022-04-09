<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="card-crud">
    <div class="card-crud-content">
        <div class="card text-center">
            <div class="card-header">
                Form Ubah Data Tahun Pelajaran
            </div>
            <div class="card-body">
                <form action="/tahunpelajaran/update/<?= $tapel['id_tahun_pelajaran'] ?>" method="post">
                    <input type="hidden" name='id' value="<?= $tapel['id_tahun_pelajaran'] ?>">
                    <input type='hidden' name='oldTapel' value="<?= $tapel['tahun_pelajaran'] ?>">
                    <div class="row mb-3">
                        <label for="tahun_pelajaran" class="col-sm-2 col-form-label">Tahun Pelajaran</label>
                        <div class="col-sm-10">
                            <select name="tahun_pelajaran" class="form-control <?= ($validation->hasError('tahun_pelajaran')) ? 'is-invalid' : ''; ?>" id="tahun_pelajaran" value="<?= (old('tahun_pelajaran')) ? old('tahun_pelajaran') : $tapel['tahun_pelajaran'] ?>" required>
                                <option value="<?= $tapel['tahun_pelajaran']; ?>" disabled selected hidden><?= $tapel['tahun_pelajaran']; ?></option>
                                <?php foreach ($tahun_pelajaran as $tp) : ?>
                                    <option value="<?= $tp ?>">Tahun Pelajaran <?= $tp ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('tahun_pelajaran'); ?></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endsection(); ?>