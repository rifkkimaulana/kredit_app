<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriProdukModel;
use App\Models\UsersModel;
use App\Models\KeranjangModel;
use CodeIgniter\Controller;

class Produk extends Controller
{


    public function daftarProduk()
    {
        $produkModel = new ProdukModel();
        $userModel = new UsersModel();

        $data =
            [
                'title' => 'Daftar Produk Merchan',
                'produkList' => $produkModel->findAll(),
                'user' => $userModel->find(session('user_id'))
            ];

        return view('admin/pages/DaftarProduk', $data);
    }

    public function sentProdukForKeranjangKredit()
    {
        if ($this->request->getMethod() === 'post') {
            if (isset($_POST['add_keranjang'])) {

                $keranjangModel = new KeranjangModel();
                $produkModel = new ProdukModel();
                $products = $produkModel->findAll();

                $produkMap = [];
                foreach ($products as $product) {
                    $produkMap[$product['id']] = $product;
                }

                $idProduk = $this->request->getPost('selectedProduk');
                $jumlahBeli = $this->request->getPost('jumlahbeli');

                if ($produkMap[$idProduk]['stok'] > 0) {

                    $data = [
                        'user_id' => session('user_id'),
                        'produk_id' => $idProduk,
                        'harga_satuan' => $produkMap[$idProduk]['harga'],
                        'jumlah' => $jumlahBeli
                    ];

                    if (!$keranjangModel->isProductInKeranjang($data['produk_id'], session('user_id'))) {
                        $keranjangModel->addToKeranjang($data);
                    } else {
                        session()->setFlashdata('error', 'Produk sudah ada dalam keranjang.');
                        return redirect()->to(base_url('produk/daftar'));
                    }
                } else {
                    session()->setFlashdata('error', 'Stok Produk Tidak Tersedia.');
                    return redirect()->to(base_url('produk/daftar'));
                }

                session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
                return redirect()->to(base_url('produk/daftar'));
            }

            // Add Produk For Keranjang kredit
            if (isset($_POST['add_kredit'])) {
                $keranjangModel = new KeranjangModel();
                $produkModel = new ProdukModel();
                $products = $produkModel->findAll();

                $produkMap = [];
                foreach ($products as $product) {
                    $produkMap[$product['id']] = $product;
                }

                $idProduk = $this->request->getPost('selectedProduk');
                $jumlahBeli = $this->request->getPost('jumlahbeli');

                if ($produkMap[$idProduk]['stok'] > 0) {

                    $data = [
                        'user_id' => session('user_id'),
                        'produk_id' => $idProduk,
                        'harga_satuan' => $produkMap[$idProduk]['harga'],
                        'jumlah' => $jumlahBeli
                    ];

                    if (!$keranjangModel->isProductInKeranjang($data['produk_id'], session('user_id'))) {
                        $keranjangModel->addToKeranjang($data);
                    } else {
                        session()->setFlashdata('error', 'Produk sudah ada dalam keranjang Paylater.');
                        return redirect()->to(base_url('produk/daftar'));
                    }
                } else {
                    session()->setFlashdata('error', 'Stok Produk Tidak Tersedia.');
                    return redirect()->to(base_url('produk/daftar'));
                }

                session()->setFlashdata('success', 'Produk berhasil ditambahkan ke keranjang.');
                return redirect()->to(base_url('paylater/pendaftaran_kontrak'));
            }
        }
    }
}
