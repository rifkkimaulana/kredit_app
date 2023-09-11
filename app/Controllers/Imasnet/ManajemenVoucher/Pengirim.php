<?php

namespace App\Controllers\Imasnet\ManajemenVoucher;

use App\Models\Imasnet\ManajemenVoucher\PengirimModel;

use App\Controllers\Imasnet\BaseController;

class Pengirim extends BaseController
{
    public function index()
    {
        $pengirimModel = new PengirimModel();

        $data = [
            'title' => 'Reseller Voucher',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'pengirimData' => $pengirimModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenVoucher/Pengirim', $data);
    }

    public function create()
    {
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'alamat' => $this->request->getPost('alamat'),
            'telpon' => $this->request->getPost('telpon'),
            'status' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $pengirimModel = new PengirimModel();

        if ($pengirimModel->insert($data)) {
            return redirect()->to(base_url('im-manajemen-voucher/pengirim'))->with('success', 'Data pengirim berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data pengirim');
        }
    }


    public function update()
    {
        $id = $this->request->getPost('id');

        $pengirimModel = new PengirimModel();

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'alamat' => $this->request->getPost('alamat'),
            'telpon' => $this->request->getPost('telpon'),
            'status' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (!$pengirimModel->updateId($id, $data)) {
            return redirect()->to(base_url('im-manajemen-voucher/pengirim'))->with('success', 'Data pengirim berhasil diubah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data pengirim');
        }
    }

    public function delete($id)
    {
        $pengirimModel = new PengirimModel();

        if ($pengirimModel->deleteId($id)) {
            return redirect()->to(base_url('im-manajemen-voucher/pengirim'))->with('success', 'pengirim berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-manajemen-voucher/pengirim'))->with('error', 'pengirim gagal dihapus. Silakan coba lagi.');
        }
    }
}
