<?php

namespace App\Controllers\Meta_RG_Controller;

use App\Controllers\Meta_RG_Controller\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));
        $userList = $userModel->where('user_level', 'administrator')->findAll();

        $data = [
            'title' => 'Users Management',
            'user' => $user,
            'userList' => $userList
        ];

        return view('MetaView/Pages/Users', $data);
    }
}
