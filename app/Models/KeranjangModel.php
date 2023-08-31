<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table = 'tb_keranjang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'produk_id', 'harga_satuan', 'jumlah'];

    public function getKeranjangByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function addToKeranjang($data)
    {
        return $this->insert($data);
    }

    public function removeFromKeranjang($id)
    {
        return $this->delete($id);
    }

    public function deleteKeranjangwhereUserId($user_id)
    {
        return $this->where('user_id', $user_id)->delete();
    }

    // Keranjang for add cek data double
    public function isProductInKeranjang($produk_id, $user_id)
    {
        return $this->where(['produk_id' => $produk_id, 'user_id' => $user_id])->countAllResults() > 0;
    }
}
