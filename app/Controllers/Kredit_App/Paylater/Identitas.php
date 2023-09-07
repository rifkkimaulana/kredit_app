<?php

namespace App\Controllers\Kredit_App\Paylater;

use App\Controllers\Kredit_App\BaseController;

class Identitas extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Peninjauan Identitas',
            'user' => $this->user,
            'identitasList' => $this->identitasFindAll,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label
        ];
        return view('kredit_app/pages/Paylater/IdentitasView', $data);
    }

    public function PeninjauanTerima($id)
    {
        $data = [
            'status' => 'Disetujui'
        ];

        $this->identitasModel->updateIdentitas($id, $data);

        session()->setFlashdata('success', 'Data identitas berhasil diverifikasi.');
        return redirect()->to(base_url('ka-paylater/peninjauan'));
    }

    public function PeninjauanTolak($id)
    {
        $data = [
            'status' => 'Tidak Disetujui'
        ];

        $this->identitasModel->updateIdentitas($id, $data);

        session()->setFlashdata('success', 'Data identitas berhasil diverifikasi.');
        return redirect()->to(base_url('ka-paylater/peninjauan'));
    }
}
