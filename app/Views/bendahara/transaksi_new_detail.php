<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="submenu-sidebar">
    <div class="submenu-sidebar-content-detail2">
        <div class="image-bukti">
            <img src="/img/bukti_pembayaran/<?= $transaksi['bukti_pembayaran'] ?>" class="img-fluid rounded-start" alt="">
        </div>
        <div class="detail-content2">
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">Data Pembayaran</h4>
                    <p class="card-text">Nama : <?= $transaksi['nama']; ?></p>
                    <p class="card-text">Nis : <?= $transaksi['nis']; ?></p>
                    <p class="card-text">Jenis Spp : <?= $transaksi['jenis_spp']; ?></p>
                    <p class="card-text">Nominal : Rp.<?= $transaksi['nominal_bayar']; ?></p>
                    <p class="card-text">Metode Pembayaran : <?= $transaksi['jenis_pembayaran']; ?></p>
                    <hr>
                    <form action="/transaksi/transaksi_confirm/<?= $transaksi['id_transaksi'] ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_spp" value="<?= $transaksi['id_spp'] ?>">
                        <input type="hidden" name="id_tunggakan" value="<?= $transaksi['id_tunggakan'] ?>">
                        <input type="hidden" name="id_bendahara" value="<?= session()->get('id_bendahara') ?>">
                        <input type="hidden" name="id_siswa" value="<?= $transaksi['id_siswa'] ?>">
                        <input type="hidden" name="nominal_bayar" value="<?= $transaksi['nominal_bayar'] ?>">
                        <div class="spp-bagian mb-3">
                            <p class="card-text">Sisa Tunggakan : </p>
                            <?php foreach ($biaya as $b) : ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" <?= $b['opt'] ?> name="jenis_spp" value="<?= $b['nemval'] ?>" id="<?= $b['nemval'] ?>">
                                    <label class="form-check-label" for="<?= $b['nemval'] ?>"><?= $b['lable']; ?> | <?= $b['jmlh']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- <select name="spp_bagian" class="form-control mb-3" value="<?= set_value('spp_bagian'); ?>" required>
                            <option value="" disabled selected hidden>Pilih Jenis Spp ...</option>
                            <option value="Seragam">Seragam</option>
                            <option value="Bangunan">Uang Bangunan</option>
                            <option value="Bulanan">Spp Bulanan</option>
                            <option value="Prakerin">Prakerin</option>
                            <option value="Ujikom">Ujikom</option>
                        </select> -->
                        <select name="status" class="form-control mb-3" value="<?= set_value('status'); ?>" required>
                            <option value="" disabled selected hidden>Pilih Status ...</option>
                            <option value="accept">Accept</option>
                            <option value="reject">Reject</option>
                        </select>
                        <div class="row mb-3">
                            <label for="notes" class="col-sm-3 col-form-label">Pesan</label>
                            <div class="col-sm-9">
                                <input type="text" name="notes" class="form-control" id="notes">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm my-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>