<?php

namespace App\Controllers\Meta;

use App\Controllers\Meta\BaseController;

class Aplication extends BaseController
{
    public function index()
    {
        $user = $this->userModel->find(session('user_id'));

        $appList = $this->aplikasiModel->findAll();

        $data = [
            'title' => 'Aplication Management',
            'user' => $user,
            'appList' => $appList,
        ];

        return view('Meta/Pages/AppManagement', $data);
    }

    public function sign_in()
    {
        session()->remove('ApplicationId');

        if ($this->request->getMethod() === 'post') {

            $app_id = $this->request->getPost('app_id');

            session()->set('ApplicationId', $app_id);

            session()->setFlashdata('success', 'Anda berhasil beralih.');
            return redirect()->to(base_url('ka-dashboard'));
        }
    }
}
