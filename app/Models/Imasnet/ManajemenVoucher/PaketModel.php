<?php

namespace App\Models\Imasnet\ManajemenVoucher;

use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $table = 'tb_im_vc_paket';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_paket',
        'harga_beli',
        'harga_jual',
        'fee_pengirim'
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
