<?php

namespace App\Models\Imasnet\ManajemenAssets;

use CodeIgniter\Model;

class AssetsModel extends Model
{
    protected $table = 'tb_im_assets';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kategori_id',
        'nama_assets',
        'keterangan',
        'penanggung_jawab',
        'latitude',
        'longitude',
        'harga_satuan',
        'jumlah',
        'satuan',
        'created_at',
        'updated_at'
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
