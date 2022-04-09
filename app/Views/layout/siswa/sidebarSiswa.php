<div class="sidebar">
    <div class="logo-details">
        <i class='bx'></i>
        <div class="logo_name"><img src="/img/logo.png"></div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <a href="<?= base_url('/siswa/dashboard'); ?>">
                <i class='bx bx-home'></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="<?= base_url('/siswa/profile'); ?>">
                <i class='bx bx-user'></i>
                <span class="links_name">Profiles</span>
            </a>
            <span class="tooltip">Profiles</span>
        </li>
        <li>
            <a href="<?= base_url('/siswa/detail_spp'); ?>">
                <i class='bx bx-wallet'></i>
                <span class="links_name">Detail Spp</span>
            </a>
            <span class="tooltip">Detail Spp</span>
        </li>
        <li>
            <a href="<?= base_url('/siswa/transaksi'); ?>">
                <i class='bx bx-money'></i>
                <span class="links_name">Transaksi</span>
            </a>
            <span class="tooltip">Transaksi</span>
        </li>
        <li>
            <a href="<?= base_url('/siswa/riwayat'); ?>">
                <i class='bx bx-history'></i>
                <span class="links_name">Riwayat</span>
            </a>
            <span class="tooltip">Riwayat</span>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="/img/profiles/<?= $siswa['profile'] ?>" width="50" alt="">
                <div class="name_job">
                    <div class="name"><?= session()->get('nama'); ?></div>
                    <div class="job"><?= session()->get('nis'); ?></div>
                </div>
            </div>
            <a href="/auth/siswa_logout">
                <i class='bx bx-log-out' id="log_out"></i>
            </a>
        </li>
    </ul>
</div>
<section class="home-section">
    <nav>
        <div class="text"><?= $title; ?></div>
    </nav>
    <div class="home-content">