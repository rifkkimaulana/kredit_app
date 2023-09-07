<?php

namespace App\Controllers\Kredit_App\Paylater;

use App\Controllers\Kredit_App\BaseController;

class Kontrak extends BaseController
{
    public function index()
    {
        $kontrakData = $this->kontrakModel->findAll();

        foreach ($kontrakData as $kontrak) {
            $noKontrak = $kontrak['no_kontrak'];

            $jumlahterbayar = $this->pembayaranModel->where('no_kontrak', $noKontrak)->countAllResults();
        }

        if (session('user_level') !== 'administrator') {
            $kontrakList = $this->kontrakModel->getKreditByUserId(session('user_id'));
        } else {
            $kontrakList = $this->kontrakModel->findAll();
        }

        $userMap = [];
        foreach ($this->userFindAll as $userData) {
            $userMap[$userData['user_id']] = $userData;
        }

        if (empty($jumlahterbayar)) {
            $jumlahterbayar = 0;
        }

        $data = [
            'title' => 'Daftar Kontrak',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,
            'jumlah_terbayar' => $jumlahterbayar,
            'kontrakList' => $kontrakList,
            'userMap' => $userMap
        ];
        return view('kredit_app/pages/Paylater/Kontrak', $data);
    }
}
