<?= $this->extend('layout/siswa/templateSiswa'); ?>

<?= $this->section('bodySiswa'); ?>

<?= $validation->listErrors(); ?>
<div class="transaksi">
    <div class="transaksi-content">
        <div class="tabel">
            <div class="title-tabel">
                <h4>Transaksi Pembayaran</h4>
            </div>
            <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
            <form action="/transaksi/transaksi_save" method="post" enctype="multipart/form-data" class="form-transaksi">
                <input type='hidden' name='id_siswa' id='id_siswa' value=""> <br>
                <input type='hidden' name='id' id='id' value=""> <br>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Nama Siswa</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $siswa['nama']; ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="spp_bulan" class="col-sm-3 col-form-label">Bulan</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="spp_bulan" required>
                            <option value="" disabled selected hidden>Pilih Bulan ...</option>
                            <?php foreach ($bulan as $m) : ?>
                                <option value="<?= $m ?>"><?= $m; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nominal_bayar" class="col-sm-3 col-form-label">Nominal Bayar</label>
                    <div class="col-sm-9">
                        <input type="text" name="nominal_bayar" class="form-control <?= ($validation->hasError('nominal_bayar')) ? 'is-invalid' : ''; ?>" id="nominal_bayar" value="<?= set_value('nominal_bayar'); ?>" required>
                        <div class="invalid-feedback"><?= $validation->getError('nominal_bayar'); ?></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenis_spp" class="col-sm-3 col-form-label">Jenis Spp</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="jenis_spp" id="jenis_spp" required>
                            <option value="" disabled selected hidden>Pilih Jenis Spp ...</option>
                            <?php foreach ($spp as $s) : ?>
                                <option value="<?= $s; ?>"><?= $s; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jenis_pembayaran" class="col-sm-3 col-form-label">Jenis Pembayaran</label>
                    <div class="col-sm-9">
                        <input type="text" name="jenis_pembayaran" class="form-control <?= ($validation->hasError('jenis_pembayaran')) ? 'is-invalid' : ''; ?>" id="jenis_pembayaran" value="<?= set_value('jenis_pembayaran'); ?>" required>
                        <div class="invalid-feedback"><?= $validation->getError('jenis_pembayaran'); ?></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="bukti_pembayaran" class="col-sm-3 col-form-label">Bukti Pembayaran</label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control <?= ($validation->hasError('bukti_pembayaran')) ? 'is-invalid' : ''; ?>" id="bukti_pembayaran" name="bukti_pembayaran" required>
                        <div class="invalid-feedback"><?= $validation->getError('bukti_pembayaran'); ?></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Kirim</button>
            </form>
        </div>
    </div>
</div>


<?= $this->endsection(); ?>