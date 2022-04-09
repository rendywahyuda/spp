<div class="sidebar close">
    <div class="logo-details">
        <i class='bx'></i>
        <div class="logo_name"><img src="/img/logo.png"></div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('/admin/dashboard'); ?>">
                    <i class='bx bx-home'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </div>
        </li>
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('admin/bendahara') ?>">
                    <i class='bx bx-data'></i>
                    <span class="links_name">Data</span>
                </a>
                <span class="tooltip">Data</span>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu blank">
                <li><a href="<?= base_url('admin/bendahara') ?>">Bendahara</a></li>
                <li><a href="<?= base_url('admin/siswa') ?>">Siswa</a></li>
                <li><a href="<?= base_url('admin/kelas') ?>">Kelas</a></li>
                <li><a href="<?= base_url('admin/tahun_pelajaran'); ?>">Tahun Pelajaran</a></li>
            </ul>
        </li>
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('admin/log_siswa') ?>">
                    <i class='bx bx-history'></i>
                    <span class="links_name">Trigger</span>
                </a>
                <span class="tooltip">Trigger</span>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu blank">
                <li><a href="<?= base_url('admin/log_siswa') ?>">Log Siswa</a></li>
                <li><a href="<?= base_url('admin/log_bendahara') ?>">Log Bendahara</a></li>
                <li><a href="<?= base_url('admin/log_kelas') ?>">Log Kelas</a></li>
                <li><a href="<?= base_url('admin/log_tahun_pelajaran'); ?>">Log Tahun Pelajaran</a></li>
            </ul>
        </li>
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('admin/tampil_siswa') ?>">
                    <i class='bx bx-data'></i>
                    <span class="links_name">Procedure</span>
                </a>
                <span class="tooltip">Procedure</span>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu blank">
                <li><a href="<?= base_url('admin/tampil_siswa') ?>">Tampil Siswa</a></li>
                <li><a href="<?= base_url('admin/tampil_bendahara') ?>">Tampil Bendahara</a></li>
                <li><a href="<?= base_url('admin/tampil_kelas') ?>">Tampil Kelas</a></li>
                <li><a href="<?= base_url('admin/tampil_tahun_pelajaran'); ?>">Tampil Tahun Pelajaran</a></li>
                <li><a href="<?= base_url('admin/tambah_kelas'); ?>">Tambah Kelas</a></li>
            </ul>
        </li>
        <!-- <li>
            <div class="sidebar-link">
                <a href="<?= base_url('admin/jumlah_siswa') ?>">
                    <i class='bx bx-data'></i>
                    <span class="links_name">Function</span>
                </a>
                <span class="tooltip">Function</span>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu blank">
                <li><a href="<?= base_url('admin/jumlah_siswa') ?>">Jumlah Siswa</a></li>
                <li><a href="<?= base_url('admin/nis_siswa') ?>">NIS Siswa</a></li>
                <li><a href="<?= base_url('admin/nama_siswa') ?>">Nama Siswa</a></li>
            </ul>
        </li> -->
        <li>
            <div class="sidebar-link">
                <a href="<?= base_url('admin/tunggakan_siswa') ?>">
                    <i class='bx bx-data'></i>
                    <span class="links_name">View</span>
                </a>
                <span class="tooltip">View</span>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu blank">
                <li><a href="<?= base_url('admin/tunggakan_siswa') ?>">Tunggakan Siswa</a></li>
            </ul>
        </li>
        <li class="profile">
            <div class="profile-details">
                <img src="/img/profiles/<?= $admin['profile'] ?>" width="50" alt="">
                <div class="name_job">
                    <div class="name"><?= session()->get('nama'); ?></div>
                    <div class="job"></div>
                </div>
            </div>
            <a href="<?= base_url('/admin/logout') ?>">
                <i href="/auth/admin_logout" class='bx bx-log-out' id="log_out"></i>
            </a>
        </li>
    </ul>
</div>
<section class="home-section">
    <nav>
        <div class="text"><?= $title; ?></div>
    </nav>
    <div class="home-content">