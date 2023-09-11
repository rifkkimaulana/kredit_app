<?php

namespace App\Models\Imasnet\ManajemenVoucher;

use CodeIgniter\Model;

class PengirimModel extends Model
{
    protected $table = 'tb_im_vc_pengirim';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_lengkap',
        'alamat', 'telpon',
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
