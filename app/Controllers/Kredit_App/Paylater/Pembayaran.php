<?php

namespace App\Controllers\Kredit_App\Paylater;

use App\Controllers\Kredit_App\BaseController;

class Pembayaran extends BaseController
{
    public function index()
    {

        $userMap = [];

        foreach ($this->userFindAll as $userData) {
            $userMap[$userData['user_id']] = $userData;
        }

        if (session('user_level') !== 'administrator') {
            $pembayaran = $this->pembayaranFindSessionUserId;
        } else {
            $pembayaran = $this->pembayaranModel->findAll();
        }

        $data = [
            'title' => 'Daftar Pembayaran',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,
            'pembayaran' => $pembayaran,
            'kontrakList' => $this->kontrakFindSessionUserId,
            'userMap' => $userMap,
        ];

        return view('kredit_app/pages/Paylater/Pembayaran', $data);
    }

    public function getHargaPembayaran()
    {
        $nomorKontrak = $this->request->getPost('no_kontrak');
        $total_bayar = 0;

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

        return $this->response->setJSON(['total_bayar' => $total_bayar]);
    }

    public function pembayaranInsert()
    {
        if ($this->request->getMethod() === 'post') {

            $jenis_pembayaran = $this->request->getPost('jenis_pembayaran');
            $no_kontrak = $this->request->getPost('no_kontrak');

            if (($no_kontrak) !== 'null') {

                $kontrak = $this->kontrakModel->where('no_kontrak', $no_kontrak)->first();

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

                if ($no_kontrak !== 'null') {
                    $total_kredit = $kontrak['total_kredit'];
                    $jangka_waktu = $kontrak['jangka_waktu'];
                    $total_bayar = $total_kredit / $jangka_waktu;
                } else {
                    $total_bayar = 0;
                }

                $data = [
                    'user_id' => $kontrak['user_id'],
                    'jenis_pembayaran' => $jenis_pembayaran,
                    'kredit_id' => $kontrak['id'],
                    'no_kontrak' => $no_kontrak,
                    'jumlah_pembayaran' => $total_bayar,
                    'status' => 'Menunggu Konfirmasi',
                    'no_referensi' => $noReferensi
                ];

                $gambar = $this->request->getFile('gambar');
                if ($gambar->isValid() && !$gambar->hasMoved()) {
                    $namaUnik = $gambar->getRandomName();
                    $gambar->move(FCPATH . 'assets/image/pembayaran', $namaUnik);

                    $data['bukti_transfer'] = $namaUnik;
                }

                $this->pembayaranModel->insertPembayaran($data);

                return redirect()->to(base_url('ka-paylater/pembayaran'))->with('success', 'Pembayaran Berhasil dikirim.');
            } else {
                return redirect()->to(base_url('ka-paylater/pembayaran'))->with('error', 'Harap pilih nomor kontrak anda untuk pembayaran.');
            }
        }
    }

    public function pembayaranKonfirmasi($id)
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $data = [
            'status' => 'Berhasil Diterima',
        ];

        $this->pembayaranModel->updatePembayaran($id, $data);

        return redirect()->to(base_url('ka-paylater/pembayaran'))->with('success', 'Konfirmasi Pembayaran Berhasil.');
    }

    public function delete($id)
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $this->pembayaranModel->deletePembayaran($id);

        return redirect()->to(base_url('ka-paylater/pembayaran'))->with('success', 'Pembayaran berhasil dihapus.');
    }
}
