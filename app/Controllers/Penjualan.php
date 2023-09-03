<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PenjualanModel;
use App\Models\KeranjangModel;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class Penjualan extends Controller
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

        $produkModel = new ProdukModel();
        $userList = $userModel->findAll();
        $penjualanModel = new PenjualanModel();

        $produkList = $produkModel->getProdukWithKategori();

        $userMap = [];
        foreach ($userList as $users) {
            $userMap[$users['user_id']] = $users;
        }

        $produkMap = [];
        foreach ($produkList as $produk) {
            $produkMap[$produk['id']] = $produk;
        }

        $data = [
            'title' => 'Manajemen Produk',
            'products' => $produkList,
            'penjualanList' => $penjualanModel->findAll(),
            'userList' => $userList,
            'user' => $user,
            'userMap' => $userMap,
            'produkMap' => $produkMap
        ];

        return view('admin/pages/Penjualan', $data);
    }

    public function hapusPenjualan($id)
    {
        $penjualanModel = new PenjualanModel();
        $penjualanViewId = $penjualanModel->find($id);

        if (!$penjualanViewId) {
            return redirect()->to(base_url('penjualan'))->with('error', 'Penjualan ini tidak ditemukan di database.');
        }

        $penjualanModel->deletePenjualan($id);

        return redirect()->to(base_url('penjualan'))->with('success', 'Penjualan berhasil dihapus.');
    }

    public function keranjang()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }

        if (
            session('user_level') !== 'administrator'
            && session('user_level') !== 'manager'
        ) {
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
            'title' => 'Keranjang Belanja',
            'userList' => $userModel->findAll(),
            'keranjang' => $keranjangItems,
            'user' => $user,
            'produk' => $produk,
            'products' => $produkModel->findAll()
        ];

        return view('admin/pages/Keranjang', $data,);
    }

    public function keranjang_addPost()
    {
        $keranjangModel = new KeranjangModel();
        $produkModel = new ProdukModel();
        $products = $produkModel->findAll();

        $produkMap = [];
        foreach ($products as $product) {
            $produkMap[$product['id']] = $product;
        }

        $selectedProduk = $this->request->getPost('selectedProduk');
        $jumlahBeli = $this->request->getPost('jumlahbeli');

        $session = session();
        if (empty($selectedProduk)) {
            $session->setFlashdata('error', 'Pilih setidaknya satu produk.');
            return redirect()->to(base_url('keranjang'));
        }

        foreach ($selectedProduk as $idProduk) {
            $idProduk = intval($idProduk);
            if (isset($jumlahBeli[$idProduk]) && $jumlahBeli[$idProduk] > 0) {
                $data = [
                    'user_id' => session('user_id'),
                    'produk_id' => $idProduk,
                    'harga_satuan' => $produkMap[$idProduk]['harga'],
                    'jumlah' => intval($jumlahBeli[$idProduk])
                ];

                // Check if the same product_id is already in the keranjang
                if (!$keranjangModel->isProductInKeranjang($data['produk_id'], session('user_id'))) {
                    $keranjangModel->addToKeranjang($data);
                } else {
                    $session->setFlashdata('error', 'Produk sudah ada dalam keranjang.');
                    return redirect()->to(base_url('keranjang'));
                }
            } else {
                $session->setFlashdata('error', 'Jumlah beli produk tidak valid.');
                return redirect()->to(base_url('keranjang'));
            }
        }

        // Set success flash message
        $session->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
        return redirect()->to(base_url('keranjang'));
    }


    public function cekout()
    {
        if ($this->request->getMethod() === 'post') {
            $metode_pembayaran = $this->request->getPost('metode_pembayaran');
            $status = $this->request->getPost('status');
            $id_userpelanggan = $this->request->getPost('user_id');

            $keranjangModel = new KeranjangModel();
            $keranjang = $keranjangModel->getKeranjangByUser(session('user_id'));

            if (!empty($keranjang)) {
                $penjualanModel = new PenjualanModel();

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

                    $penjualanModel->insert($data);
                    $keranjangModel->deleteKeranjangwhereUserId(session('user_id'));
                }

                // Tampilkan pesan sukses atau selesaikan transaksi
                session()->setFlashdata('success', 'Transaksi berhasil dilakukan.');
                return redirect()->to(base_url('penjualan'));
            } else {
                session()->setFlashdata('error', 'Keranjang belanja kosong.');
                return redirect()->to(base_url('penjualan'));
            }
        }
    }

    public function verifikasi()
    {
        if ($this->request->getMethod() === 'post') {
            $PenjualanModel = new PenjualanModel();
            $produkModel = new ProdukModel();

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

            $PenjualanModel->updatePenjualan($penjualan_id, $dataPenjualan);
            $produkModel->updateProduk($produk_id, $dataProduk);

            session()->setFlashdata('success', 'Transaksi ini berhasil diverifikasi.');
            return redirect()->to(base_url('penjualan'));
        }
    }

    public function hapusProdukKeranjang($id)
    {
        $keranjangModel = new KeranjangModel();
        $keranjang = $keranjangModel->find($id);

        if (!$keranjang) {
            return redirect()->to(base_url('keranjang'))->with('error', 'Data Keranjang tidak ditemukan.');
        }

        // Delete produk dari database
        $keranjangModel->removeFromKeranjang($id);

        return redirect()->to(base_url('keranjang'))->with('success', 'Produk di keranjang berhasil dihapus.');
    }
}
