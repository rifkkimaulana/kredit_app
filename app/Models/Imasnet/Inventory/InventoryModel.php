<?php

namespace App\Models\Imasnet\Inventory;

use CodeIgniter\Model;

class InventoryModel extends Model
{
    protected $table = 'tb_im_inventori';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'location_id',
        'suppliers_id',
        'customer_id',
        'categories_id',
        'nama_barang',
        'stok',
        'satuan',
        'harga_satuan',
        'keterangan',
        'foto',
        'created_at',
        'updated_at'
    ];

    public function insertData($data)
    {
        return $this->insert($data);
    }

    public function updateId($id, $data)
    {
        $this->set($data)->where('id', $id)->update();
    }

    public function deleteId($id)
    {
        return $this->where('id', $id)->delete();
    }
}
