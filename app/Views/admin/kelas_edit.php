<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="card-crud">
    <div class="card-crud-content">
        <div class="card text-center">
            <div class="card-header">
                Form Ubah Data Kelas
            </div>
            <div class="card-body">
                <form action="/kelas/update/<?= $kelas['id_kelas'] ?>" method="post">
                    <input type="hidden" name='id' value="<?= $kelas['id_kelas'] ?>">
                    <input type='hidden' name='oldKelas' value="<?= $kelas['kelas'] ?>">
                    <div class="row mb-3">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" name="kelas" class="form-control <?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" value="<?= (old('kelas')) ? old('kelas') : $kelas['kelas'] ?>">
                            <div class="invalid-feedback"><?= $validation->getError('kelas'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tingkat" class="col-sm-2 col-form-label">Tingkat</label>
                        <div class="col-sm-10">
                            <select name="tingkat" class="form-control <?= ($validation->hasError('tingkat')) ? 'is-invalid' : ''; ?>" value="<?= (old('tingkat')) ? old('tingkat') : $kelas['tingkat'] ?>" id='tingkat'>
                                <option value="<?= $kelas['tingkat']; ?>" hidden><?= $kelas['tingkat']; ?></option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('tingkat'); ?></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endsection(); ?>