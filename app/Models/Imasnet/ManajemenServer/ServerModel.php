<?php

namespace App\Models\Imasnet\ManajemenServer;

use CodeIgniter\Model;

class ServerModel extends Model
{
    protected $table = 'tb_im_server';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_server',
        'nama_server',
        'alamat_server',
        'latitude',
        'longitude',
        'pengelola_id'
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
