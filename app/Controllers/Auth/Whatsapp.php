<?php

namespace App\Controllers\Auth;

use App\Controllers\Auth\BaseController;

class Whatsapp extends BaseController
{
    public function index()
    {
        $aplikasi = $this->aplikasiModel->where('id', session('ApplicationId'))->first();

        if (!empty(session('user_id'))) {
            if (session('user_level') === 'administrator') {
                return redirect()->to(base_url('meta/dashboard'));
            } else {
                return redirect()->to(base_url($aplikasi['slug']));
            }
        }

        $data = [
            'title' => 'Recovery Password'
        ];

        return view('login/pages/WhatsappLogin', $data);
    }

    public function signWhatsappNumber_post()
    {
        $no_wa = $this->request->getPost('no_wa');

        $user = $this->usersModel->where('no_wa', $no_wa)->first();

        if ($user) {

            $noWa = $user['no_wa'];
            $user_id = $user['user_id'];

            $token = bin2hex(random_bytes(16));
            $this->usersModel->loginToken($user_id, $token, $noWa);

            session()->setFlashdata('success', 'Silahkan cek link untuk login anda di whatsapp.');
            return redirect()->to(base_url('login'));
        } else {
            session()->setFlashdata('error', 'Nomor yang anda masukan belum terdaftar.');
            return redirect()->to(base_url('whatsapp'));
        }
    }

    public function signWhatsappNumber_login($token)
    {
        $user = $this->usersModel->where('reset_token', $token)->first();

        if ($user) {
            $id = $user['user_id'];

            session()->set('user_id', $user['user_id']);
            session()->set('user_level', $user['user_level']);
            session()->set('ApplicationId', $user['app_id']);

            $data = [
                'reset_id' => '',
                'reset_token' => ''
            ];

            $this->usersModel->updateUser($id, $data);

            session()->setFlashdata('success', 'berhasil login menggunakan whatsapp.');

            if (session('user_level') === 'administrator') {
                return redirect()->to(base_url('meta/dashboard'));
            } else {
                $aplikasi = $this->aplikasiModel->where('id', session('ApplicationId'))->first();

                if (!empty($aplikasi['slug'])) {
                    return redirect()->to(base_url($aplikasi['slug']));
                }
                return redirect()->to(base_url('login'));
            }
        } else {
            session()->setFlashdata('error', 'Link login anda sudah tidak berlaku');
            return redirect()->to(base_url('whatsapp'));
        }
    }
}
