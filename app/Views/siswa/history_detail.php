<?= $this->extend('layout/siswa/templateSiswa'); ?>

<?= $this->section('bodySiswa'); ?>

<div class="submenu-sidebar">
    <div class="submenu-sidebar-content-detail">
        <div class="image-bukti">
            <img src="/img/bukti_pembayaran/<?= $detail['bukti_pembayaran'] ?>" class="img-fluid rounded-start" alt="">
        </div>
        <div class="detail-content">
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">Data Pembayaran</h4>
                    <p class="card-text">Total Biaya Rp.<?= $siswa['total_biaya'] ?></p>
                    <p class="card-text">Sisa Tunggakan Rp.<?= $siswa['total_tunggakan'] ?></p>
                    <hr>
                    <p class="card-text">Jumlah Pembayaran Rp.<?= $detail['nominal_bayar']; ?></p>
                    <p class="card-text">Jenis Spp : <?= $detail['jenis_spp']; ?></p>
                    <p class="card-text">Metode Pembayaran : <?= $detail['jenis_pembayaran']; ?></p>
                    <p class="card-text">Status : <?= $detail['status']; ?></p>
                    <p class="card-text">Di Kirim Pada <?= $detail['created_at']; ?></p>
                    <!-- <p class="card-text">Di Konfirmasi Pada <?= $detail['updated_at']; ?></p> -->
                    <hr>
                    <?php if ($detail['id_bendahara'] != 0) : ?>
                        <p class="card-text">Nama Petugas : <?= $detail['nama']; ?></p>
                        <p class="card-text">No Telepon : <?= $detail['no_telepon']; ?></p>
                        <p class="card-text">Pesan : <?= $detail['notes']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endsection(); ?>