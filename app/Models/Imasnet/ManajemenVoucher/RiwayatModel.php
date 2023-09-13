<?php

namespace App\Models\Imasnet\ManajemenVoucher;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
    protected $table = 'tb_im_vc_transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'voucher_id',
        'paket_id',
        'reseller_id',
        'pengirim_id',
        'server_id',
        'keterangan'
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
