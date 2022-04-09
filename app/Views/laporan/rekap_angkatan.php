<!DOCTYPE html>
<html>

<head>
    <style>
        .container {
            margin-top: -50px;
        }

        .container h3 {
            font-weight: bold;
            font-size: 20px;
            text-align: center;
        }

        .container p {
            margin-left: 250px;
        }

        .container p span {
            margin-left: 200px;
        }

        .kop-surat {
            margin-top: -10px;
            border-bottom: 2px solid black;
        }

        .garis {
            border-top: 1px solid black;
            width: 100%;
            margin-top: -5px;
            margin-bottom: 20px;
        }

        .kop-surat h6 {
            font-size: 14px;
            margin-left: 110px;
        }

        .kop-surat h4 {
            font-size: 20px;
            font-weight: bold;
            margin-top: -28px;
            margin-left: 110px;
        }

        .kop-surat p {
            font-size: 14px;
            margin-top: -28px;
            margin-bottom: 10px;
            margin-left: 110px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            padding: 0 20px;
            margin-bottom: -15px;
            border-color: black;
        }

        th,
        td {
            padding: 8px;
            font-size: 18px;
        }

        .t {
            text-align: center;
        }

        th {
            background-color: lightsteelblue;
            color: black;
            font-weight: 500;
        }

        .tanda-tangan {
            padding: 0 15px;
            margin-top: 200px;
        }

        .tanda-tangan .kanan,
        .tanda-tangan .kiri {
            position: relative;
            display: inline-table;
        }

        .tanda-tangan .kanan {
            float: right;
            margin-right: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="kop-surat">
            <h6>
                KOMITE SEKOLAH
            </h6>
            <h4>SMK NEGERI 11 BANDUNG</h4>
            <p>
                Bisnis dan Manajemen - Teknologi Informasi dan Komunikasi<br>
                Jl. Budhi Cilember (022) 6652442 Fax. (022) 6613508 Bandung 40175<br>
                http://smkn11bdg.sch.id E-mail: smkn11bdg@gmail.com<br>
            </p>
        </div>

        <div class="garis"></div>

        <h3>REKAP KEUANGAN ANGKATAN<br>
            TAHUN <?= $tahun; ?><br>
            <?= $tanggal; ?>
        </h3>
        <table border="1">
            <thead>
                <tr>
                    <th>TOTAL BIAYA</th>
                    <th>TOTAL SUDAH BAYAR</th>
                    <th>TOTAL SISA HARUS BAYAR</th>
                    <th>KET</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rekap as $r) : ?>
                    <tr>
                        <td class="t"><?= $r['total_biaya'] ?></td>
                        <td class="t">
                            <?php if ($r['total_transfer'] > 0) : ?>
                                <?= $r['total_transfer'] ?>
                            <?php else : ?>
                                0
                            <?php endif; ?>
                        </td>
                        <td class="t"><?= $r['total_tunggakan'] ?></td>
                        <td class="t"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="tanda-tangan">
            <div class="kiri">
                Mengetahui,<br>
                Kepala Sekolah<br>
                <br>
                <br>
                _________________<br>
                NIP.
            </div>
            <div class="kanan">
                Bandung, __________ 2021<br>
                Ketua Komite<br>
                <br>
                <br>
                ___________________
            </div>
        </div>
    </div>
</body>

</html>