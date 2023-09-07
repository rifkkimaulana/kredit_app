<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table = 'tb_penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'no_transaksi',
        'tanggal_penjualan',
        'id_users',
        'id_produk',
        'jumlah',
        'harga_satuan',
        'total_harga',
        'metode_pembayaran',
        'status',
        'no_referensi',
        'no_kontrak'
    ];

    public function getPenjualanById($id_users)
    {
        return $this->where('id_users', $id_users)->findAll();
    }

    public function insertPenjualan($data)
    {
        return $this->insert($data);
    }

    public function deletePenjualan($id)
    {
        return $this->where('id', $id)->delete();
    }

    public function deletePenjualanWhereNoTransaksi($data)
    {
        return $this->where('no_transaksi', $data)->delete();
    }

    public function updatePenjualan($id, $data)
    {
        $this->update($id, $data);
    }

    public function updateByNoKontrak($noKontrak, $data)
    {
        $this->set($data)
            ->where('no_kontrak', $noKontrak)
            ->update();
    }
}
