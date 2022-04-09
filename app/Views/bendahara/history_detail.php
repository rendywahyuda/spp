<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="submenu-sidebar">
    <div class="submenu-sidebar-content-detail">
        <div class="image-bukti">
            <img src="/img/bukti_pembayaran/<?= $detail['bukti_pembayaran'] ?>" class="img-fluid rounded-start" alt="">
        </div>
        <div class="detail-content">
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">Data Pembayaran</h4>
                    <p class="card-text">NIS : <?= $detail['nis']; ?></p>
                    <p class="card-text">Nama : <?= $detail['nama_siswa']; ?></p>
                    <p class="card-text">Total Pembayaran Rp.<?= $detail['nominal_bayar']; ?></p>
                    <p class="card-text">Jenis Spp : <?= $detail['jenis_spp']; ?></p>
                    <div class="spp-bagian mb-3">
                        <p class="card-text">Sisa Tunggakan : </p>
                        <?php foreach ($tes as $b) : ?>
                            <div class="form-check">
                                <!-- <input class="form-check-input" type="checkbox" <?= $b['opt'] ?> name="<?= $b['lable'] ?>" value="<?= $b['nemval'] ?>" id="<?= $b['nemval'] ?>"> -->
                                <label class="form-check-label" for="<?= $b['nemval'] ?>"><?= $b['lable']; ?> | <?= $b['jmlh']; ?></label><br>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <p class="card-text">Nama Petugas : <?= $bendahara['nama']; ?></p>
                    <p class="card-text">Di Konfirmasi Pada <?= $detail['updated_at']; ?></p>
                    <p class="card-text">Status : <?= $detail['status']; ?></p>
                    <p class="card-text mb-4">Notes : <?= $detail['notes']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>