<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $subjudul ?></h3>

            <div class="card-tools">
                <a href="<?= base_url('Laporan/PrintLaporan') ?>" class="btn btn-tool" target="_blank"><i class="fas fa-print"></i>Print</a>
                <a href="<?= base_url('Laporan/Pdf') ?>" class="btn btn-tool" target="_blank"><i class="fas fa-download"></i>Download Pdf</a>
                <!-- <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#add-data"><i class="fas fa-download"></i>Download Pdf
                </button> -->
            </div>
        </div>
        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>
    <table class="table table-bordered">
    <thead>
    <tr>
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
</thead>
<tbody>
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
</tbody>

    </table>
    
        </div>
    </div>
</div>

