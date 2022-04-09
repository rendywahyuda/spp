<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="card-crud">
    <div class="card-crud-content">
        <div class="card text-center">
            <div class="card-header">
                Form Ubah Data Bendahara
            </div>
            <div class="card-body">
                <form action="/bendahara/update/<?= $bendahara['id_bendahara'] ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name='id' value="<?= $bendahara['id_bendahara'] ?>">
                    <input type='hidden' name='oldNip' value="<?= $bendahara['nip'] ?>">
                    <div class="row mb-3">
                        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <input type="text" name="nip" class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : ''; ?>" id="nip" value="<?= (old('nip')) ? old('nip') : $bendahara['nip'] ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nip'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" value="<?= (old('nama')) ? old('nama') : $bendahara['nama'] ?>">
                            <div class="invalid-feedback"><?= $validation->getError('nama'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_telepon" class="col-sm-2 col-form-label">No. Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" name="no_telepon" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : ''; ?>" id="no_telepon" value="<?= (old('no_telepon')) ? old('no_telepon') : $bendahara['no_telepon'] ?>">
                            <div class="invalid-feedback"><?= $validation->getError('no_telepon'); ?></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>