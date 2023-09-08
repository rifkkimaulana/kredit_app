<?php

namespace App\Models\Imasnet\Inventory;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table = 'tb_im_inv_history';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'keterangan', 'jenis'
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
