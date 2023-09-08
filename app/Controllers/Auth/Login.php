<?php

namespace App\Controllers\Auth;

use App\Controllers\Auth\BaseController;

class Login extends BaseController
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
            'title' => 'Sign In Start Session'
        ];
        return view('login/pages/login', $data);
    }

    public function login_post()
    {
        $identitas = $this->request->getPost('user');
        $password = $this->request->getPost('password');

        if (filter_var($identitas, FILTER_VALIDATE_EMAIL)) {
            $pengguna = $this->usersModel->where('email', $identitas)->first();
        } else {
            $pengguna = $this->usersModel->where('user_username', $identitas)->first();
        }

        if ($pengguna && password_verify($password, $pengguna['user_password'])) {
            session()->set('user_id', $pengguna['user_id']);
            session()->set('user_level', $pengguna['user_level']);
            session()->set('ApplicationId', $pengguna['app_id']);

            // Jika kotak Remember Me dicentang, atur cookie
            if ($this->request->getPost('remember')) {
                // Enkripsi data yang akan disimpan dalam cookie
                $cookieValue = $pengguna['user_id'] . '|' . $pengguna['user_password'];

                // Set cookie dengan masa berlaku 30 hari
                $this->response->setCookie('remember_me', $cookieValue, 3600 * 24 * 30);
            }

            $aplikasi = $this->aplikasiModel->where('id', session('ApplicationId'))->first();

            if (session('user_level') === 'administrator') {
                return redirect()->to(base_url('meta/dashboard'));
            } else {
                if (!empty($aplikasi['slug'])) {
                    return redirect()->to(base_url($aplikasi['slug']));
                }
                return redirect()->to(base_url('login'));
            }
        } else {
            session()->setFlashdata('error', 'Kredensial tidak valid. Silakan coba lagi.');
            return redirect()->to(base_url('login'));
        }
    }

    //--------------------------------------------------------------------
}
