<?php

namespace App\Models;

use CodeIgniter\Model;

class IdentitasModel extends Model
{
    protected $table = 'tb_identitas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'nama_lengkap', 'nomor_identitas', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'alamat', 'agama', 'status_pernikahan',
        'pekerjaan', 'nomor_telepon', 'email', 'foto_identitas', 'foto_selvi_ktp',
        'created_at', 'updated_at', 'status', 'nomor_alternatif_1',
        'nama_alternatif_1'
    ];

    public function insertIdentitas($data)
    {
        return $this->insert($data);
    }

    public function updateIdentitas($id, $data)
    {
        return $this->update($id, $data);
    }
}
