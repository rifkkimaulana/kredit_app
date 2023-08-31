<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\AktifitasModel;

class LogAktifitas extends BaseController
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
            && session('user_level') !== 'manager'
            && session('user_level') !== 'member'
        ) {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $aktifitasModel = new AktifitasModel();

        $data = [
            'title' => 'Log Aktifitas',
            'user' => $user,
            'aktifitas' => $aktifitasModel->findAll()
        ];

        return view('admin/pages/logAktifitas', $data);
    }
}
