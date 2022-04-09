<div class="sidebar close">
    <div class="logo-details">
        <i class='bx'></i>
        <div class="logo_name"><img src="/img/logo.png"></div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('/bendahara/dashboard'); ?>">
                    <i class='bx bx-home'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </div>
        </li>
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('/bendahara/profile'); ?>">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Profiles</span>
                </a>
                <span class="tooltip">Profiles</span>
            </div>
        </li>
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('/bendahara/spp'); ?>">
                    <i class='bx bx-wallet'></i>
                    <span class="links_name">Spp</span>
                </a>
                <span class="tooltip">Spp</span>
            </div>
        </li>
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('/bendahara/rekap'); ?>">
                    <i class='bx bx-book-open'></i>
                    <span class="links_name">Rekap</span>
                </a>
                <span class="tooltip">Rekap</span>
            </div>
        </li>
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('/bendahara/transaksi'); ?>">
                    <i class='bx bx-money'></i>
                    <span class="links_name">Transaksi</span>
                </a>
                <span class="tooltip">Transaksi</span>
            </div>
        </li>
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('/bendahara/riwayat'); ?>">
                    <i class='bx bx-history'></i>
                    <span class="links_name">Riwayat</span>
                </a>
                <span class="tooltip">Riwayat</span>
            </div>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="/img/profiles/<?= $bendahara['profile'] ?>" width="50" alt="">
                <div class="name_job">
                    <div class="name"><?= session()->get('nama'); ?></div>
                    <div class="job"><?= session()->get('nip'); ?></div>
                </div>
            </div>
            <a href="<?= base_url('/bendahara/logout') ?>">
                <i href="/auth/bendahara_logout" class='bx bx-log-out' id="log_out"></i>
            </a>
        </li>
    </ul>
</div>
<section class="home-section">
    <nav>
        <div class="text"><?= $title; ?></div>
    </nav>
    <div class="home-content">