<?php

namespace App\Models\Imasnet\ManajemenVoucher;

use CodeIgniter\Model;

class VoucherModel extends Model
{
    protected $table = 'tb_im_voucher';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'code',
        'komentar',
        'paket_id'
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
