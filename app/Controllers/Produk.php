<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriProdukModel;
use App\Models\UsersModel;
use CodeIgniter\Controller;

class Produk extends Controller
{
    public function index()
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

        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriProdukModel();


        $data = [
            'title' => 'Manajemen Produk',
            'products' => $produkModel->getProdukWithKategori(),
            'kategoriProduk' => $kategoriModel->findAll(),
            'user' => $user
        ];

        return view('admin/pages/Produk', $data);
    }

    public function produk_postInsert()
    {
        if ($this->request->getMethod() === 'post') {
            $produkModel = new ProdukModel();

            $namaProduk = $this->request->getPost('nama_produk');
            $deskripsi = $this->request->getPost('deskripsi');
            $harga = $this->request->getPost('harga');
            $stok = $this->request->getPost('stok');
            $kategori_id = $this->request->getPost('kategori_id');

            // Upload gambar
            $gambar = $this->request->getFile('gambar');

            if ($gambar->isValid() && !$gambar->hasMoved()) {
                $namaUnik = $gambar->getRandomName();
                $gambar->move(FCPATH . 'assets/image/produk', $namaUnik);
            }

            $data = [
                'gambar' => $namaUnik,
                'nama_produk' => $namaProduk,
                'deskripsi' => $deskripsi,
                'harga' => $harga,
                'stok' => $stok,
                'kategori_id' => $kategori_id
            ];

            $produkModel->insertProduk($data);

            return redirect()->to(base_url('pengaturan/produk'))->with('success', 'Produk berhasil ditambahkan.');
        }
    }

    public function produk_postUpdate()
    {
        $produkModel = new ProdukModel();

        $id = $this->request->getPost('produk_id');

        if ($this->request->getMethod() === 'post') {
            $product = $produkModel->find($id);

            if (!$product) {
                return redirect()->to(base_url('produk'))->with('error', 'Produk tidak ditemukan.');
            }

            $namaProduk = $this->request->getPost('nama_produk');
            $deskripsi = $this->request->getPost('deskripsi');
            $harga = $this->request->getPost('harga');
            $stok = $this->request->getPost('stok');
            $kategori_id = $this->request->getPost('kategori_id');

            $data = [
                'nama_produk' => $namaProduk,
                'deskripsi' => $deskripsi,
                'harga' => $harga,
                'stok' => $stok,
                'kategori_id' => $kategori_id,
            ];

            // Update gambar jika ada yang diunggah
            $gambar = $this->request->getFile('gambar');
            $gambarLama = $this->request->getPost('gambarLama');
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                $namaUnik = $gambar->getRandomName();
                $gambar->move(FCPATH . 'assets/image/produk', $namaUnik);

                if (!empty($gambarLama)) {
                    $gambarPath = FCPATH . 'assets/image/produk/' . $gambarLama;
                    if (file_exists($gambarPath)) {
                        unlink($gambarPath); // Hapus logo lama dari direktori
                    }
                }

                $data['gambar'] = $namaUnik;
            }

            $produkModel->updateProduk($id, $data);

            return redirect()->to(base_url('pengaturan/produk'))->with('success', 'Produk berhasil diperbarui.');
        }
    }

    public function deleteProduk($id)
    {
        $produkModel = new ProdukModel();
        $product = $produkModel->find($id);

        if (!$product) {
            return redirect()->to(base_url('produk'))->with('error', 'Produk tidak ditemukan.');
        }

        $gambarPath = FCPATH . 'assets/image/produk/' . $product['gambar'];
        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }


        // Delete produk dari database
        $produkModel->deleteProduk($id);

        return redirect()->to(base_url('produk'))->with('success', 'Produk berhasil dihapus.');
    }

    public function kategori()
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

        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriProdukModel();


        $data = [
            'title' => 'Kategori Produk',
            'products' => $produkModel->findAll(),
            'kategoriProduk' => $kategoriModel->findAll(),
            'user' => $user
        ];

        return view('admin/pages/KategoriProduk', $data);
    }

    public function kategori_postInsert()
    {
        if ($this->request->getMethod() === 'post') {
            $kategoriModel = new KategoriProdukModel();

            $nama_kategori = $this->request->getPost('nama_kategori');
            $deskripsi = $this->request->getPost('deskripsi');

            $kategoriData = [
                'nama_kategori' => $nama_kategori,
                'deskripsi' => $deskripsi
            ];

            $kategoriModel->insertKategori($kategoriData);

            return redirect()->to(base_url('produk/kategori'))->with('success', 'Kategori produk berhasil ditambahkan.');
        }
    }

    public function kategori_postUpdate()
    {
        if ($this->request->getMethod() === 'post') {
            $kategoriModel = new KategoriProdukModel();

            $id = $this->request->getPost('id');
            $nama_kategori = $this->request->getPost('nama_kategori');
            $deskripsi = $this->request->getPost('deskripsi');

            $kategoriData = [
                'nama_kategori' => $nama_kategori,
                'deskripsi' => $deskripsi
            ];

            $kategoriModel->updateKategori($id, $kategoriData);

            return redirect()->to(base_url('produk/kategori'))->with('success', 'Kategori produk berhasil ditambahkan.');
        }
    }

    public function deleteKategori($id)
    {
        $kategoriModel = new KategoriProdukModel();
        $kategori = $kategoriModel->find($id);

        if (!$kategori) {
            return redirect()->to(base_url('produk/kategori'))->with('error', 'Kategori tidak ditemukan.');
        }

        try {
            $kategoriModel->deleteKategoriProduk($id);

            return redirect()->to(base_url('produk/kategori'))->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->to(base_url('produk/kategori'))->with('error', 'Terjadi masalah saat menghapus kategori: ' . $e->getMessage());
        }
    }
}
