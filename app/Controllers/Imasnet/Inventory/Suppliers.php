<?php

namespace App\Controllers\Imasnet\Inventory;

use App\Models\Imasnet\Inventory\SuppliersModel;

use App\Controllers\Imasnet\BaseController;

class Suppliers extends BaseController
{
    public function index()
    {

        $suplierModel = new SuppliersModel();

        $data = [
            'title' => 'Manajemen Pemasok',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'suppliers' => $suplierModel->findAll()
        ];
        return view('Imasnet/Pages/Inventory/Suppliers', $data);
    }

    public function create()
    {
        // Ambil data dari form
        $namaLengkap = $this->request->getPost('nama_lengkap');
        $telpon = $this->request->getPost('telpon');
        $noRek = $this->request->getPost('no_rek');
        $namaNoRek = $this->request->getPost('nama_no_rek');
        $namaToko = $this->request->getPost('nama_toko');
        $alamat = $this->request->getPost('alamat');

        // Simpan data ke dalam database
        $model = new SuppliersModel();
        $data = [
            'nama_lengkap' => $namaLengkap,
            'telpon' => $telpon,
            'no_rek' => $noRek,
            'nama_no_rek' => $namaNoRek,
            'nama_toko' => $namaToko,
            'alamat' => $alamat,
        ];

        if ($model->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/suppliers'))->with('success', 'Data pemasok berhasil disimpan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data pemasok');
        }
    }
}
