<?php

namespace App\Models\Imasnet\ManajemenKeuangan;

use CodeIgniter\Model;

class RiwayatTransaksiModel extends Model
{
    protected $table = 'tb_im_keu_riwayat';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'keuangan_id',
        'kategori_id',
        'jenis_id',
        'pengelola_id',
        'keterangan'
    ];

    public function insertData($data)
    {
        return $this->insert($data);
    }
}
