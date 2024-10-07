<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;

class Penjualan extends BaseController
{
    protected $ModelTransaksi;

    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
    }

    public function index()
    {
        // Configuring pagination
        $pager = \Config\Services::pager(null, null, false);
        $perPage = 8;  // Adjust the number of items per page as needed
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        // Fetching paginated data
        $data['transaksi'] = $this->ModelTransaksi->paginate($perPage, 'default', $currentPage);
        $data['pager'] = $this->ModelTransaksi->pager;

        return view('v_penjualan', $data);
    }

    public function PrintStruk($nk)
{
    $transaksi = $this->ModelTransaksi->find($nk);

    // Check if $transaksi is not empty
    if ($transaksi) {
        $detailTransaksi = $this->ModelTransaksi->GetDetailTransaksi($transaksi['nk']);

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

        // Inisialisasi array untuk menyimpan data laporan
        $data['laporan'][] = [
            'no' => 1,
            'nk' => $transaksi['nk'],
            'nm_kry' => $transaksi['nm_kry'],
            'jabatan' => $jabatan,
            'gajiPokok' => $gajiPokok,
            'status' => $detailTransaksi['status'],
            'tunjangan_anak' => $tunjanganAnak,
            'pph' => $pph,
            'gaji_bersih' => $gajiBersih,
            'total_tunjangan_anak' => $tunjanganAnak,
            'total_pph' => $pph,
            'total_gaji_bersih' => $gajiBersih,
        ];

        $data['transaksi'] = $transaksi;

        return view('v_print_struk', $data);
    } else {
        session()->setFlashdata('pesan_error', 'Transaksi tidak ditemukan.');
        return redirect()->back();
    }
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

}
