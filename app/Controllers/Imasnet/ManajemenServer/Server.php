<?php

namespace App\Controllers\Imasnet\ManajemenServer;

use App\Models\Imasnet\ManajemenServer\ServerModel;
use App\Models\Imasnet\ManajemenServer\PengelolaModel;

use App\Controllers\Imasnet\BaseController;

class Server extends BaseController
{
    public function index()
    {
        $modelServer = new ServerModel();
        $pengelolaData = new PengelolaModel();

        $pengelolaMap = [];
        $pengelola = $pengelolaData->findAll();

        foreach ($pengelola as $pengelola) {
            $pengelolaMap[$pengelola['id']] = $pengelola;
        }

        $data = [
            'title' => 'Manajemen Server',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'serverData' => $modelServer->findAll(),
            'pengelolaData' => $pengelolaData->findAll(),
            'pengelolaMap' => $pengelolaMap,
        ];
        return view('Imasnet/Pages/ManajemenServer/Server', $data);
    }


    public function create()
    {
        $randomCode = rand(100000, 999999);
        // Ambil data dari formulir HTML
        $data = [
            'kode_server' => $randomCode,
            'nama_server' => $this->request->getPost('nama_server'),
            'alamat_server' => $this->request->getPost('alamat_server'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'pengelola_id' => $this->request->getPost('pengelola_id'),
            'created_at' => date('Y-m-d H:i:s'), // Tanggal dan waktu saat ini
            'updated_at' => date('Y-m-d H:i:s'), // Tanggal dan waktu saat ini
        ];

        // Simpan data ke dalam database
        $modelServer = new ServerModel();

        if ($modelServer->insert($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-server/server'))->with('success', 'Data server berhasil disimpan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data server');
        }
    }


    public function update()
    {
        // Ambil data dari form
        $id = $this->request->getPost('id');

        $modelServer = new ServerModel();

        $data = [
            'nama_server' => $this->request->getPost('nama_server'),
            'alamat_server' => $this->request->getPost('alamat_server'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'pengelola_id' => $this->request->getPost('pengelola_id'),
            'created_at' => date('Y-m-d H:i:s'), // Tanggal dan waktu saat ini
            'updated_at' => date('Y-m-d H:i:s'), // Tanggal dan waktu saat ini
        ];
        if (!$modelServer->updateId($id, $data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-server/server'))->with('success', 'Data server berhasil diubah');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data server');
        }
    }

    public function delete($id)
    {
        $modelServer = new ServerModel();

        // Hapus data transaksi berdasarkan ID
        if ($modelServer->deleteId($id)) {
            // Jika penghapusan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-manajemen-server/server'))->with('success', 'server berhasil dihapus.');
        } else {
            // Jika penghapusan gagal, arahkan kembali ke halaman daftar transaksi dengan pesan error
            return redirect()->to(base_url('im-manajemen-server/server'))->with('error', 'server gagal dihapus. Silakan coba lagi.');
        }
    }
}
