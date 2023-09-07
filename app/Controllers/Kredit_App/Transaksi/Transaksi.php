<?php

namespace App\Controllers\Kredit_App\Transaksi;

use App\Controllers\Kredit_App\BaseController;

class Transaksi extends BaseController
{
    public function index()
    {
        $userMap = [];
        foreach ($this->userFindAll as $users) {
            $userMap[$users['user_id']] = $users;
        }

        $produkMap = [];
        foreach ($this->produkFindAll as $produk) {
            $produkMap[$produk['id']] = $produk;
        }

        $data = [
            'title' => 'Management Transaksi',
            'user' => $this->user,
            'penjualanFindAll' => $this->penjualanFindAll,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,
            'userMap' => $userMap,
            'produkMap' => $produkMap
        ];
        return view('kredit_app/pages/Transaksi/Transaksi', $data);
    }

    public function transaksi_post()
    {
        if ($this->request->getMethod() === 'post') {
            $keranjang = $this->keranjangModel->getKeranjangByUser(session('user_id'));
            if (!empty($keranjang)) {
                if (isset($_POST['setujukebijakan'])) {

                    // Seleksi Pembelian Transfer, tunai dan Paylater
                    if (isset($_POST['metode_pembayaran']) && ($_POST['metode_pembayaran'] === 'Tunai' || $_POST['metode_pembayaran'] === 'Transfer')) {

                        $metode_pembayaran = $this->request->getPost('metode_pembayaran');
                        $status = $this->request->getPost('status');
                        $id_userpelanggan = $this->request->getPost('user_id');

                        foreach ($keranjang as $item) {
                            $produk_id = $item['produk_id'];
                            $harga_satuan = $item['harga_satuan'];
                            $jumlah = $item['jumlah'];
                            $total_harga = $harga_satuan * $jumlah;

                            $tanggal = date("Ymd");
                            $waktu = date("His");
                            $nomor_transaksi = $tanggal . $waktu;


                            $karakter_acak = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
                            $nomor_referensi = $tanggal . $waktu . $karakter_acak;

                            $tanggal_penjualan = date('Y-m-d');
                            $data = [
                                'id_users' => $id_userpelanggan,
                                'id_produk' => $produk_id,
                                'jumlah' => $jumlah,
                                'harga_satuan' => $harga_satuan,
                                'total_harga' => $total_harga,
                                'metode_pembayaran' => $metode_pembayaran,
                                'status' => $status,
                                'tanggal_penjualan' => $tanggal_penjualan,
                                'no_transaksi' => $nomor_transaksi,
                                'no_referensi' => $nomor_referensi
                            ];

                            $this->penjualanModel->insert($data);
                            $this->keranjangModel->deleteKeranjangwhereUserId(session('user_id'));
                        }

                        // Tampilkan pesan sukses atau selesaikan transaksi
                        session()->setFlashdata('success', 'Transaksi berhasil dilakukan.');
                        return redirect()->to(base_url('ka-transaksi/transaksi'));
                    }

                    // Jalankan script ini untuk metode pembayaran Paylater
                    if (isset($_POST['metode_pembayaran']) && ($_POST['metode_pembayaran'] === 'Paylater')) {

                        $id_userpelanggan = $this->request->getPost('user_id');

                        $identitas = $this->identitasModel->where('user_id', $id_userpelanggan)->first();

                        if ($identitas['status'] === 'Disetujui') {
                            if ($this->request->getMethod() === 'post') {

                                $tenor_pembayaran = $this->request->getPost('tenor_pembayaran');
                                $status = $this->request->getPost('status');

                                foreach ($keranjang as $item) {
                                    $produk_id = $item['produk_id'];
                                    $harga_satuan = $item['harga_satuan'];
                                    $jumlah = $item['jumlah'];
                                    $total_harga = $harga_satuan * $jumlah;

                                    // Create nomor Transaksi ke tabel penjualan
                                    $tanggal = date("Ymd");
                                    $waktu = date("His");
                                    $nomor_transaksi = $tanggal . $waktu;

                                    // Create Nomor acak untuk nomor referensi transaksi
                                    $karakter_acak = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 10);
                                    $nomor_referensi = $tanggal . $waktu . $karakter_acak;

                                    // Create nomor kontrak untuk tabel penjualan dan kontrak id
                                    $tanggalSaatIni = date("Y");
                                    $randomAngka = mt_rand(10000, 99999);
                                    $no_kontrak = $tanggalSaatIni . $randomAngka;

                                    $dataPenjualan = [
                                        'id_users' => $id_userpelanggan,
                                        'id_produk' => $produk_id,
                                        'jumlah' => $jumlah,
                                        'harga_satuan' => $harga_satuan,
                                        'total_harga' => $total_harga,
                                        'metode_pembayaran' => 'Kredit Paylater',
                                        'status' => $status,
                                        'tanggal_penjualan' => date('Y-m-d'),
                                        'no_transaksi' => $nomor_transaksi,
                                        'no_referensi' => $nomor_referensi,
                                        'no_kontrak' => $no_kontrak
                                    ];

                                    $dataKredit = [
                                        'no_kontrak' => $no_kontrak,
                                        'user_id' => $id_userpelanggan,
                                        'jangka_waktu' => $tenor_pembayaran,
                                        'total_kredit' => $total_harga,
                                        'tanggal_cetak' => '5',
                                        'jatuh_tempo' => '20',
                                        'status' => 'Sedang Ditinjau',
                                        'no_transaksi' => $nomor_transaksi
                                    ];

                                    $this->kontrakModel->insertKredit($dataKredit);

                                    $this->penjualanModel->insertPenjualan($dataPenjualan);

                                    $this->keranjangModel->deleteKeranjangwhereUserId(session('user_id'));
                                }
                                session()->setFlashdata('success', 'Transaksi berhasil dilakukan.');
                                return redirect()->to(base_url('ka-paylater/kontrak'));
                            }
                        } else {
                            session()->setFlashdata('error', 'Silahkan lakukan dulu pengajuan identitas anda, agar dapat melakukan pembelian secara kredit');
                            return redirect()->to(base_url('ka-settings/profile'));
                        }
                    }
                } else {
                    session()->setFlashdata('error', 'Silahkan centang setuju untuk segala aturan dan kebijakan kami.');
                    return redirect()->to(base_url('ka-transaksi/keranjang'));
                }
            } else {
                session()->setFlashdata('error', 'Keranjang belanja kosong.');
                return redirect()->to(base_url('ka-transaksi/keranjang'));
            }
        }
    }

    public function transaksi_delete($id)
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $penjualanViewId = $this->penjualanModel->find($id);

        if (!$penjualanViewId) {
            return redirect()->to(base_url('ka-transaksi/transaksi'))->with('error', 'Penjualan ini tidak ditemukan di database.');
        }

        $this->penjualanModel->deletePenjualan($id);

        return redirect()->to(base_url('ka-transaksi/transaksi'))->with('success', 'Penjualan berhasil dihapus.');
    }

    public function verifikasi()
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        if ($this->request->getMethod() === 'post') {

            $penjualan_id = $this->request->getPost('penjualan_id');
            $produk_id = $this->request->getPost('produk_id');
            $jumlah_beli = $this->request->getPost('jumlah_beli');
            $stok_produk = $this->request->getPost('stok_produk');

            $updateStok = $stok_produk - $jumlah_beli;

            $dataPenjualan = [
                'status' => 'Lunas',
            ];

            $dataProduk = [
                'stok' => $updateStok
            ];

            $this->penjualanModel->updatePenjualan($penjualan_id, $dataPenjualan);
            $this->produkModel->updateProduk($produk_id, $dataProduk);

            session()->setFlashdata('success', 'Transaksi ini berhasil diverifikasi.');
            return redirect()->to(base_url('k-transaksi/transaksi'));
        }
    }
}
