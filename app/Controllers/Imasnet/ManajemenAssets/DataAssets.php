<?php

namespace App\Controllers\Imasnet\ManajemenAssets;

use App\Models\Imasnet\ManajemenAssets\AssetsModel;
use App\Models\Imasnet\ManajemenAssets\KategoriAssetsModel;

use App\Controllers\Imasnet\BaseController;

class DataAssets extends BaseController
{
    public function index()
    {
        $assetsModel = new AssetsModel();
        $kategoriAssetsModel = new KategoriAssetsModel();

        $data = [
            'title' => 'Manajemen Server',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'assetsData' => $assetsModel->findAll(),
            'kategoriAssetsData' => $kategoriAssetsModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenAssets/DataAssets', $data);
    }


    public function create()
    {
        $data = [
            'kategori_id' => $this->request->getPost('kategori_id'),
            'nama_assets' => $this->request->getPost('nama_assets'),
            'keterangan' => $this->request->getPost('keterangan'),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'harga_satuan' => $this->request->getPost('harga_satuan'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'created_at' => date('Y-m-d H:i:s'), // Contoh pengisian otomatis waktu pembuatan
            'updated_at' => date('Y-m-d H:i:s') // Contoh pengisian otomatis waktu pembaruan
        ];

        // Simpan data ke dalam database
        $assetsModel = new AssetsModel();

        if ($assetsModel->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-assets/data-aset'))->with('success', 'Data pelanggan berhasil disimpan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data pelanggan');
        }
    }

    public function update()
    {
        // Ambil data dari form
        $id = $this->request->getPost('id');

        $data = [
            'kategori_id' => $this->request->getPost('kategori_id'),
            'nama_assets' => $this->request->getPost('nama_assets'),
            'keterangan' => $this->request->getPost('keterangan'),
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'harga_satuan' => $this->request->getPost('harga_satuan'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'created_at' => date('Y-m-d H:i:s'), // Contoh pengisian otomatis waktu pembuatan
            'updated_at' => date('Y-m-d H:i:s') // Contoh pengisian otomatis waktu pembaruan
        ];

        $assetsModel = new AssetsModel();

        if (!$assetsModel->updateId($id, $data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-assets/data-aset'))->with('success', 'Data pelanggan berhasil diubah');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data pelanggan');
        }
    }

    public function delete($id)
    {
        $assetsModel = new AssetsModel();

        // Hapus data transaksi berdasarkan ID
        if ($assetsModel->deleteId($id)) {
            // Jika penghapusan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-manajemen-assets/data-aset'))->with('success', 'serpelangganver berhasil dihapus.');
        } else {
            // Jika penghapusan gagal, arahkan kembali ke halaman daftar transaksi dengan pesan error
            return redirect()->to(base_url('im-manajemen-assets/data-aset'))->with('error', 'pelanggan gagal dihapus. Silakan coba lagi.');
        }
    }
}
