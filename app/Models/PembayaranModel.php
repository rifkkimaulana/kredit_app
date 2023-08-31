<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'tb_pembayaran';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'jenis_pembayaran',
        'kredit_id',
        'bukti_transfer',
        'no_kontrak',
        'jumlah_pembayaran',
        'no_referensi',
        'created_at',
        'status'
    ];

    public function getPembayaranByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function insertPembayaran($data)
    {
        return $this->insert($data);
    }
}
