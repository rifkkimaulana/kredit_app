<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\WablasModel;

class CommingSoon extends BaseController
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


        $WablasModel = new WablasModel();
        $data = [
            'title' => 'Cooming Soon',
            'user' => $user,
            'wa' => $WablasModel->find(1)
        ];
        return view('admin/pages/ComingSoon', $data);
    }

    //--------------------------------------------------------------------
}
