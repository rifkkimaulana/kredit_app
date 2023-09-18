<?php

namespace App\Models\Imasnet\ManajemenKeuangan;

use CodeIgniter\Model;

class PengelolaKeuanganModel extends Model
{
    protected $table = 'tb_im_keu_pengelola';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'saldo',
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
