<?php

namespace App\Controllers\Kredit_App;

use App\Controllers\Kredit_App\BaseController;

use App\Models\AktifitasModel;

class Log extends BaseController
{
    public function index()
    {
        $aktifitasModel = new AktifitasModel();

        $data = [
            'title' => 'Log Aktifitas',
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,
            'user' => $this->user,
            'aktifitas' => $aktifitasModel->findAll()
        ];

        return view('kredit_app/pages/LogActivity', $data);
    }
}
