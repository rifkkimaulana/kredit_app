<?php

namespace App\Models\Imasnet\ManajemenServer;

use CodeIgniter\Model;

class PengelolaModel extends Model
{
    protected $table = 'tb_im_srv_pengelola';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_lengkap',
        'alamat',
        'telpon'
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
