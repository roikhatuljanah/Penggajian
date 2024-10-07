<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .struk-container {
            width: 500px;
            margin: 30px auto;
            padding: 15px;
            border: 2px solid #333;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header-struk {
            text-align: center;
            font-weight: bold;
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            border-radius: 5px;
        }

        .content-struk {
            margin-top: 20px;
        }

        .content-row {
            margin-bottom: 10px;
        }

        .content-label {
            font-weight: bold;
            width: 300px;
            display: inline-block;
        }

        .footer-struk {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }

        /* Additional CSS for better styling and readability */

        .header-struk h2 {
            font-size: 18px;
        }

        .footer-struk p {
            font-size: 12px;
        }

    </style>
</head>

<body>

    <div class="struk-container">
        <div class="header-struk">
            <h2>SLIP GAJI</h2>
        </div>

        <div class="content-struk">
                <table>
                <?php if (is_array($transaksi)) : ?>
                    <thead>
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
                <div class="content-row">
                    <span class="content-label">ID Karyawan </span>
                    <?= $lap['nk'] ?>
                </div>
                <div class="content-row">
                    <span class="content-label">Nama Karyawan </span>
                    <?= $lap['nm_kry'] ?>
                </div>
                <div class="content-row">
                    <span class="content-label">Jabatan </span>
                    <?= $lap['jabatan'] ?>
                </div>
                <div class="content-row">
                    <span class="content-label">Gaji </span>
                    <?= number_format($lap['gajiPokok'], 0, ',', '.') ?>
                </div>
                <div class="content-row">
                    <span class="content-label">Status </span>
                    <?= $lap['status'] ?> 
                </div>
                <div class="content-row">
                    <span class="content-label">Tunjangan Anak </span>
                    <?= number_format($lap['tunjangan_anak'], 0, ',', '.') ?>
                </div>
                <div class="content-row">
                    <span class="content-label">PPH </span>
                    <?= number_format($lap['pph'], 0, ',', '.') ?>
                </div>
                <div class="content-row">
                    <span class="content-label">Gaji Yang Diterima </span>
                    <?= number_format($lap['gaji_bersih'], 0, ',', '.') ?>
                </div>
            
    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
        </div>

        <div class="footer-struk">
            <p>Rahasiakan Gaji Anda</p>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
