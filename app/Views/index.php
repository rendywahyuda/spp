<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/home.css">

    <title>SPP | <?= $title; ?></title>
</head>

<body onload="initClock()">
    <!-- <div class="container"> -->
    <div class="page-siswa">
        <div class="page-content">
            <div class="left-content">
                <a href="/panduan" class="panduan"><i class="fas fa-book"></i> Panduan</a>
                <div class="logo">
                    <a href="#" class="navbar-brand"><img src="/img/logo.png" width="90px" height="40px"></a>
                </div>
                <h5>Ayo Bayar SPP Anda</h5>
                <p class="text-lg text-grey mb-2">Bayar SPP tidak perlu datang ke sekolah bisa dimana saja kapan saja tanpa ribet</p>
                <div class="login">
                    <div class="wrapper">
                        <form action="<?= base_url('auth/index') ?>" method="post">
                            <div class="row">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Masukkan Username" name='username' value="<?= set_value('username'); ?>" required>
                            </div>
                            <div class="row">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Masukkan Password" name='password' value="<?= set_value('password'); ?>" required>
                            </div>
                            <div class="button">
                                <input type="submit" value="Masuk" id="masuk" class="btn-masuk">
                            </div>
                            <?php if (isset($validation)) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <li><?= $validation->listErrors(); ?></li>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                    </form>
                </div>
            </div>
            <div class="right-content">
                <div class="waktu">
                    <div class="col-md-6 py-5 wow zoomIn">
                        <div class="img-fluid text-center">
                            <div class="datetime">
                                <div class="date">
                                    <span id="dayname">Hari</span>,
                                    <span id="daynum">00</span>
                                    <span id="month">Bulan</span>
                                    <span id="year">Tahun</span>
                                </div>
                                <div class="time">
                                    <span id="hour">00</span>:
                                    <span id="minutes">00</span>:
                                    <span id="seconds">00</span>
                                    <span id="period">AM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image">
                    <img src="/img/home.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- </div> -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>