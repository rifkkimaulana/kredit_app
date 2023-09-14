<?php

namespace App\Controllers\Imasnet;

use App\Models\Imasnet\AktifitasModel;

class ActivityLog extends BaseController
{
    public function index()
    {
        $aktifitasModel = new AktifitasModel();
        $data = [
            'title' => 'Riwayat Aktifitas Pengguna',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'logData' => $aktifitasModel->findAll(),
        ];
        return view('Imasnet/Pages/Log/LogActivity', $data);
    }

    //--------------------------------------------------------------------
}
