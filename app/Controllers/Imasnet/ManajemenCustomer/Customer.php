<?php

namespace App\Controllers\Imasnet\ManajemenCustomer;

use App\Models\Imasnet\ManajemenCustomer\CustomerModel;

use App\Controllers\Imasnet\BaseController;

class Customer extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();

        $data = [
            'title' => 'Manajemen Server',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'customerData' => $customerModel->findAll()
        ];
        return view('Imasnet/Pages/ManajemenCustomer/Customer', $data);
    }


    public function create()
    {
        // Ambil data dari formulir HTML
        $data = [
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'alamat' => $this->request->getPost('alamat'),
            'telpon' => $this->request->getPost('telpon'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'status' => $this->request->getPost('status')
        ];

        // Simpan data ke dalam database
        $customerModel = new CustomerModel();

        if ($customerModel->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-customer/customer'))->with('success', 'Data pelanggan berhasil disimpan');
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
            'id_pelanggan' => $this->request->getPost('id_pelanggan'),
            'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
            'alamat' => $this->request->getPost('alamat'),
            'telpon' => $this->request->getPost('telpon'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'status' => $this->request->getPost('status')
        ];

        $customerModel = new CustomerModel();

        if (!$customerModel->updateId($id, $data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-manajemen-customer/customer'))->with('success', 'Data pelanggan berhasil diubah');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data pelanggan');
        }
    }

    public function delete($id)
    {
        $customerModel = new CustomerModel();

        // Hapus data transaksi berdasarkan ID
        if ($customerModel->deleteId($id)) {
            // Jika penghapusan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-manajemen-customer/customer'))->with('success', 'serpelangganver berhasil dihapus.');
        } else {
            // Jika penghapusan gagal, arahkan kembali ke halaman daftar transaksi dengan pesan error
            return redirect()->to(base_url('im-manajemen-customer/customer'))->with('error', 'pelanggan gagal dihapus. Silakan coba lagi.');
        }
    }
}
