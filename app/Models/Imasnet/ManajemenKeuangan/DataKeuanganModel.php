<?php

namespace App\Models\Imasnet\ManajemenKeuangan;

use CodeIgniter\Model;

class DataKeuanganModel extends Model
{
    protected $table = 'tb_im_keuangan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'jenis_id',
        'pengelola_id',
        'pemasukan',
        'pengeluaran',
        'keterangan',
        'foto',
        'no_referensi',
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
