<?php

namespace App\Controllers\Imasnet\Inventory;

use App\Models\Imasnet\Inventory\TransactionsModel;

use App\Controllers\Imasnet\BaseController;

class Transaction extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionsModel();
        $data = [
            'title' => 'Manajemen Transaksi',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'transactions' => $transactionModel->findAll()
        ];
        return view('Imasnet/Pages/Inventory/Transaction', $data);
    }
    public function create()
    {
        // Validasi input form sesuai kebutuhan Anda

        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'supliers_id' => $this->request->getPost('supliers_id'),
            'customers_id' => $this->request->getPost('customers_id'),
            'inventory_id' => $this->request->getPost('inventory_id'),
            'pemasukan' => $this->request->getPost('pemasukan'),
            'pengeluaran' => $this->request->getPost('pengeluaran'),
        ];
        $transactionModel = new TransactionsModel();
        // Simpan data transaksi menggunakan model
        if ($transactionModel->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-inventory/transaction'))->with('success', 'Transaksi berhasil ditambahkan.');
        } else {
            // Jika penyimpanan gagal, arahkan kembali ke halaman tambah transaksi dengan pesan error
            return redirect()->to(base_url('im-inventory/transaction'))->with('error', 'Transaksi gagal ditambahkan. Silakan coba lagi.');
        }
    }
}
