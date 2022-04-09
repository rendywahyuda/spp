<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

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
                    <?php $count = count($jumlah_transaksi) ?>
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
                <i class="bx bx-user"></i>
            </div>
            <div class="dashboard-box">
                <h6>Jumlah Siswa</h6>
                <p>
                    <?php $count = count($jumlah_siswa) ?>
                    <?php if ($count > 0) : ?>
                        <?= $count ?>
                    <?php else : ?>
                        Belum Ada
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <div class="content-3">
            <div class="dashboard-box-icon">
                <i class="bx bx-data"></i>
            </div>
            <div class="dashboard-box">
                <h6>Jumlah Kelas</h6>
                <p>
                    <?php $count = count($jumlah_kelas) ?>
                    <?php if ($count > 0) : ?>
                        <?= $count ?>
                    <?php else : ?>
                        Belum Ada
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>