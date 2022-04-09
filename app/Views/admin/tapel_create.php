<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="card-crud">
    <div class="card-crud-content">
        <div class="card text-center">
            <div class="card-header">
                Form Tambah Tahun Pelajaran
            </div>
            <div class="card-body">
                <form action="/tahunpelajaran/store" method="post">
                    <div class="row mb-3">
                        <label for="tahun_pelajaran" class="col-sm-2 col-form-label">Tahun Pelajaran</label>
                        <div class="col-sm-10">
                            <select name="tahun_pelajaran" class="form-control" id="tahun_pelajaran" value="<?= set_value('tahun_pelajaran'); ?>" required>
                                <option value="" disabled selected hidden>Pilih Tahun Pelajaran ...</option>
                                <?php foreach ($tapel as $tp) : ?>
                                    <option value="<?= $tp ?>">Tahun Pelajaran <?= $tp ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('tahun_pelajaran'); ?></div>
                        </div>
                    </div>
                    <button type="submit" type="button" class="btn btn-success ">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>