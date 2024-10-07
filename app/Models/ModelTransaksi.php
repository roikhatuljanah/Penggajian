<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    protected $table = 'gaji'; // Tambahkan properti $table dengan nama tabel yang sesuai
    protected $primaryKey = 'nk'; // Sesuaikan dengan primary key tabel Anda

    public function AllData()
    {
        
        return $this->db->table('gaji')
            ->get()
            ->getResultArray();
    }

    public function InsertData($data)
    {
        $this->db->table('gaji')->insert($data);
    }

    public function UpdateData($nk, $data)
    {
        $this->db->table('gaji')
            ->where('nk', $nk)
            ->update($data);
    }

    public function DeleteData($nk)
    {
        $this->db->table('gaji')
            ->where('nk', $nk)
            ->delete();
    }

    public function GetDetailTransaksi($nk)
    {
    return $this->db->table('gaji')
        ->where('nk', $nk)
        ->get()
        ->getRowArray();
    }
}
