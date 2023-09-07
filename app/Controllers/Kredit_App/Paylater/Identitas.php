<?php

namespace App\Controllers\Kredit_App\Paylater;

use App\Controllers\Kredit_App\BaseController;

class Identitas extends BaseController
{
    public function index()
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

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
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $data = [
            'status' => 'Disetujui'
        ];

        $this->identitasModel->updateIdentitas($id, $data);

        session()->setFlashdata('success', 'Data identitas berhasil diverifikasi.');
        return redirect()->to(base_url('ka-paylater/peninjauan'));
    }

    public function PeninjauanTolak($id)
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $data = [
            'status' => 'Tidak Disetujui'
        ];

        $this->identitasModel->updateIdentitas($id, $data);

        session()->setFlashdata('success', 'Data identitas berhasil diverifikasi.');
        return redirect()->to(base_url('ka-paylater/peninjauan'));
    }

    public function delete($id)
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $this->identitasModel->deleteidentitas($id);

        return redirect()->to(base_url('ka-paylater/peninjauan'))->with('success', 'Pembayaran berhasil dihapus.');
    }
}
