<?php

namespace App\Models\Imasnet\ManajemenKeuangan;

use CodeIgniter\Model;

class JenisKeuanganModel extends Model
{
    protected $table = 'tb_im_keu_jenis';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kategori_id',
        'nama_jenis',
        'keterangan',
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
