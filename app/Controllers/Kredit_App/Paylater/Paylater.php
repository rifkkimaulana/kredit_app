<?php

namespace App\Controllers\Kredit_App\Paylater;

use App\Controllers\Kredit_App\BaseController;

class Paylater extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Peninjauan Kontrak',
            'user' => $this->user,
            'identitasList' => $this->identitasFindAll,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label
        ];

        return view('kredit_app/pages/Paylater/IdentitasView', $data);
    }

    public function verifikasi()
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $no_kontrak = $this->request->getPost('no_kontrak');

        if ($this->request->getMethod() === 'post') {
            $dataPenjualan = [
                'status' => 'PayLater Success'
            ];

            $dataKredit = [
                'status' => 'Disetujui'
            ];

            $this->kontrakModel->updateByNoKontrak($no_kontrak, $dataKredit);

            $this->penjualanModel->updateByNoKontrak($no_kontrak, $dataPenjualan);

            session()->setFlashdata('success', 'Data Transaksi dan Pembelian Kredit Berhasil Di Verifikasi.');
            return redirect()->to(base_url('ka-paylater/kontrak'));
        }
    }
}
