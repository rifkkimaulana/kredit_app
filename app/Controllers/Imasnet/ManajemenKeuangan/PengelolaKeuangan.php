<?php

namespace App\Controllers\Imasnet\ManajemenKeuangan;

use App\Models\Imasnet\ManajemenKeuangan\PengelolaKeuanganModel;

use App\Controllers\Imasnet\BaseController;

class PengelolaKeuangan extends BaseController
{
    public function index()
    {
        $pengelolaKeuanganModel = new PengelolaKeuanganModel();

        $data = [
            'title' => 'Pengelola Keuangan',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'pengelolaKeuanganData' => $pengelolaKeuanganModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenKeuangan/PengelolaKeuangan', $data);
    }


    public function create()
    {
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'telpon' => $this->request->getPost('telpon'),
            'alamat' => $this->request->getPost('alamat'),
            'saldo' => $this->request->getPost('saldo')
        ];

        $pengelolaKeuanganModel = new PengelolaKeuanganModel();

        if ($pengelolaKeuanganModel->insertData($data)) {
            return redirect()->to(base_url('im-manajemen-keuangan/pengelola-keuangan'))->with('success', 'Data pengelola keuangan berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data pengelola keuangan');
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'telpon' => $this->request->getPost('telpon'),
            'alamat' => $this->request->getPost('alamat'),
            'saldo' => $this->request->getPost('saldo')
        ];

        $pengelolaKeuanganModel = new PengelolaKeuanganModel();

        if (!$pengelolaKeuanganModel->updateId($id, $data)) {
            return redirect()->to(base_url('im-manajemen-keuangan/pengelola-keuangan'))->with('success', 'Data pengelola keuangan berhasil diubah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data pengelola keuangan');
        }
    }

    public function delete($id)
    {
        $pengelolaKeuanganModel = new PengelolaKeuanganModel();

        if ($pengelolaKeuanganModel->deleteId($id)) {
            return redirect()->to(base_url('im-manajemen-keuangan/pengelola-keuangan'))->with('success', 'pengelola keuangan berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-manajemen-keuangan/pengelola-keuangan'))->with('error', 'pengeloa keuangan gagal dihapus. Silakan coba lagi.');
        }
    }
}
