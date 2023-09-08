<?php

namespace App\Controllers\Kredit_App\Produk;

use App\Controllers\Kredit_App\BaseController;

class Produk extends BaseController
{

    // View Produk Gallery
    public function index()
    {
        $produkFindAll = $this->produkModel->findAll();

        $data = [
            'title' => 'Produk',
            'user' => $this->user,
            'produkFindAll' => $produkFindAll,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label
        ];
        return view('kredit_app/pages/Produk/Produk', $data);
    }

    // View Management Produk
    public function management_produk()
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $produkFindAll = $this->produkModel->findAll();
        $kategoriProdukFindAll = $this->kategoriProdukModel->findAll();

        $data = [
            'title' => 'Management Produk',
            'user' => $this->user,
            'produkFindAll' => $produkFindAll,
            'kategoriProdukFindAll' => $kategoriProdukFindAll,
            'products' => $this->produkModel->getProdukWithKategori(),
            'perusahaan' => $this->aplikasi,
            'label' => $this->label
        ];
        return view('kredit_app/pages/Produk/ManagementProduk', $data);
    }

    public function kategori_produk()
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $produkFindAll = $this->produkModel->findAll();
        $kategoriProdukFindAll = $this->kategoriProdukModel->findAll();

        $data = [
            'title' => 'Kategori Produk',
            'user' => $this->user,
            'produkFindAll' => $produkFindAll,
            'kategoriProdukFindAll' => $kategoriProdukFindAll,
            'products' => $this->produkModel->getProdukWithKategori(),
            'perusahaan' => $this->aplikasi,
            'label' => $this->label
        ];
        return view('kredit_app/pages/Produk/Kategori', $data);
    }

    // Produk CRUD
    public function produk_post()
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        if ($this->request->getMethod() === 'post') {

            // Produk Insert
            if (isset($_POST['produk_insert'])) {
                $gambar = $this->request->getFile('gambar');

                if ($gambar->isValid() && !$gambar->hasMoved()) {

                    $namaUnik = $gambar->getRandomName();
                    $gambar->move(FCPATH . 'assets/image/produk', $namaUnik);
                }

                $data = [
                    'gambar' => $namaUnik,
                    'nama_produk' => $this->request->getPost('nama_produk'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'harga' => $this->request->getPost('harga'),
                    'stok' => $this->request->getPost('stok'),
                    'kategori_id' => $this->request->getPost('kategori_id')
                ];

                $this->produkModel->insertProduk($data);

                return redirect()->to(base_url('ka-produk/management_produk'))->with('success', 'Produk berhasil ditambahkan.');
            }

            // Produk Update
            if (isset($_POST['produk_update'])) {

                $produk_id = $this->request->getPost('produk_id');
                $product = $this->produkModel->find($produk_id);

                if (!$product) {
                    return redirect()->to(base_url('ka-produk/management_produk'))->with('error', 'Produk tidak ditemukan.');
                }

                $data = [
                    'nama_produk' => $this->request->getPost('nama_produk'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'harga' => $this->request->getPost('harga'),
                    'stok' => $this->request->getPost('stok'),
                    'kategori_id' => $this->request->getPost('kategori_id'),
                ];

                $gambar = $this->request->getFile('gambar');
                $gambarLama = $this->request->getPost('gambarLama');

                if ($gambar->isValid() && !$gambar->hasMoved()) {
                    $namaUnik = $gambar->getRandomName();
                    $gambar->move(FCPATH . 'assets/image/produk', $namaUnik);

                    if (!empty($gambarLama)) {
                        $gambarPath = FCPATH . 'assets/image/produk/' . $gambarLama;
                        if (file_exists($gambarPath)) {
                            unlink($gambarPath);
                        }
                    }

                    $data['gambar'] = $namaUnik;
                }

                $this->produkModel->updateProduk($produk_id, $data);

                return redirect()->to(base_url('ka-produk/management_produk'))->with('success', 'Produk berhasil diubah.');
            }

            // Produk Delete
            if (isset($_POST['produk_delete'])) {

                $produk_id = $this->request->getPost('produk_id');
                $product = $this->produkModel->find($produk_id);

                if (!$product) {
                    return redirect()->to(base_url('ka-produk/management_produk'))->with('error', 'Produk tidak ditemukan.');
                }

                $gambarPath = FCPATH . 'assets/image/produk/' . $product['gambar'];
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }

                $this->produkModel->deleteProduk($product['id']);
                return redirect()->to(base_url('ka-produk/management_produk'))->with('success', 'Produk berhasil dihapus.');
            }
        }
    }

    // Kategori Produk CRUD
    public function kategori_post()
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        if ($this->request->getMethod() === 'post') {

            // Insert Kategori Produk
            if (isset($_POST['kategori_insert'])) {

                $data = [
                    'nama_kategori' => $this->request->getPost('nama_kategori'),
                    'deskripsi' => $this->request->getPost('deskripsi')
                ];

                $this->kategoriProdukModel->insertKategori($data);

                return redirect()->to(base_url('ka-produk/kategori'))->with('success', 'Kategori produk berhasil ditambahkan.');
            }

            // Update Kategori Produk
            if (isset($_POST['kategori_update'])) {

                $kategori_id = $this->request->getPost('kategori_id');
                $nama_kategori = $this->request->getPost('nama_kategori');
                $deskripsi = $this->request->getPost('deskripsi');

                $data = [
                    'nama_kategori' => $nama_kategori,
                    'deskripsi' => $deskripsi
                ];

                $this->kategoriProdukModel->updateKategori($kategori_id, $data);

                return redirect()->to(base_url('ka-produk/kategori'))->with('success', 'Kategori produk berhasil diubah.');
            }

            // Delete Kategori Produk
            if (isset($_POST['kategori_delete'])) {

                $kategori_id = $this->request->getPost('kategori_id');
                $kategori = $this->kategoriProdukModel->find($kategori_id);

                if (!$kategori) {
                    return redirect()->to(base_url('produk/kategori'))->with('error', 'Kategori tidak ditemukan.');
                }

                try {
                    $this->kategoriProdukModel->deleteKategoriProduk($kategori_id);
                    return redirect()->to(base_url('ka-produk/kategori'))->with('success', 'Kategori produk berhasil dihapus.');
                } catch (\Exception $e) {
                    return redirect()->to(base_url('ka-produk/kategori'))->with('error', 'Tidak dapat menghapus karena ada produk dengan kategori ini.');
                }
            }
        }
    }
}
