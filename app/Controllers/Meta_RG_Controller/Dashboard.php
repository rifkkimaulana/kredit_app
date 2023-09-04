<?php

namespace App\Controllers\Meta_RG_Controller;

use App\Controllers\Meta_RG_Controller\BaseController;
use App\Models\UsersModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        $data = [
            'title' => 'META RG Panel',
            'user' => $user
        ];

        return view('MetaView/Pages/Dashboard', $data);
    }
}
