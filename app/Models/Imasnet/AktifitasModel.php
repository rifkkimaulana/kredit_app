<?php

namespace App\Models\Imasnet;

use CodeIgniter\Model;

class AktifitasModel extends Model
{
    protected $table = 'tb_im_log';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'keterangan',
        'ip_address'
    ];
}
