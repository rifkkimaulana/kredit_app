<?php

namespace App\Controllers\Imasnet\ManajemenVoucher;

use App\Models\Imasnet\ManajemenVoucher\ResellerModel;

use App\Controllers\Imasnet\BaseController;

class Reseller extends BaseController
{
    public function index()
    {
        $resellerModel = new ResellerModel();

        $data = [
            'title' => 'Reseller Voucher',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'resellerData' => $resellerModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenVoucher/Reseller', $data);
    }

    public function create()
    {
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'alamat' => $this->request->getPost('alamat'),
            'telpon' => $this->request->getPost('telpon'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'status' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $resellerModel = new ResellerModel();

        if ($resellerModel->insert($data)) {
            return redirect()->to(base_url('im-manajemen-voucher/reseller'))->with('success', 'Data reseller berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data reseller');
        }
    }


    public function update()
    {
        $id = $this->request->getPost('id');

        $resellerModel = new ResellerModel();

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'alamat' => $this->request->getPost('alamat'),
            'telpon' => $this->request->getPost('telpon'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'status' => $this->request->getPost('status'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (!$resellerModel->updateId($id, $data)) {
            return redirect()->to(base_url('im-manajemen-voucher/reseller'))->with('success', 'Data reseller berhasil diubah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data reseller');
        }
    }

    public function delete($id)
    {
        $resellerModel = new ResellerModel();

        if ($resellerModel->deleteId($id)) {
            return redirect()->to(base_url('im-manajemen-voucher/reseller'))->with('success', 'reseller berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-manajemen-voucher/reseller'))->with('error', 'reseller gagal dihapus. Silakan coba lagi.');
        }
    }
}
