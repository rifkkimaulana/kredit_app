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

        if (empty($jumlahterbayar)) {
            $jumlahterbayar = 0;
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

    public function formKontrakNew()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }

        if (session('user_level') !== 'administrator'  && session('user_level') !== 'member') {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $keranjangModel = new KeranjangModel();
        $produkModel = new ProdukModel();

        $keranjangItems = $keranjangModel->getKeranjangByUser(session('user_id'));
        $produkIds = array_column($keranjangItems, 'produk_id');

        $produk = [];
        foreach ($produkIds as $productId) {
            $product = $produkModel->find($productId);
            if ($product) {
                $produk[$productId] = $product;
            }
        }

        $data = [
            'title' => 'Keranjang Pembelian Kredit',
            'userList' => $userModel->findAll(),
            'keranjang' => $keranjangItems,
            'user' => $user,
            'produk' => $produk,
            'products' => $produkModel->findAll()
        ];

        return view('admin/pages/FormKeranjang', $data,);
    }

    public function hapusProdukKeranjang($id)
    {
        $keranjangModel = new KeranjangModel();
        $keranjang = $keranjangModel->find($id);

        if (!$keranjang) {
            return redirect()->to(base_url('paylater/pendaftaran_kontrak'))->with('error', 'Data Keranjang tidak ditemukan.');
        }

        $keranjangModel->removeFromKeranjang($id);

        return redirect()->to(base_url('paylater/pendaftaran_kontrak'))->with('success', 'Produk di keranjang berhasil dihapus.');
    }

    public function cekoutPembayaranPaylater()
    {
        $id_userpelanggan = $this->request->getPost('user_id');

        $identitasModel = new IdentitasModel();
        $identitas = $identitasModel->where('user_id', $id_userpelanggan)->first();

        if ($identitas['status'] === 'Disetujui') {
            if ($this->request->getMethod() === 'post') {
                if (isset($_POST['setuju'])) {
                    $tenor_pembayaran = $this->request->getPost('tenor_pembayaran');
                    $status = $this->request->getPost('status');


                    $keranjangModel = new KeranjangModel();
                    $keranjang = $keranjangModel->getKeranjangByUser(session('user_id'));

                    $kreditModel = new KreditModel();

                    if (!empty($keranjang)) {
                        $penjualanModel = new PenjualanModel();

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

                            $kreditModel->insertKredit($dataKredit);

                            $penjualanModel->insertPenjualan($dataPenjualan);

                            $keranjangModel->deleteKeranjangwhereUserId(session('user_id'));
                        }

                        session()->setFlashdata('success', 'Transaksi berhasil dilakukan.');
                        return redirect()->to(base_url('paylater/kontrak'));
                    } else {
                        session()->setFlashdata('error', 'Keranjang belanja kosong.');
                        return redirect()->to(base_url('paylater/kontrak'));
                    }
                } else {
                    session()->setFlashdata('error', 'Anda tidak bisa mengajukan pembelian secara kredit, harap centang formulir kebijakan kami!.');
                    return redirect()->to(base_url('paylater/pendaftaran_kontrak'));
                }
            }
        } else {
            session()->setFlashdata('error', 'Silahkan lakukan dulu pengajuan identitas anda, agar dapat melakukan pembelian secara kredit');
            return redirect()->to(base_url('identitas'));
        }
    }

    public function verifikasiPembelianPaylater()
    {
        $no_kontrak = $this->request->getPost('no_kontrak');

        if ($this->request->getMethod() === 'post') {

            $kreditModel = new KreditModel();

            $penjualanModel = new PenjualanModel();

            $dataPenjualan = [
                'status' => 'PayLater Success'
            ];

            $dataKredit = [
                'status' => 'Disetujui'
            ];

            $kreditModel->updateByNoKontrak($no_kontrak, $dataKredit);

            $penjualanModel->updateByNoKontrak($no_kontrak, $dataPenjualan);

            session()->setFlashdata('success', 'Data Transaksi dan Pembelian Kredit Berhasil Di Verifikasi.');
            return redirect()->to(base_url('paylater/kontrak'));
        }
    }
}
