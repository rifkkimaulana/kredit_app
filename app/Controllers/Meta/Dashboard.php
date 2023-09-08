<?php

namespace App\Controllers\Meta;

use App\Controllers\Meta\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $user = $this->userModel->find(session('user_id'));

        $data = [
            'title' => 'META IMASNET Panel',
            'user' => $user
        ];

        return view('Meta/Pages/Dashboard', $data);
    }
}
