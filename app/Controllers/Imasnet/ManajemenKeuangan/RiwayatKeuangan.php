<?php

namespace App\Controllers\Imasnet\ManajemenKeuangan;

use App\Models\Imasnet\ManajemenKeuangan\RiwayatTransaksiModel;

use App\Controllers\Imasnet\BaseController;

class RiwayatKeuangan extends BaseController
{
    public function index()
    {
        $riwayatTransaksiModel = new RiwayatTransaksiModel();

        $data = [
            'title' => 'Riwayat Keuangan',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'riwayatKeuanganData' => $riwayatTransaksiModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenKeuangan/RiwayatKeuangan', $data);
    }
}
