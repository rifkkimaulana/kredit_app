<?php

namespace App\Controllers\Imasnet\ManajemenAssets;

use App\Models\Imasnet\ManajemenAssets\KategoriAssetsModel;

use App\Controllers\Imasnet\BaseController;

class KategoriAssets extends BaseController
{
    public function index()
    {
        $kategoriAssetsModel = new KategoriAssetsModel();

        $data = [
            'title' => 'Manajemen Server',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'kategoriAssetsData' => $kategoriAssetsModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenAssets/KategoriAssets', $data);
    }


    public function create()
    {
        // Ambil data dari formulir HTML
        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        // Simpan data ke dalam database
        $kategoriAssetsModel = new KategoriAssetsModel();

        if ($kategoriAssetsModel->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-assets/kategori-aset'))->with('success', 'Data aset berhasil disimpan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data aset');
        }
    }

    public function update()
    {
        // Ambil data dari form
        $id = $this->request->getPost('id');

        $data = [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        $kategoriAssetsModel = new KategoriAssetsModel();

        if (!$kategoriAssetsModel->updateId($id, $data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-assets/kategori-aset'))->with('success', 'Data aset berhasil diubah');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data aset');
        }
    }

    public function delete($id)
    {
        $kategoriAssetsModel = new KategoriAssetsModel();

        // Hapus data transaksi berdasarkan ID
        if ($kategoriAssetsModel->deleteId($id)) {
            // Jika penghapusan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-manajemen-assets/kategori-aset'))->with('success', 'aset berhasil dihapus.');
        } else {
            // Jika penghapusan gagal, arahkan kembali ke halaman daftar transaksi dengan pesan error
            return redirect()->to(base_url('im-manajemen-assets/kategori-aset'))->with('error', 'aset gagal dihapus. Silakan coba lagi.');
        }
    }
}
