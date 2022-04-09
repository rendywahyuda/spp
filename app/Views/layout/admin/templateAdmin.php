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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <title>Admin | <?= $title; ?></title>
</head>

<body>

    <?= $this->include('layout/admin/sidebarAdmin'); ?>
    <?= $this->renderSection('bodyAdmin'); ?>

    </div>
    </section>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        };

        const swal = $('.swal').data('swal');
        if (swal) {
            Swal.fire({
                icon: 'success',
                title: 'Data <?= $title; ?>',
                text: swal
            });
        };

        const swall = $('.swall').data('swall');
        if (swall) {
            Swal.fire({
                icon: 'info',
                title: 'Data Tahun Pelajaran Belum Ada',
                text: swall
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
        });

        $(document).ready(function() {
            $('#kelas').change(function() {
                siswa();
            })
        });

        function siswa() {
            var kelas = $('#kelas').val();
            $.ajax({
                url: "<?= base_url('Siswa/setKelas'); ?>",
                data: "kelas=" + kelas,
                success: function(data) {
                    $("#siswaTable tbody").html(data);
                    // console.log(data);
                }
            })
        };
    </script>
</body>

</html>