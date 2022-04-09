<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="card-crud">
    <div class="card-crud-content">
        <div class="card text-center">
            <div class="card-header">
                Form Tambah Biaya Spp
            </div>
            <div class="card-body">
                <form action="/biayaspp/store" method="post">
                    <div class="row mb-3">
                        <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10">
                            <select name="kode" class="form-control <?= ($validation->hasError('kode')) ? 'is-invalid' : ''; ?>" id="kode" value="<?= set_value('kode'); ?>" id='kode'>
                                <option value="" disabled selected hidden>Pilih (Kelas - Tahun Pelajaran) ...</option>
                                <?php foreach ($tapel as $tp) : ?>
                                    <option value="10-<?= $tp ?>">10 - <?= $tp; ?></option>
                                <?php endforeach; ?>
                                <?php foreach ($tapel as $tp) : ?>
                                    <option value="11-<?= $tp ?>">11 - <?= $tp; ?></option>
                                <?php endforeach; ?>
                                <?php foreach ($tapel as $tp) : ?>
                                    <option value="12-<?= $tp ?>">12 - <?= $tp; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('kode'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="seragam" class="col-sm-2 col-form-label">Seragam</label>
                        <div class="col-sm-10">
                            <input type="text" name="seragam" class="form-control <?= ($validation->hasError('seragam')) ? 'is-invalid' : ''; ?>" id="seragam" value="<?= set_value('seragam'); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('seragam'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="spp_bulanan" class="col-sm-2 col-form-label">Spp Bulanan</label>
                        <div class="col-sm-10">
                            <input type="text" name="spp_bulanan" class="form-control <?= ($validation->hasError('spp_bulanan')) ? 'is-invalid' : ''; ?>" id="spp_bulanan" value="<?= set_value('spp_bulanan'); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('spp_bulanan'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="uang_bangunan" class="col-sm-2 col-form-label">Uang Bangunan</label>
                        <div class="col-sm-10">
                            <input type="text" name="uang_bangunan" class="form-control <?= ($validation->hasError('uang_bangunan')) ? 'is-invalid' : ''; ?>" id="uang_bangunan" value="<?= set_value('uang_bangunan'); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('uang_bangunan'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="prakerin" class="col-sm-2 col-form-label">Prakerin</label>
                        <div class="col-sm-10">
                            <input type="text" name="prakerin" class="form-control <?= ($validation->hasError('prakerin')) ? 'is-invalid' : ''; ?>" id="prakerin" value="<?= set_value('prakerin'); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('prakerin'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="ujikom" class="col-sm-2 col-form-label">Ujikom</label>
                        <div class="col-sm-10">
                            <input type="text" name="ujikom" class="form-control <?= ($validation->hasError('ujikom')) ? 'is-invalid' : ''; ?>" id="ujikom" value="<?= set_value('ujikom'); ?>">
                            <div class="invalid-feedback"><?= $validation->getError('ujikom'); ?></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>