<?php

namespace App\Controllers\Auth;

use App\Controllers\Auth\BaseController;

class Recovery extends BaseController
{
    public function index($token)
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
            'token' => $token,
            'title' => 'Recovery Password'
        ];
        return view('login/pages/recovery-password', $data);
    }

    public function recovery_post()
    {
        $token = $this->request->getPost('token');

        $user = $this->usersModel->where('reset_token', $token)->first();

        if ($user) {
            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm-password');

            if ($password === $confirm_password) {
                // Hash password baru
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $data = [
                    'user_password' => $hashedPassword,
                    'reset_token' => null,
                ];

                $this->usersModel->updatePassword($user['user_id'], $data);

                session()->setFlashdata('success', 'Password berhasil dibuat ulang, silahkan login.');
                return redirect()->to(base_url('login'));
            } else {
                session()->setFlashdata('error', 'Password dan konfirmasi password tidak cocok.');
                return redirect()->to("recovery/$token");
            }
        } else {
            session()->setFlashdata('error', 'Gagal diperbaharui, Token expired.');
            return redirect()->to(base_url('login'));
        }
    }
}
