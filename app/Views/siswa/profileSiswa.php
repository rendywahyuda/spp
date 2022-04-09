<?= $this->extend('layout/siswa/templateSiswa'); ?>

<?= $this->section('bodySiswa'); ?>

<div class="profile-user">
    <div class="profile-content">
        <div class="left-profile">
            <div class="profile">
                <img src="/img/profiles/<?= $siswa['profile'] ?>" alt="" class="tengah">
            </div>
        </div>
        <div class="right-profile">
            <div class="tabel">
                <div class="title-tabel">
                    <h4>Ubah Data Profile</h4>
                </div>
                <form action="/auth/siswa_profile" method="post" enctype="multipart/form-data" class="form-profile">
                    <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
                    <input type="hidden" name="id" value="<?= $siswa['id_siswa'] ?>"> <br>
                    <input type="hidden" name="oldProfile" value="<?= $siswa['profile'] ?>"> <br>
                    <div class="row mb-3">
                        <label for="nis" class="col-sm-3 col-form-label">NIS</label>
                        <div class="col-sm-9">
                            <input type="text" name="nis" class="form-control" id="nis" value="<?= set_value('nis', $siswa['nis']) ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= set_value('nama', $siswa['nama']) ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jurusan" class="col-sm-3 col-form-label">Jurusan</label>
                        <div class="col-sm-9">
                            <input type="text" name="jurusan" class="form-control" id="jurusan" value="<?= set_value('jurusan', $siswa['jurusan']) ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="profile" class="col-sm-3 col-form-label">Profile</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="profile" name="profile">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control" id="password" value="<?= set_value('password'); ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password_confirm" class="col-sm-3 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_confirm" class="form-control" id="password_confirm" value="<?= set_value('password_confirm'); ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection(); ?>