<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use Dompdf\Dompdf;
use Dompdf\Options;


class Laporan extends BaseController
{
    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
    }

    public function index()
    {
        $transaksi = $this->ModelTransaksi->AllData();
    
        $data['judul'] = 'Data Karyawan <br> PT Duta Cipta';
        $data['subjudul'] = 'Penggajian';
        $data['menu'] = 'Data Karyawan';
        $data['submenu'] = 'Karyawan';
        $data['page'] = 'v_laporan';
    
        $data['laporan'] = [];
    
        $totalTunjanganAnak = 0;
        $totalPph = 0;
        $totalGajiBersih = 0;
    
        foreach ($transaksi as $key => $value) {
            $detailTransaksi = $this->ModelTransaksi->GetDetailTransaksi($value['nk']);
    
            // Hitung gaji pokok berdasarkan kode jabatan
            $gajiPokok = $this->getGajiPokokByKodeJabatan($detailTransaksi['kode_jab']);
            $jabatan = $this->getJabatanByKodeJabatan($detailTransaksi['kode_jab']);
    
            // Hitung tunjangan status
            $tunjanganStatus = $this->hitungTunjanganStatus($detailTransaksi['status'], $gajiPokok);
    
            // Hitung tunjangan anak
            $tunjanganAnak = $this->hitungTunjanganAnak($detailTransaksi['anak'], $gajiPokok);
    
            // Hitung PPH (Pajak Penghasilan)
            $pph = $gajiPokok * 0.05; // Contoh: PPH 5% dari gaji pokok
    
            // Hitung gaji bersih
            $gajiBersih = $gajiPokok + $tunjanganStatus + $tunjanganAnak - $pph;
    
            // Tambahkan data ke array laporan
            $data['laporan'][] = [
                'no' => $key + 1,
                'nk' => $value['nk'],
                'nm_kry' => $value['nm_kry'],
                'jabatan' => $jabatan, // Use the variable $jabatan instead of $detailTransaksi['kode_jab']
                'gajiPokok' => $gajiPokok,
                'status' => $detailTransaksi['status'],
                'tunjangan_anak' => $tunjanganAnak,
                'pph' => $pph,
                'gaji_bersih' => $gajiBersih,
                'total_tunjangan_anak' => $totalTunjanganAnak += $tunjanganAnak,
                'total_pph' => $totalPph += $pph,
                'total_gaji_bersih' => $totalGajiBersih += $gajiBersih,
            ];
        }
    
        return view('v_template', $data);
    }

     public function getGajiPokokByKodeJabatan($kode_jab)
    {
        switch ($kode_jab) {
            case 1:
                return 5000000;
            case 2:
                return 3500000;
            case 3:
                return 3000000;
            case 4:
                return 2750000;
            case 5:
                return 2500000;
            default:
                return 0;
        }
    }

    public function getJabatanByKodeJabatan($kode_jab)
    {
        switch ($kode_jab) {
            case 1:
                return "Manajer";
            case 2:
                return "Kabag";
            case 3:
                return "Adminitrasi";
            case 4:
                return "Pemasaran";
            case 5:
                return "Bag Umum";
            default:
                return 0;
        }
    }
 

// Fungsi untuk menghitung tunjangan status
public function hitungTunjanganStatus($status, $gajiPokok)
{
    if ($status == 'BK') {
        return 0;
    } elseif ($status == 'KW') {
        return $gajiPokok * 0.1;
    }
}

// Fungsi untuk menghitung tunjangan anak
public function hitungTunjanganAnak($jumlahAnak, $gajiPokok)
{
    return $jumlahAnak * 0.05 * $gajiPokok;
}

    public function PrintLaporan()
    {
        $transaksi = $this->ModelTransaksi->AllData(); // Ambil semua data transaksi
    
        $data['judul'] = 'Data Karyawan <br> PT Duta Cipta';
        $data['subjudul'] = 'Penggajian';
        $data['menu'] = 'Data Karyawan';
        $data['submenu'] = 'Karyawan';
        $data['page'] = 'v_print';
    
        $data['laporan'] = []; // Inisialisasi array untuk menyimpan data laporan
    
        $totalTunjanganAnak = 0;
        $totalPph = 0;
        $totalGajiBersih = 0;
    
        foreach ($transaksi as $key => $value) {
            $detailTransaksi = $this->ModelTransaksi->GetDetailTransaksi($value['nk']);
    
            // Hitung gaji pokok berdasarkan kode jabatan
            $gajiPokok = $this->getGajiPokokByKodeJabatan($detailTransaksi['kode_jab']);
            $jabatan = $this->getJabatanByKodeJabatan($detailTransaksi['kode_jab']);
    
            // Hitung tunjangan status
            $tunjanganStatus = $this->hitungTunjanganStatus($detailTransaksi['status'], $gajiPokok);
    
            // Hitung tunjangan anak
            $tunjanganAnak = $this->hitungTunjanganAnak($detailTransaksi['anak'], $gajiPokok);
    
            // Hitung PPH (Pajak Penghasilan)
            $pph = $gajiPokok * 0.05; // Contoh: PPH 5% dari gaji pokok
    
            // Hitung gaji bersih
            $gajiBersih = $gajiPokok + $tunjanganStatus + $tunjanganAnak - $pph;
    
            // Tambahkan data ke array laporan
            $data['laporan'][] = [
                'no' => $key + 1,
                'nk' => $value['nk'],
                'nm_kry' => $value['nm_kry'],
                'jabatan' => $jabatan, // Use the variable $jabatan instead of $detailTransaksi['kode_jab']
                'gajiPokok' => $gajiPokok,
                'status' => $detailTransaksi['status'],
                'tunjangan_anak' => $tunjanganAnak,
                'pph' => $pph,
                'gaji_bersih' => $gajiBersih,
                'total_tunjangan_anak' => $totalTunjanganAnak += $tunjanganAnak,
                'total_pph' => $totalPph += $pph,
                'total_gaji_bersih' => $totalGajiBersih += $gajiBersih,
            ];
        }
        return view('laporan/v_print', $data);
    }

    public function Pdf()
    {
        $transaksi = $this->ModelTransaksi->AllData(); // Ambil semua data transaksi
    
        $data['judul'] = 'Data Karyawan <br> PT Duta Cipta';
        $data['subjudul'] = 'Penggajian';
        $data['menu'] = 'Data Karyawan';
        $data['submenu'] = 'Karyawan';
        $data['page'] = 'v_pdf';
    
        $data['laporan'] = []; // Inisialisasi array untuk menyimpan data laporan
    
        $totalTunjanganAnak = 0;
        $totalPph = 0;
        $totalGajiBersih = 0;
    
        foreach ($transaksi as $key => $value) {
            $detailTransaksi = $this->ModelTransaksi->GetDetailTransaksi($value['nk']);
    
            // Hitung gaji pokok berdasarkan kode jabatan
            $gajiPokok = $this->getGajiPokokByKodeJabatan($detailTransaksi['kode_jab']);
            $jabatan = $this->getJabatanByKodeJabatan($detailTransaksi['kode_jab']);
    
            // Hitung tunjangan status
            $tunjanganStatus = $this->hitungTunjanganStatus($detailTransaksi['status'], $gajiPokok);
    
            // Hitung tunjangan anak
            $tunjanganAnak = $this->hitungTunjanganAnak($detailTransaksi['anak'], $gajiPokok);
    
            // Hitung PPH (Pajak Penghasilan)
            $pph = $gajiPokok * 0.05; // Contoh: PPH 5% dari gaji pokok
    
            // Hitung gaji bersih
            $gajiBersih = $gajiPokok + $tunjanganStatus + $tunjanganAnak - $pph;
    
            // Tambahkan data ke array laporan
            $data['laporan'][] = [
                'no' => $key + 1,
                'nk' => $value['nk'],
                'nm_kry' => $value['nm_kry'],
                'jabatan' => $jabatan, // Use the variable $jabatan instead of $detailTransaksi['kode_jab']
                'gajiPokok' => $gajiPokok,
                'status' => $detailTransaksi['status'],
                'tunjangan_anak' => $tunjanganAnak,
                'pph' => $pph,
                'gaji_bersih' => $gajiBersih,
                'total_tunjangan_anak' => $totalTunjanganAnak += $tunjanganAnak,
                'total_pph' => $totalPph += $pph,
                'total_gaji_bersih' => $totalGajiBersih += $gajiBersih,
            ];
        }
        // Load Dompdf library
        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $pdf->setOptions($options);

        // title dari pdf
        $data['title_pdf'] = 'Laporan Penjualan Toko Kita';

        // filename dari pdf ketika didownload
        $file_pdf = 'laporan_penjualan_toko_kita';

        // setting paper
        $paper = 'A4';

        // orientasi paper potrait / landscape
        $orientation = "landscape";

        $html = view('v_pdf', $data);

        // run dompdf
        $pdf->loadHtml($html);
        $pdf->setPaper($paper, $orientation);
        $pdf->render();

        // Output the generated PDF to Browser
        $pdf->stream($file_pdf, array("Attachment" => false));
    }
}
