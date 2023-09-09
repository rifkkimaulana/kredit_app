<?php

namespace App\Controllers\Imasnet\Inventory;

use App\Models\Imasnet\Inventory\CategoriesModel;

use App\Controllers\Imasnet\BaseController;

class Categories extends BaseController
{
    public function index()
    {
        $categoriesModel = new CategoriesModel();

        $data = [
            'title' => 'Manajemen Kategori',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'categories' => $categoriesModel->findAll()
        ];
        return view('Imasnet/Pages/Inventory/Categories', $data);
    }

    public function create()
    {
        // Ambil data dari form
        $nama_kategori = $this->request->getPost('nama_kategori');
        $keterangan = $this->request->getPost('keterangan');

        // Simpan data ke dalam database
        $model = new CategoriesModel();
        $data = [
            'nama_kategori' => $nama_kategori,
            'keterangan' => $keterangan,
        ];

        if ($model->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/categories'))->with('success', 'Kategori berhasil ditambahkan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan kategori');
        }
    }

    public function update()
    {
        // Ambil data dari form
        $id = $this->request->getPost('id');
        $nama_kategori = $this->request->getPost('nama_kategori');
        $keterangan = $this->request->getPost('keterangan');

        // Simpan data ke dalam database
        $model = new CategoriesModel();

        $data = [
            'nama_kategori' => $nama_kategori,
            'keterangan' => $keterangan,
        ];

        if (!$model->updateId($id, $data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/categories'))->with('success', 'Kategori berhasil Diubah');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengubah kategori');
        }
    }

    public function delete($id)
    {
        $model = new CategoriesModel();

        // Hapus data kategori berdasarkan ID
        if ($model->deleteId($id)) {
            // Jika penghapusan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-inventory/categories'))->with('success', 'Kategori berhasil dihapus.');
        } else {
            // Jika penghapusan gagal, arahkan kembali ke halaman daftar kategori dengan pesan error
            return redirect()->to(base_url('im-inventory/categories'))->with('error', 'Kategori gagal dihapus. Silakan coba lagi.');
        }
    }
}
