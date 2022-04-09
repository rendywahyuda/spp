<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="card-crud">
    <div class="card-crud-content">
        <div class="card text-center">
            <div class="card-header">
                Form Tambah Spp
            </div>
            <div class="container">
                <div class="swall" data-swall="<?= session()->get('message') ?>"></div>
            </div>
            <div class="card-body">
                <form action="/spp/store" method="post">
                    <div class="container">
                        <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
                    </div>
                    <div class="row mb-3">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select name="kelas" class="form-control <?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?>" id="" value="<?= set_value('kelas'); ?>" id='kelas' required>
                                <option value="" disabled selected hidden>Pilih Kelas ...</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('kelas'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="tahun_pelajaran" class="col-sm-2 col-form-label">Tahun Pelajaran</label>
                        <div class="col-sm-10">
                            <select name="tahun_pelajaran" class="form-control <?= ($validation->hasError('tahun_pelajaran')) ? 'is-invalid' : ''; ?>" id="" value="<?= set_value('tahun_pelajaran'); ?>" id='tahun_pelajaran' required>
                                <option value="" disabled selected hidden>Pilih Tahun Pelajaran ...</option>
                                <?php foreach ($tapel as $tp) : ?>
                                    <option value="<?= $tp ?>"><?= $tp; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('tahun_pelajaran'); ?></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="biaya_spp" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-10">
                            <select name="biaya_spp" class="form-control <?= ($validation->hasError('id_biaya_spp')) ? 'is-invalid' : ''; ?>" id="" value="<?= set_value('biaya_spp'); ?>" id='nama' required>
                                <option value="" disabled selected hidden>Pilih (Kelas-Tahun Pelajaran | Total Nominal) ...</option>
                                <?php foreach ($biayaSpp as $bs) : ?>
                                    <option value="<?= $bs['id_biaya_spp'] ?>">Kelas <?= $bs['kode']; ?> | <?= $bs['seragam'] + $bs['uang_bangunan'] + $bs['spp_bulanan'] + $bs['prakerin'] + $bs['ujikom']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('id_biaya_spp'); ?></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>