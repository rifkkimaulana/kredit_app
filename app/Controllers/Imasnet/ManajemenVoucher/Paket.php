<?php

namespace App\Controllers\Imasnet\ManajemenVoucher;

use App\Models\Imasnet\ManajemenVoucher\PaketModel;

use App\Controllers\Imasnet\BaseController;

class Paket extends BaseController
{
    public function index()
    {
        $paketModel = new PaketModel();

        $data = [
            'title' => 'Paket Voucher',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'paketData' => $paketModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenVoucher/Paket', $data);
    }

    public function create()
    {
        $data = [
            'nama_paket' => $this->request->getPost('nama_paket'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $paketModel = new PaketModel();

        if ($paketModel->insert($data)) {
            return redirect()->to(base_url('im-manajemen-voucher/paket'))->with('success', 'Data paket berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data paket');
        }
    }


    public function update()
    {
        $id = $this->request->getPost('id');

        $paketModel = new PaketModel();

        $data = [
            'nama_paket' => $this->request->getPost('nama_paket'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (!$paketModel->updateId($id, $data)) {
            return redirect()->to(base_url('im-manajemen-voucher/paket'))->with('success', 'Data paket berhasil diubah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data paket');
        }
    }

    public function delete($id)
    {
        $paketModel = new PaketModel();

        if ($paketModel->deleteId($id)) {
            return redirect()->to(base_url('im-manajemen-voucher/paket'))->with('success', 'Paket berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-manajemen-voucher/paket'))->with('error', 'Paket gagal dihapus. Silakan coba lagi.');
        }
    }
}
