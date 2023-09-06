<?php

namespace App\Controllers\Meta_RG_Controller;

use App\Controllers\Meta_RG_Controller\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $user = $this->userModel->find(session('user_id'));

        $data = [
            'title' => 'META RG Panel',
            'user' => $user
        ];

        return view('MetaView/Pages/Dashboard', $data);
    }
}
