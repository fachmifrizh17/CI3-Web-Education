<?php
function FormatRupiah($angka)
{

    $hasil_rupiah = number_format($angka);
    return $hasil_rupiah;
}

function tanggal_indo($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $pecahkan = explode('-', $tanggal);

    return $pecahkan[0] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[2];
}
?>

<style>
    * {
        font-family: 'Courier New', Courier, monospace;
    }

    .cf:before,
    .cf:after {
        content: " ";
        /* 1 */
        display: table;
        /* 2 */
    }

    .cf:after {
        clear: both;
    }
    .cf {
        *zoom: 1;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th {
        border: 1px solid #333;
        text-align: left;
        padding: 8px;
    }

    div {
        font-size: 12;
    }
</style>
<title>LAPORAN DATA MAPPING SISWA</title>

<body>
    <h4 style="text-align: center;margin-bottom: 5px;">DAFTAR MAPPING SISWA</h4>

    <div class="row cf" style="margin-bottom: 2px;">
        <div class="col" style="float: right; width: 20%; text-align: right;">
            <div style="font-size: 10px; width: 45%; float: left;">
                Dicetak
            </div>
            <div style="font-size: 10px; width: 85%; float: right;">
                : <?= date('d-m-Y') ?>
            </div>
        </div>
    </div>

    <table style="font-size: 10px; text-align:justify;">
        <thead>
            <tr>
                <th style="text-align: center;">No.</th>
                <th style="text-align: center;">Kode Siswa</th>
                <th style="text-align: center;">Email Siswa</th>
                <th style="text-align: center;">Nama Siswa</th>
                <th style="text-align: center;">Kode Kelas</th>
                <th style="text-align: center;">Nama Kelas</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($reportrow)) : ?>
                <?php
                $no = 1;
                $qty = 0;
                foreach ($reportrow as $vals) :
                ?>
                    <tr>
                        <td style="text-align: center; font-size: 11px; font-weight: bold;" cellpadding="2"><?= $no++ ?></td>
                        <td style="text-align: center; font-size: 11px; font-weight: bold;" cellpadding="2"><?= $vals->kodesiswa ?></td>
                        <td style="text-align: center; font-size: 11px; font-weight: bold;"><?= $vals->email ?></td>
                        <td style="text-align: center; font-size: 11px; font-weight: bold;" cellpadding="2"><?= $vals->namasiswa ?></td>
                        <td style="text-align: center; font-size: 11px; font-weight: bold;" cellpadding="2"><?= $vals->kodekelas ?></td>
                        <td style="text-align: center; font-size: 11px; font-weight: bold;" cellpadding="2"><?= $vals->namakelas ?></td>
                    </tr>
                    <?php  ?>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td style="text-align: center; color:red;" colspan="6">MAAF DATA MAPPINGZ SISWA TIDAK TERSEDIA !!</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>