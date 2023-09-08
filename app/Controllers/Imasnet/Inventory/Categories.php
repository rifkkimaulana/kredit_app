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
}
