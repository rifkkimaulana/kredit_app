<?php

namespace App\Controllers\Kredit_App\Paylater;

use App\Controllers\Kredit_App\BaseController;

class Pembayaran extends BaseController
{
    public function index()
    {
        // Mengambil data pembayaran berdasarkan user_id
        $bayar = $this->pembayaranModel->where('user_id', session('user_id'))->findAll();

        // Mengambil daftar kontrak berdasarkan user_id
        $kontrakList = $this->kontrakModel->where('user_id', session('user_id'))->findAll();

        // Inisialisasi array userMap
        $userMap = [];

        foreach ($this->userFindAll as $userData) {
            $userMap[$userData['user_id']] = $userData;
        }

        // Inisialisasi total_bayar ke 0
        $total_bayar = 0;

        $data = [
            'title' => 'Daftar Pembayaran',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,

            'pembayaran' => $bayar,
            'kontrakList' => $kontrakList,
            'userMap' => $userMap,
        ];

        // Ambil nomor kontrak dari permintaan POST
        $nomorKontrak = $this->request->getPost('no_kontrak');

        if (!empty($nomorKontrak)) {
            // Dapatkan data kontrak berdasarkan nomor kontrak yang dipilih
            $kontrak = $this->kontrakModel->where('no_kontrak', $nomorKontrak)->first();

            if ($kontrak) {
                // Hitung jumlah bayar berdasarkan total kredit dan jangka waktu kontrak
                $total_kredit = $kontrak['total_kredit'];
                $jangka_waktu = $kontrak['jangka_waktu'];
                $total_bayar = $total_kredit / $jangka_waktu;
            }
        }

        // Perbarui total_bayar dalam data
        $data['total_bayar'] = $total_bayar;

        return view('kredit_app/pages/Paylater/Pembayaran', $data);
    }
}
