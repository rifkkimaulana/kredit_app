<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'tb_penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tanggal_penjualan',
        'id_users',
        'id_produk',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'metode_pembayaran',
        'status'
    ];

    public function insertPenjualan($data)
    {
        return $this->insert($data);
    }
}
