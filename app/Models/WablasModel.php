<?php

namespace App\Models;

use CodeIgniter\Model;

class WablasModel extends Model
{
    protected $table = 'tb_wablas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'domain',
        'token_api'
    ];

    public function updateWablas($data)
    {
        $this->update(1, $data);
    }

    public function getTokenAndLink()
    {
        $result = $this->db->table('tb_wablas')->where('id', 1)->get()->getRow();

        return [
            'token_api' => $result->token_api,
            'domain' => $result->domain
        ];
    }
}
