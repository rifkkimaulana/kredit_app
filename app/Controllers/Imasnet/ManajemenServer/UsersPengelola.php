<?php

namespace App\Controllers\Imasnet\ManajemenServer;

use App\Models\Imasnet\ManajemenServer\PengelolaModel;

use App\Controllers\Imasnet\BaseController;

class UsersPengelola extends BaseController
{
    public function index()
    {
        $pengelolaData = new PengelolaModel();

        $data = [
            'title' => 'User Pengelola Manajemen Server',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'pengelolaData' => $pengelolaData->findAll(),
        ];

        return view('Imasnet/Pages/ManajemenServer/Pengelola', $data);
    }

    public function create()
    {
        // Ambil data dari formulir HTML
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'telpon' => $this->request->getPost('telpon'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        // Simpan data ke dalam database
        $pengelolaData = new PengelolaModel();

        if ($pengelolaData->insert($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-server/users-pengelola'))->with('success', 'Data Users Pengelola berhasil disimpan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data Users Pengelola');
        }
    }


    public function update()
    {
        // Ambil data dari form
        $id = $this->request->getPost('id');

        $pengelolaData = new PengelolaModel();

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'telpon' => $this->request->getPost('telpon'),
            'alamat' => $this->request->getPost('alamat'),
        ];

        if (!$pengelolaData->updateId($id, $data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-server/users-pengelola'))->with('success', 'Data Users Pengelola berhasil diubah');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data Users Pengelola');
        }
    }

    public function delete($id)
    {
        $pengelolaData = new PengelolaModel();

        // Hapus data transaksi berdasarkan ID
        if ($pengelolaData->deleteId($id)) {
            // Jika penghapusan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-manajemen-server/users-pengelola'))->with('success', 'Users Pengelola berhasil dihapus.');
        } else {
            // Jika penghapusan gagal, arahkan kembali ke halaman daftar transaksi dengan pesan error
            return redirect()->to(base_url('im-manajemen-server/users-pengelola'))->with('error', 'Users Pengelola gagal dihapus. Silakan coba lagi.');
        }
    }
}
