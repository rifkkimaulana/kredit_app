<?php

namespace App\Models\Imasnet\Inventory;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table = 'tb_im_inv_customers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_lengkap',
        'telpon',
        'alamat',
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
