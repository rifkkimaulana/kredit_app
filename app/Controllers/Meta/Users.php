<?php

namespace App\Controllers\Meta;

use App\Controllers\Meta\BaseController;

class Users extends BaseController
{
    public function index()
    {
        $userListAdministrator = $this->userModel->where('user_level', 'administrator')->findAll();
        $user = $this->userModel->where('user_id', session('user_id'))->first();

        $data = [
            'title' => 'Users Management',
            'user' => $user,
            'userList' => $userListAdministrator,
        ];

        return view('Meta/Pages/Users', $data);
    }
}
