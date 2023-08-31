<?php

namespace App\Models;

use CodeIgniter\Model;

class GoogleApiModel extends Model
{
    protected $table = 'tb_google_api_login';
    protected $primaryKey = 'id';
    protected $allowedFields = ['client_id', 'client_secret'];

    public function updateGoogle($data)
    {
        $this->update(1, $data);
    }
}
