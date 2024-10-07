<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Kasir | <?= $judul ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?>/dist/css/adminlte.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        /* Adjust the width of the last two columns */
        th:nth-last-child(-n+2),
        td:nth-last-child(-n+2) {
            width: 12%; /* You can adjust this value based on your needs */
        }

        @media print {
            body {
                margin: 30px;
            }

            .invoice {
                width: 100%;
            }

            table {
                width: 100%;
                margin-bottom: 20px;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            .text-center {
                text-align: center;
            }

            .text-right {
                text-align: right;
            }

            h4 {
                margin-bottom: 20px;
            }

            .row {
                margin-bottom: 10px;
            }
           
        tr.bg-gray {
            background-color: #ddd !important;
        }
            
    
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="col-12 text-center">
                <b>
                    <center><h4><b><?= $judul ?></b></h4>
                    <h5><b><?= $subjudul ?></b></h5></center>
                </b>
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped">
                        <tr class="text-center bg-gray">
                            <th>No</th>
                            <th>ID Karyawan</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Status</th>
                            <th>Tunjangan Anak</th>
                            <th>PPH</th>
                            <th>Gaji Bersih</th>
                        </tr>

                        <?php 
    $totalGajiPokok = 0;
    $totalTunjanganAnak = 0;
    $totalPph = 0;
    $totalGajiBersih = 0;

    foreach ($laporan as $lap) : 
        $totalTunjanganAnak += $lap['tunjangan_anak'];
        $totalPph += $lap['pph'];
        $totalGajiBersih += $lap['gaji_bersih'];
    ?>
        <tr>
            <td><?= $lap['no'] ?></td>
            <td><?= $lap['nk'] ?></td>
            <td><?= $lap['nm_kry'] ?></td>
            <td><?= $lap['jabatan'] ?></td>
            <td><?= number_format($lap['gajiPokok'], 0, ',', '.') ?></td>
            <td><?= $lap['status'] ?></td>
            <td><?= number_format($lap['tunjangan_anak'], 0, ',', '.') ?></td>
            <td><?= number_format($lap['pph'], 0, ',', '.') ?></td>
            <td><?= number_format($lap['gaji_bersih'], 0, ',', '.') ?></td>
        </tr>
    <?php endforeach; ?>
    <!-- Total row -->
    <tr>
        <td colspan="6" class="text-right"><b>Total</b></td>
        <td><?= number_format($totalTunjanganAnak, 0, ',', '.') ?></td>
        <td><?= number_format($totalPph, 0, ',', '.') ?></td>
        <td><?= number_format($totalGajiBersih, 0, ',', '.') ?></td>
    </tr>
                    </table>
                </div>
            </div>
            <!-- /.row -->

            <!-- Print Date and Time -->
            <div class="print-time">
                <p>Waktu Cetak: <?= date('d-m-Y H:i:s') ?></p>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>

</html>
