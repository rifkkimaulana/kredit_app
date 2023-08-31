<?php

namespace App\Models;

use CodeIgniter\Model;

class KreditModel extends Model
{
    protected $table = 'tb_kredit';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'no_kontrak',
        'jangka_waktu',
        'total_kredit',
        'tanggal_cetak',
        'jatuh_tempo',
        'created_at'
    ];

    public function getKreditByUserId($data)
    {
        return $this->where('user_id', $data)->findAll();
    }
}
