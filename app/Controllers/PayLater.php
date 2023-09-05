<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\PembayaranModel;
use App\Models\KreditModel;

class PayLater extends BaseController
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
            && session('user_level') !== 'member'
        ) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to(base_url('login'));
        }

        $pembayaranModel = new PembayaranModel();
        $bayar = $pembayaranModel->getPembayaranByUserId(session('user_id'));

        $kontrakModel = new KreditModel();
        $kontrakList = $kontrakModel->getKreditByUserId(session('user_id'));

        $userMap = [];
        foreach ($userModel->findAll() as $userData) {
            $userMap[$userData['user_id']] = $userData;
        }

        foreach ($kontrakList as $kredit) :
            $user_id = $kredit['user_id'];
            $kredit_id = $kredit['id'];
            $total_kredit = $kredit['total_kredit'];
            $jangka_waktu = $kredit['jangka_waktu'];
            $jumlah_bayar = $total_kredit / $jangka_waktu;
        endforeach;

        if (empty($jumlah_bayar)) {
            $jumlah_bayar = 0;
            $user_id = 0;
            $kredit_id = 0;
        }
        $data = [
            'title' => 'Pembayaran',
            'user' => $user,
            'pembayaran' => $bayar,
            'kontrakList' => $kontrakList,
            'total_bayar' => $jumlah_bayar,
            'user_id' => $user_id,
            'kredit_id' => $kredit_id,
            'userMap' => $userMap
        ];

        return view('admin/pages/Pembayaran', $data);
    }

    public function KontrakView()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
            && session('user_level') !== 'member'
        ) {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $kontrakModel = new KreditModel();
        $pembayaranModel = new PembayaranModel();

        $kontrakData = $kontrakModel->findAll();

        foreach ($kontrakData as $kontrak) {
            $noKontrak = $kontrak['no_kontrak'];

            $jumlahterbayar = $pembayaranModel->where('no_kontrak', $noKontrak)->countAllResults();
        }


        if (session('user_level') !== 'administrator') {
            $kontrakList = $kontrakModel->getKreditByUserId(session('user_id'));
        } else {
            $kontrakList = $kontrakModel->findAll();
        }

        $userMap = [];
        foreach ($userModel->findAll() as $userData) {
            $userMap[$userData['user_id']] = $userData;
        }

        $data = [
            'title' => 'Daftar Kontrak',
            'user' => $user,
            'jumlah_terbayar' => $jumlahterbayar,
            'kontrakList' => $kontrakList,
            'userMap' => $userMap
        ];

        return view('admin/pages/Kontrak', $data);
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

            return redirect()->to(base_url('paylater/tagihan'))->with('success', 'Pembayaran Berhasil dikirim.');
        }
    }

    public function pembayaranKonfirmasi($id)
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
        ) {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $pembayaranModel = new PembayaranModel();
        $data = [
            'status' => 'Berhasil Diterima',
        ];

        $pembayaranModel->updatePembayaran($id, $data);

        return redirect()->to(base_url('paylater/tagihan'))->with('success', 'Konfirmasi Pembayaran Berhasil.');
    }

    public function delete($id)
    {

        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
        ) {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }
        $pembayaranModel = new PembayaranModel();
        $pembayaran = $pembayaranModel->find($id);

        if (!$pembayaran) {
            return redirect()->to(base_url('paylater/tagihan'))->with('error', 'Data Pembayaran tidak ditemukan.');
        }

        $pembayaranModel->deletePembayaran($id);

        return redirect()->to(base_url('paylater/tagihan'))->with('success', 'Pembayaran berhasil dihapus.');
    }
}
