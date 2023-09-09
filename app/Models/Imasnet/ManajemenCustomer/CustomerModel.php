<?php

namespace App\Models\Imasnet\ManajemenCustomer;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'tb_ims_customer';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_pelanggan',
        'nama_pelanggan',
        'alamat',
        'telpon',
        'latitude',
        'longitude',
        'status',
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
