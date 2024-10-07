<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use CodeIgniter\Pagination\Pagination;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
    }

    public function index()
    {
        $model = new ModelTransaksi();
    
        // Configuring pagination
        $pager = \Config\Services::pager(null, null, false);
        $perPage = 10;  // Adjust the number of items per page as needed
        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
    
        // Fetching paginated data
        $data['transaksi'] = $model->paginate($perPage, 'default', $currentPage);
        $data['pager'] = $model->pager;
    
        $data['judul'] = 'Data Karyawan <br> PT Duta Cipta';
        $data['subjudul'] = 'Penggajian';
        $data['menu'] = 'Data Karyawan';
        $data['submenu'] = 'Karyawan';
        $data['page'] = 'v_transaksi';
    
        return view('v_template', $data);
    }
    

    public function InsertData()
    {
        
        $cek_login = [
            'level' => session()->get('level'),
        ];
         
    
        $data = [
            'nk' => $this->request->getPost('nk'),
            'nm_kry' => $this->request->getPost('nm_kry'),
            'kode_jab' => $this->request->getPost('kode_jab'),
            'status' => $this->request->getPost('status'),
            'anak' => $this->request->getPost('anak'),
        ];
    
        $this->ModelTransaksi->InsertData($data);
    
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !!');
    
        // Check the level and redirect accordingly
        if (isset($cek_login['level']) && $cek_login['level'] == 1) {
            return redirect()->to(base_url('Transaksi'));
        } else {
            return redirect()->to(base_url('Penjualan'));
        }
    }
    

    public function UpdateData($nk)
    {
        $data = [
            'nm_kry' => $this->request->getPost('nm_kry'),
            'kode_jab' => $this->request->getPost('kode_jab'),
            'status' => $this->request->getPost('status'),
            'anak' => $this->request->getPost('anak'),
        ];
        $this->ModelTransaksi->UpdateData($nk, $data);
        session()->setFlashdata('pesan', 'Data Berhasil Diupdate !!');
        return redirect()->to('Transaksi');
    }

    public function DeleteData($nk)
    {
        $this->ModelTransaksi->DeleteData($nk);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !!');
        return redirect()->to('Transaksi');
    }

    public function LaporanPenjualanKredit()
    {
        $transaksi = $this->ModelTransaksi->AllData(); // Ambil semua data transaksi
    
        $data['judul'] = 'Data Karyawan <br> PT Duta Cipta';
        $data['subjudul'] = 'Penggajian';
        $data['menu'] = 'Data Karyawan';
        $data['submenu'] = 'Karyawan';
    
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
    
        return view('v_laporan', $data);
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
