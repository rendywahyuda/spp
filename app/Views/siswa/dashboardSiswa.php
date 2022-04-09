<?= $this->extend('layout/siswa/templateSiswa'); ?>

<?= $this->section('bodySiswa'); ?>

<?php $uri = service('uri') ?>

<div class="flashdata" data-flashdata="<?= session()->get('login') ?>"></div>
<div class="dashboard-user">
    <div class="dashboard-content">
        <div class="content-1">
            <div class="dashboard-box-icon">
                <i class="bx bx-bar-chart-alt"></i>
            </div>
            <div class="dashboard-box">
                <h6>Jumlah Transaksi</h6>
                <p>
                    <?php $count = count($jumlah) ?>
                    <?php if ($count > 0) : ?>
                        <?= $count ?>
                    <?php else : ?>
                        Belum Ada
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="content-2">
            <div class="dashboard-box-icon">
                <i class="bx bx-money"></i>
            </div>
            <div class="dashboard-box">
                <h6>Tunggakan</h6>
                <?php if ($tunggakan == null) : ?>
                    <p>0</p>
                <?php else : ?>
                    <p><?= $tunggakan; ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="content-3">
            <div class="dashboard-box-icon">
                <i class="bx bx-data"></i>
            </div>
            <div class="dashboard-box">
                <h6>Total Biaya Spp</h6>
                <?php if ($spp == null) : ?>
                    <p>0</p>
                <?php else : ?>
                    <p><?= $spp; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>