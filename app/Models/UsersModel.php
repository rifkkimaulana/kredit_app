<?php

namespace App\Models;

use App\Models\WablasModel;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tb_users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = [
        'user_nama', 'user_username', 'user_password', 'user_foto',
        'user_level', 'email', 'no_wa', 'reset_token', 'reset_id',
        'keterangan', 'country', 'facebook', 'tweeter', 'instagram'
    ];

    public function updateResetToken($email, $token, $noWa)
    {
        $wablasModel = new WablasModel();
        $wablasData = $wablasModel->getTokenAndLink();

        $tokenWa = $wablasData['token_api'];
        $link_server = $wablasData['domain'];

        $recoveryURL = base_url() . '/recovery/' . $token;
        $message = "Permintaan reset password diterima. Klik link berikut: $recoveryURL";

        $curl = curl_init();

        $data = [
            'phone' => $noWa,
            'message' => $message,
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: $tokenWa",
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, $link_server);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($result, true);

        //$device_id = $response['data']['device_id'];
        //$pesan = $data['message'];
        //$status = $response['data']['messages'][0]['status'];
        $id_pesan = $response['data']['messages'][0]['id'];

        $this->set([
            'reset_token' => $token,
            'reset_id' => $id_pesan
        ])
            ->where('email', $email)
            ->update();
    }

    public function updatePassword($userId, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $userId);
        $builder->update($data);
    }

    public function insertUsersMember($data)
    {
        $this->insert($data);
    }

    public function updateUser($userId, $data)
    {
        $this->set($data)
            ->where('user_id', $userId)
            ->update();
    }

    public function deleteUser($userId)
    {
        $this->where('user_id', $userId)->delete();
    }
}
