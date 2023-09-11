<?php

namespace App\Models\Imasnet\ManajemenVoucher;

use CodeIgniter\Model;

class ResellerModel extends Model
{
    protected $table = 'tb_im_vc_reseller';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_lengkap',
        'alamat',
        'telpon',
        'latitude',
        'longitude',
        'status'
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
