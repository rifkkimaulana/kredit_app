<?php

namespace App\Models;

use CodeIgniter\Model;

class AplikasiModel extends Model
{
    protected $table = 'tb_appsetting';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_aplikasi',
        'nama_perusahaan',
        'alamat1',
        'alamat2',
        'kode_pos',
        'email',
        'telpon',
        'logo',
        'bank1',
        'atas_nama1',
        'no_rekening1',
        'bank2',
        'atas_nama2',
        'no_rekening2',
        'bank3',
        'atas_nama3',
        'no_rekening3',
        'slug'
    ];

    public function updatePengaturan($id, $data)
    {
        $this->update($id, $data);
    }
}
