<?php

namespace App\Controllers\Imasnet\ManajemenKeuangan;

use App\Models\Imasnet\ManajemenKeuangan\KategoriKeuanganModel;

use App\Controllers\Imasnet\BaseController;

class KategoriKeuangan extends BaseController
{
    public function index()
    {
        $kategoriKeuanganModel = new KategoriKeuanganModel();

        $data = [
            'title' => 'Manajemen Server',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'kategoriKeuanganData' => $kategoriKeuanganModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenKeuangan/KategoriKeuangan', $data);
    }

    public function create()
    {
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $kategoriKeuanganModel = new KategoriKeuanganModel();

        if ($kategoriKeuanganModel->insertData($data)) {
            return redirect()->to(base_url('im-manajemen-keuangan/kategori-keuangan'))->with('success', 'Data kategori keuangan berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data kategori keuangan');
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        $kategoriKeuanganModel = new KategoriKeuanganModel();

        if (!$kategoriKeuanganModel->updateId($id, $data)) {
            return redirect()->to(base_url('im-manajemen-keuangan/kategori-keuangan'))->with('success', 'Data kategori keuangan berhasil diubah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data kategori keuangan');
        }
    }

    public function delete($id)
    {
        $kategoriKeuanganModel = new KategoriKeuanganModel();

        if ($kategoriKeuanganModel->deleteId($id)) {
            return redirect()->to(base_url('im-manajemen-keuangan/kategori-keuangan'))->with('success', 'Kategori keuangan berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-manajemen-keuangan/kategori-keuangan'))->with('error', 'Kategori keuangan gagal dihapus. Silakan coba lagi.');
        }
    }
}
