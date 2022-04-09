<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- CSS -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <title>Siswa | <?= $title; ?></title>
</head>

<body>

    <?= $this->include('layout/siswa/sidebarSiswa'); ?>
    <?= $this->renderSection('bodySiswa'); ?>

    </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const flashdata = $('.flashdata').data('flashdata');
        if (flashdata) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: 'Login Berhasil'
            })
        }

        const swal = $('.swal').data('swal');
        if (swal) {
            Swal.fire({
                icon: 'success',
                title: 'Data <?= $title; ?>',
                text: swal
            });
        }

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            const href = $(this).attr('href');
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Data yang telah dihapus tidak bisa dikembalikan',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            })
        })

        $(document).ready(function() {
            $('#bulan').change(function() {
                bulanHistory();
            })
        });

        function bulanHistory() {
            var bulan = $('#bulan').val();
            $.ajax({
                url: "<?= base_url('Transaksi/history_bulan'); ?>",
                data: "bulan=" + bulan,
                success: function(data) {
                    $("#historySiswa tbody").html(data);
                }
            })
        }

        $(document).ready(function() {
            $('#bulan').change(function() {
                bulanHistory2();
            })
        });

        function bulanHistory2() {
            var bulan = $('#bulan').val();
            $.ajax({
                url: "<?= base_url('Transaksi/history_bulan2'); ?>",
                data: "bulan=" + bulan,
                success: function(data) {
                    $("#historySiswaPending tbody").html(data);
                }
            })
        }

        $(document).ready(function() {
            $('#tahun_pelajaran').change(function() {
                tahunPelajaranHistory();
            })
        });

        function tahunPelajaranHistory() {
            var tahun_pelajaran = $('#tahun_pelajaran').val();
            $.ajax({
                url: "<?= base_url('Transaksi/history_tapel_siswa'); ?>",
                data: "tahun_pelajaran=" + tahun_pelajaran,
                success: function(data) {
                    $("#historySiswa tbody").html(data);
                }
            })
        }

        $(document).ready(function() {
            $('#tahun_pelajaran').change(function() {
                tahunPelajaranHistory2();
            })
        });

        function tahunPelajaranHistory2() {
            var tahun_pelajaran = $('#tahun_pelajaran').val();
            $.ajax({
                url: "<?= base_url('Transaksi/history_tapel_siswa2'); ?>",
                data: "tahun_pelajaran=" + tahun_pelajaran,
                success: function(data) {
                    $("#historySiswaPending tbody").html(data);
                }
            })
        }
    </script>
</body>

</html>