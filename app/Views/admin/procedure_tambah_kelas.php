<?= $this->extend('layout/admin/templateAdmin'); ?>

<?= $this->section('bodyAdmin'); ?>

<div class="card-crud">
    <div class="card-crud-content">
        <div class="card text-center">
            <div class="card-header">
                Procedure Insert Kelas
            </div>
            <div class="card-body">
                <form action="/kelas/insertKelasStore" method="post">
                    <ul style="list-style: none; color: red;">
                        <li><?= session()->get('errors') ?></li>
                    </ul>
                    <ul style="list-style: none; color: green;">
                        <li><?= session()->get('success') ?></li>
                    </ul>
                    <div class="row mb-3">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" name="kelas" class="form-control" id="kelas">
                            <div class="invalid-feedback"><?= $validation->getError('kelas'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tingkat" class="col-sm-2 col-form-label">Tingkat</label>
                        <div class="col-sm-10">
                            <input type="text" name="tingkat" class="form-control" id="tingkat">
                            <div class="invalid-feedback"><?= $validation->getError('tingkat'); ?></div>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-success ">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>