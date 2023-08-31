<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'tb_produk';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_produk', 'deskripsi', 'harga', 'stok', 'gambar', 'kategori_id'
    ];

    public function getProdukWithKategori()
    {
        $produk = $this->findAll();

        foreach ($produk as $key => $product) {
            $kategoriModel = new KategoriProdukModel();
            $kategori = $kategoriModel->find($product['kategori_id']);
            $produk[$key]['kategori'] = $kategori;
        }

        return $produk;
    }

    public function insertProduk($data)
    {
        return $this->insert($data);
    }

    public function updateProduk($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteProduk($id)
    {
        $this->where('id', $id)->delete();
    }
}
