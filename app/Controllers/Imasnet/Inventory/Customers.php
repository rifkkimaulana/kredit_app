<?php

namespace App\Controllers\Imasnet\Inventory;

use App\Models\Imasnet\Inventory\CustomersModel;

use App\Controllers\Imasnet\BaseController;

class Customers extends BaseController
{
    public function index()
    {
        $customersModel = new CustomersModel();
        $data = [
            'title' => 'Manajemen Pelanggan',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'customers' => $customersModel->findAll()
        ];
        return view('Imasnet/Pages/Inventory/Customers', $data);
    }

    public function createCust()
    {
        // Ambil data dari form
        $nama_lengkap = $this->request->getPost('nama_lengkap');
        $telpon = $this->request->getPost('telpon');
        $alamat = $this->request->getPost('alamat');

        // Simpan data ke dalam database
        $model = new CustomersModel();
        $data = [
            'nama_lengkap' => $nama_lengkap,
            'telpon' => $telpon,
            'alamat' => $alamat,
        ];

        if ($model->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/customers'))->with('success', 'Pelanggan berhasil ditambahkan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan pelanggan');
        }
    }

    //--------------------------------------------------------------------
}
