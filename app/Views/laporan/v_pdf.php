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
                    <h4><b><?= $judul ?></b></h4>
                    <h4><b><?= $subjudul ?></b></h4>
                </b>
            </div>

            <!-- Table row -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-striped" border="1">
                        <tr class="text-center bg-gray">
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>ID Motor</th>
                            <th>Harga (IDR)</th>
                            <th>DP (IDR)</th>
                            <th>Biaya Bunga 3 Tahun (IDR)</th>
                            <th>Biaya Admin (IDR)</th>
                            <th>Biaya Asuransi 3 Tahun (IDR)</th>
                            <th>Total Hutang (IDR)</th>
                            <th>Angsuran Per Bulan (IDR)</th>
                        </tr>

                        <?php
                        $totalHutang = 0;
                        $totalAngsuran = 0;
                        foreach ($laporan as $lap) :
                            $totalHutang += $lap['total_hutang'];
                            $totalAngsuran += $lap['angsuran_per_bulan'];
                        ?>
                            <tr>
                                <td><?= $lap['no'] ?></td>
                                <td><?= $lap['nama_pelanggan'] ?></td>
                                <td><?= $lap['alamat'] ?></td>
                                <td><?= $lap['idmotor'] ?></td>
                                <td><?= number_format($lap['harga'], 0, ',', '.') ?></td>
                                <td><?= number_format($lap['dp'], 0, ',', '.') ?></td>
                                <td><?= number_format($lap['biaya_bunga_3_tahun'], 0, ',', '.') ?></td>
                                <td><?= number_format($lap['biaya_admin'], 0, ',', '.') ?></td>
                                <td><?= number_format($lap['biaya_asuransi_3_tahun'], 0, ',', '.') ?></td>
                                <td><?= number_format($lap['total_hutang'], 0, ',', '.') ?></td>
                                <td><?= number_format($lap['angsuran_per_bulan'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Baris Total -->
                        <tr>
                            <td colspan="9" class="text-right"><b>Total</b></td>
                            <td><?= number_format($totalHutang, 0, ',', '.') ?></td>
                            <td><?= number_format($totalAngsuran, 0, ',', '.') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>

</html>
