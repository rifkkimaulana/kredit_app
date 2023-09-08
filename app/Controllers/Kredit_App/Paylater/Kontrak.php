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

        $kontrakFindSessionUserId = $this->kontrakModel->where('user_id', session('user_id'))->findAll();

        if (session('user_level') !== 'administrator') {
            $kontrakList = $kontrakFindSessionUserId;
        } else {
            $kontrakList = $this->kontrakModel->findAll();
        }

        $userFindAll = $this->userModel->findAll();

        $userMap = [];
        foreach ($userFindAll as $userData) {
            $userMap[$userData['user_id']] = $userData;
        }

        $jumlahterbayar = '0';
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

    public function deleteKontrak($id)
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $kontrak = $this->kontrakModel->where('id', $id)->first();

        $no_transaksi = $kontrak['no_transaksi'];

        $this->penjualanModel->deletePenjualanWhereNoTransaksi($no_transaksi);

        $this->kontrakModel->deleteKontrak($id);

        return redirect()->to(base_url('ka-paylater/kontrak'))->with('success', 'Kontrak berhasil dihapus.');
    }
}
