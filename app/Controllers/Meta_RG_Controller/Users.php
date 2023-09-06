<?php

namespace App\Controllers\Meta_RG_Controller;

use App\Controllers\Meta_RG_Controller\BaseController;

class Users extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Users Management',
            'user' => $this->user,
            'userList' => $this->userListAdministrator,
        ];

        return view('MetaView/Pages/Users', $data);
    }
}
