<?php

namespace App\Models;

use CodeIgniter\Model;

class AktifitasModel extends Model
{
    protected $table = 'tb_log_aktifitas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'keterangan',
        'ip_address'
    ];

    public function getAktifitasByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function insertAktifitas($data)
    {
        return $this->insert($data);
    }

    public function removeAktifitasById($id)
    {
        return $this->delete($id);
    }

    public function removeAktifitasByUserId($user_id)
    {
        return $this->where('user_id', $user_id)->delete();
    }
}
