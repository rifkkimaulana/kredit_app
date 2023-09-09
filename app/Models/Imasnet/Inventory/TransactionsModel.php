<?php

namespace App\Models\Imasnet\Inventory;

use CodeIgniter\Model;

class TransactionsModel extends Model
{
    protected $table = 'tb_im_inv_transaction';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'keterangan',
        'supliers_id',
        'customers_id',
        'inventory_id',
        'biaya',
        'jumlah',
        'created_at'
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
