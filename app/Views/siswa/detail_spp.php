<?= $this->extend('layout/siswa/templateSiswa'); ?>

<?= $this->section('bodySiswa'); ?>

<?php $uri = service('uri') ?>

<div class="detail-spp">
    <div class="detail-content">
        <div class="kiri">
            <div class="content-1">
                <div class="detail-box-icon">
                    <i class="bx bx-data"></i>
                </div>
                <div class="detail-box">
                    <h6>Total Biaya Spp</h6>
                    <?php if ($siswa['total_biaya'] == NULL) : ?>
                        <p>0</p>
                    <?php else : ?>
                        <p><?= $siswa['total_biaya']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="content-2">
                <div class="detail-box-icon">
                    <i class="bx bx-money"></i>
                </div>
                <div class="detail-box">
                    <h6>Total Bayar | Tunggakan</h6>
                    <?php if ($siswa['total_tunggakan'] == NULL) : ?>
                        <p><?= $siswa['total_transfer']; ?> | 0</p>
                    <?php else : ?>
                        <p><?= $siswa['total_transfer']; ?> | <?= $siswa['total_tunggakan']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="kanan">
            <div class="content-3">
                <div class="detail-box-icon">
                    <i class="fas fa-tshirt baju"></i>
                </div>
                <div class="detail-box">
                    <h6>Seragam</h6>
                    <p>
                        <?php if ($biaya['t_seragam'] > 0) : ?>
                            <?= $biaya['t_seragam'] ?>
                        <?php else : ?>
                            0
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="content-3">
                <div class="detail-box-icon">
                    <i class="bx bxs-school"></i>
                </div>
                <div class="detail-box">
                    <h6>Uang Bangunan</h6>
                    <p>
                        <?php if ($biaya['t_bangunan'] > 0) : ?>
                            <?= $biaya['t_bangunan'] ?>
                        <?php else : ?>
                            0
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="content-3">
                <div class="detail-box-icon">
                    <i class="bx bx-calendar"></i>
                </div>
                <div class="detail-box">
                    <h6>Spp Bulanan</h6>
                    <p>
                        <?php if ($biaya['t_bulanan'] > 0) : ?>
                            <?= $biaya['t_bulanan'] ?>
                        <?php else : ?>
                            0
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="kanan">
            <div class="content-3">
                <div class="detail-box-icon">
                    <i class="fas fa-briefcase tas"></i>
                </div>
                <div class="detail-box">
                    <h6>Prakerin</h6>
                    <p>
                        <?php if ($biaya['t_prakerin'] > 0) : ?>
                            <?= $biaya['t_prakerin'] ?>
                        <?php else : ?>
                            0
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="content-3">
                <div class="detail-box-icon">
                    <i class="fas fa-user-graduate ujikom"></i>
                </div>
                <div class="detail-box">
                    <h6>Ujikom</h6>
                    <p>
                        <?php if ($biaya['t_ujikom'] > 0) : ?>
                            <?= $biaya['t_ujikom'] ?>
                        <?php else : ?>
                            0
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>