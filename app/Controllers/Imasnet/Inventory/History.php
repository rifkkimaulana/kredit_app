<?php

namespace App\Controllers\Imasnet\Inventory;

use App\Models\Imasnet\Inventory\HistoryModel;

use App\Controllers\Imasnet\BaseController;

class History extends BaseController
{
    public function index()
    {
        $historyModel = new HistoryModel();
        $data = [
            'title' => 'Riwayat Transaksi',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'history' => $historyModel->findAll()
        ];
        return view('Imasnet/Pages/Inventory/History', $data);
    }

    public function create()
    {
        // Ambil data dari form
        $keterangan = $this->request->getPost('keterangan');
        $jenis = $this->request->getPost('jenis');

        // Simpan data ke dalam database
        $model = new HistoryModel();
        $data = [
            'keterangan' => $keterangan,
            'jenis' => $jenis,
        ];

        if ($model->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/history'))->with('success', 'Data history berhasil disimpan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data history');
        }
    }

    public function update()
    {
        // Ambil data dari form
        $id = $this->request->getPost('id');
        $keterangan = $this->request->getPost('keterangan');
        $jenis = $this->request->getPost('jenis');

        // Simpan data ke dalam database
        $model = new HistoryModel();
        $data = [
            'keterangan' => $keterangan,
            'jenis' => $jenis,
        ];

        if (!$model->updateId($id, $data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/history'))->with('success', 'Data history berhasil diubah');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data history');
        }
    }

    public function delete($id)
    {
        $model = new HistoryModel();
        // Hapus data kategori berdasarkan ID
        if ($model->deleteId($id)) {
            // Jika penghapusan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-inventory/history'))->with('success', 'Kategori berhasil dihapus.');
        } else {
            // Jika penghapusan gagal, arahkan kembali ke halaman daftar kategori dengan pesan error
            return redirect()->to(base_url('im-inventory/history'))->with('error', 'Kategori gagal dihapus. Silakan coba lagi.');
        }
    }
}
