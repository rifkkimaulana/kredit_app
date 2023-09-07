<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class Register extends BaseController
{
    public function index()
    {
        if (!empty(session('user_id'))) {
            if (session('user_level') === 'administrator') {
                return redirect()->to(base_url('meta/dashboard'));
            } else {
                return redirect()->to(base_url($this->aplikasi['slug']));
            }
        }

        $data = [
            'title' => 'Register User for Login',
        ];
        return view('login/pages/register', $data);
    }

    public function register_post()
    {
        $userNama = $this->request->getPost('user_nama');
        $user_username = $this->request->getPost('user_username');
        $no_wa = $this->request->getPost('no_wa');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm-password');

        if ($password !== $confirmPassword) {
            session()->setFlashdata('error', 'Password confirmation does not match.');
            return redirect()->to(base_url('register'));
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Cek Ketersediaan Username
        if ($this->usersModel->where('user_username', $user_username)->countAllResults() > 0) {
            session()->setFlashdata('error', 'Username ini sudah digunakan.');
            return redirect()->to(base_url('register'));
        }

        // Cek Ketersediaan Nomor Whatsapp
        if ($this->usersModel->where('no_wa', $no_wa)->countAllResults() > 0) {
            session()->setFlashdata('error', 'Nomor Whatsapp sudah digunakan.');
            return redirect()->to(base_url('register'));
        }

        $email = uniqid() . '_cth@email.com';

        $userData = [
            'user_nama' => $userNama,
            'user_username' => $user_username,
            'email' => $email,
            'no_wa' => $no_wa,
            'user_password' => $hashedPassword,
            'user_level' => 'member',
            'app_id' => '1'
        ];

        $this->usersModel->insertUsersMember($userData);

        session()->setFlashdata('success', 'Anda sekarang terdaftar di sistem kami silahkan login menggunakan username dan password yang anda buat!.');
        return redirect()->to(base_url('login'));
    }

    //--------------------------------------------------------------------
}
