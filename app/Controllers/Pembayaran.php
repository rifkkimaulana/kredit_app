<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\PembayaranModel;
use App\Models\KreditModel;

class Pembayaran extends BaseController
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
            && session('user_level') !== 'manager'
            && session('user_level') !== 'member'
        ) {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $pembayaranModel = new PembayaranModel();
        $bayar = $pembayaranModel->getPembayaranByUserId(session('user_id'));

        $kontrakModel = new KreditModel();
        $kontrakList = $kontrakModel->getKreditByUserId(session('user_id'));

        foreach ($kontrakList as $kredit) :
            $user_id = $kredit['user_id'];
            $kredit_id = $kredit['id'];
            $total_kredit = $kredit['total_kredit'];
            $jangka_waktu = $kredit['jangka_waktu'];
            $jumlah_bayar = $total_kredit / $jangka_waktu;
        endforeach;

        $data = [
            'title' => 'Pembayaran',
            'user' => $user,
            'pembayaran' => $bayar,
            'kontrakList' => $kontrakList,
            'total_bayar' => $jumlah_bayar,
            'user_id' => $user_id,
            'kredit_id' => $kredit_id
        ];

        return view('admin/pages/Pembayaran', $data);
    }

    public function pembayaranInsert()
    {
        $pembayaranModel = new PembayaranModel();

        if ($this->request->getMethod() === 'post') {

            $user_id = $this->request->getPost('user_id');
            $jenis_pembayaran = $this->request->getPost('jenis_pembayaran');
            $kredit_id = $this->request->getPost('kredit_id');
            $no_kontrak = $this->request->getPost('no_kontrak');
            $jumlah_pembayaran = $this->request->getPost('jumlah_bayar');
            $status = $this->request->getPost('status');

            function generateRandomReferenceNumber()
            {
                $characters = '0123456789';
                $length = 10;
                $referenceNumber = '';

                for ($i = 0; $i < $length; $i++) {
                    $randomIndex = rand(0, strlen($characters) - 1);
                    $referenceNumber .= $characters[$randomIndex];
                }

                return $referenceNumber;
            }

            $noReferensi = 'REF.' . generateRandomReferenceNumber();

            $data = [
                'user_id' => $user_id,
                'jenis_pembayaran' => $jenis_pembayaran,
                'kredit_id' => $kredit_id,
                'no_kontrak' => $no_kontrak,
                'jumlah_pembayaran' => $jumlah_pembayaran,
                'status' => $status,
                'no_referensi' => $noReferensi
            ];

            $gambar = $this->request->getFile('gambar');
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                $namaUnik = $gambar->getRandomName();
                $gambar->move(FCPATH . 'assets/image/pembayaran', $namaUnik);

                $data['bukti_transfer'] = $namaUnik;
            }

            $pembayaranModel->insertPembayaran($data);

            return redirect()->to(base_url('pembayaran'))->with('success', 'Pembayaran Berhasil dikirim.');
        }
    }
}
