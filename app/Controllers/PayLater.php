<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IdentitasModel;
use App\Models\UsersModel;
use App\Models\PembayaranModel;
use App\Models\KreditModel;

use App\Models\KeranjangModel;
use App\Models\PenjualanModel;
use App\Models\ProdukModel;

class PayLater extends BaseController
{
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

    public function verifikasiPembelianPaylater()
    {
    }
}
