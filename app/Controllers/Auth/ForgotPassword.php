<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class ForgotPassword extends BaseController
{
    public function index()
    {
        if (session()->has('user_id')) {
            $userLevel = session('user_level');

            if ($userLevel === 'administrator') {
                return redirect()->to(base_url('meta/dashboard'));
            } else {
                return redirect()->to(base_url($this->aplikasi['slug']));
            }
        }

        $data = [
            'title' => 'Forgot Password'
        ];
        return view('login/pages/forgot-password', $data);
    }

    public function forgot_password_post()
    {
        $email = $this->request->getPost('email');

        $user = $this->usersModel->where('email', $email)->first();

        if ($user) {

            $noWa = $user['no_wa'];

            $token = bin2hex(random_bytes(16));
            $this->usersModel->updateResetToken($email, $token, $noWa);

            session()->setFlashdata('success', 'Password recovery email has been sent.');
            return redirect()->to(base_url('forgot-password'));
        } else {
            session()->setFlashdata('error', 'Email not found in our records.');
            return redirect()->to(base_url('forgot-password'));
        }
    }
}
