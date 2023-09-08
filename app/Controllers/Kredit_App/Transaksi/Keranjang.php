<?php

namespace App\Controllers\Kredit_App\Transaksi;

use App\Controllers\Kredit_App\BaseController;

class Keranjang extends BaseController
{
    public function index()
    {
        $keranjangItems = $this->keranjangModel->getKeranjangByUser(session('user_id'));
        $produkIds = array_column($keranjangItems, 'produk_id');

        $produk = [];
        foreach ($produkIds as $productId) {
            $product = $this->produkModel->find($productId);
            if ($product) {
                $produk[$productId] = $product;
            }
        }

        $userFindAll = $this->userModel->findAll();
        $produkFindAll = $this->produkModel->findAll();

        $data = [
            'title' => 'Cekout Pembelian Keranjang',
            'keranjang' => $keranjangItems,
            'produk' => $produk,
            'user' => $this->user,
            'userList' => $userFindAll,
            'products' => $produkFindAll,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label
        ];
        return view('kredit_app/pages/Transaksi/Keranjang', $data);
    }

    public function keranjang_insert()
    {
        $produkFindAll = $this->produkModel->findAll();

        $produkMap = [];
        foreach ($produkFindAll as $product) {
            $produkMap[$product['id']] = $product;
        }

        $selectedProduk = $this->request->getPost('selectedProduk');
        $jumlahBeli = $this->request->getPost('jumlahbeli');

        $session = session();
        if (empty($selectedProduk)) {
            $session->setFlashdata('error', 'Pilih setidaknya satu produk.');
            return redirect()->to(base_url('ka-transaksi/keranjang'));
        }

        foreach ($selectedProduk as $idProduk) {
            $idProduk = intval($idProduk);
            if ($produkMap[$idProduk]['stok'] > 0) {
                if (isset($jumlahBeli[$idProduk]) && $jumlahBeli[$idProduk] > 0) {
                    $data = [
                        'user_id' => session('user_id'),
                        'produk_id' => $idProduk,
                        'harga_satuan' => $produkMap[$idProduk]['harga'],
                        'jumlah' => intval($jumlahBeli[$idProduk])
                    ];

                    if (!$this->keranjangModel->isProductInKeranjang($data['produk_id'], session('user_id'))) {
                        $this->keranjangModel->addToKeranjang($data);
                    } else {
                        $session->setFlashdata('error', 'Produk sudah ada dalam keranjang.');
                        return redirect()->to(base_url('ka-transaksi/keranjang'));
                    }
                } else {
                    $session->setFlashdata('error', 'Jumlah beli produk tidak valid.');
                    return redirect()->to(base_url('ka-transaksi/keranjang'));
                }
            } else {
                $session->setFlashdata('error', 'Stok Produk Tidak Tersedia.');
                return redirect()->to(base_url('ka-transaksi/keranjang'));
            }
        }

        $session->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
        return redirect()->to(base_url('ka-transaksi/keranjang'));
    }

    public function keranjang_delete($id)
    {
        $keranjang = $this->keranjangModel->find($id);

        if (!$keranjang) {
            return redirect()->to(base_url('ka-transaksi/keranjang'))->with('error', 'Data Keranjang tidak ditemukan.');
        }

        $this->keranjangModel->removeFromKeranjang($id);

        return redirect()->to(base_url('ka-transaksi/keranjang'))->with('success', 'Produk di keranjang berhasil dihapus.');
    }
}
