<?= $this->extend('layout/bendahara/templateBendahara'); ?>

<?= $this->section('bodyBendahara'); ?>

<div class="profile-user">
    <div class="profile-content">
        <div class="left-profile">
            <div class="profile">
                <img src="/img/profiles/<?= $bendahara['profile'] ?>" alt="" class="tengah">
            </div>
        </div>
        <div class="right-profile">
            <div class="tabel">
                <div class="title-tabel">
                    <h4>Ubah Data Profiles</h4>
                </div>
                <form action="/auth/bendahara_profile" method="post" enctype="multipart/form-data" class="form-profile">
                    <div class="container">
                        <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
                    </div>
                    <input type="hidden" name="id" value="<?= $bendahara['id_bendahara'] ?>"> <br>
                    <input type="hidden" name="oldProfile" value="<?= $bendahara['profile'] ?>"> <br>
                    <div class="row mb-3">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" name="nip" class="form-control" id="nip" value="<?= set_value('nip', $bendahara['nip']) ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" id="nama" value="<?= set_value('nama', $bendahara['nama']) ?>">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_telepon" class="col-sm-3 col-form-label">No. Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_telepon" class="form-control" id="no_telepon" value="<?= set_value('no_telepon', $bendahara['no_telepon']) ?>">
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