<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="sidebar-menu2">
    <div class="sidebar-menu-content2">
        <div class="atas">
            <div class="card text-center mb-5">
                <div class="card-header">
                    Cetak Rekap Keuangan Kelas
                </div>
                <div class="card-body">
                    <form action="/laporan/rekap_kelas" method="post">
                        <div class="row mb-3">
                            <label for="tingkat" class="col-sm-2 col-form-label">Kelas</label>
                            <div class="col-sm-10">
                                <select name="tingkat" class="form-control" value="" id='tingkat' required>
                                    <option value="" disabled selected hidden>Pilih Kelas ...</option>
                                    <option value="Semua">Semua</option>
                                    <option value="10">Kelas 10</option>
                                    <option value="11">Kelas 11</option>
                                    <option value="12">Kelas 12</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tahun_pelajaran" class="col-sm-2 col-form-label">Tahun Pelajaran</label>
                            <div class="col-sm-10">
                                <select name="tahun_pelajaran" class="form-control" value="" id='tahun_pelajaran' required>
                                    <option value="" disabled selected hidden>Pilih Tahun Pelajaran ...</option>
                                    <?php foreach ($tahun_pelajaran as $tp) : ?>
                                        <option value="<?= $tp['tahun_pelajaran']; ?>">Tahun Pelajaran <?= $tp['tahun_pelajaran']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" type="button" class="btn btn-primary">Cetak</button>
                    </form>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    Cetak Rekap Keuangan Tahunan
                </div>
                <div class="card-body">
                    <form action="/laporan/rekap_tahunan" method="post">
                        <div class="row mb-3 select2">
                            <label for="tahun_pelajaran" class="col-sm-2 col-form-label">Tahun Pelajaran</label>
                            <div class="col-sm-10">
                                <select name="tahun_pelajaran" class="form-control" value="" id='tahun_pelajaran' required>
                                    <option value="" disabled selected hidden>Pilih Tahun Pelajaran ...</option>
                                    <!-- <option value="Semua">Semua</option> -->
                                    <?php foreach ($tahun_pelajaran as $tp) : ?>
                                        <option value="<?= $tp['tahun_pelajaran']; ?>">Tahun Pelajaran <?= $tp['tahun_pelajaran']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" type="button" class="btn btn-primary">Cetak</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bawah">
            <div class="card text-center">
                <div class="card-header">
                    Cetak Rekap Keuangan Angkatan
                </div>
                <div class="card-body">
                    <form action="/laporan/rekap_angkatan" method="post">
                        <div class="row mb-3 select2">
                            <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-10 mb-3">
                                <select name="tahun" class="form-control" value="" id='tahun' required>
                                    <option value="" disabled selected hidden>Pilih Tahun ...</option>
                                    <?php foreach ($angkatan as $a) : ?>
                                        <option value="<?= $a['tahun']; ?>"><?= $a['tahun']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" type="button" class="btn btn-primary">Cetak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>