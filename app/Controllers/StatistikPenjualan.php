<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenjualanModel;
use App\Models\UsersModel;

class StatistikPenjualan extends BaseController
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

        $data = [
            'title' => 'Statistik Penjualan',
            'user' => $user,
        ];

        return view('admin/pages/Statistik', $data);
    }
}
