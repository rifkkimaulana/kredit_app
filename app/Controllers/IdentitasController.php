<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\IdentitasModel;

class IdentitasController extends BaseController
{

    public function Peninjauan_view()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }

        if (session('user_level') !== 'administrator') {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $identitasModel = new IdentitasModel();
        $identitas = $identitasModel->findAll();

        $data = [
            'user' => $user,
            'title' => 'Daftar Peninjauan Identitas',
            'identitasList' => $identitas
        ];

        return view('admin/pages/PeninjauanIdentitas', $data);
    }

    public function PeninjauanTerima($id)
    {
        $identitasModel = new IdentitasModel();

        $data = [
            'status' => 'Disetujui'
        ];

        $identitasModel->updateIdentitas($id, $data);

        session()->setFlashdata('success', 'Data identitas berhasil diverifikasi.');
        return redirect()->to(base_url('paylater/peninjauan'));
    }

    public function PeninjauanTolak($id)
    {
        $identitasModel = new IdentitasModel();

        $data = [
            'status' => 'Tidak Disetujui'
        ];

        $identitasModel->updateIdentitas($id, $data);

        session()->setFlashdata('success', 'Data identitas berhasil diverifikasi.');
        return redirect()->to(base_url('paylater/peninjauan'));
    }
    //--------------------------------------------------------------------
}
