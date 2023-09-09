<?php

namespace App\Controllers\Imasnet\Inventory;

use App\Models\Imasnet\Inventory\TransactionsModel;
use App\Models\Imasnet\Inventory\CustomersModel;
use App\Models\Imasnet\Inventory\SuppliersModel;
use App\Models\Imasnet\Inventory\InventoryModel;

use App\Controllers\Imasnet\BaseController;

class Transaction extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionsModel();
        $customersModel = new CustomersModel();
        $suplierModel = new SuppliersModel();
        $inventoryModel = new InventoryModel();

        $inventoryMap = [];
        $inventories = $inventoryModel->findAll();

        foreach ($inventories as $inventory) {
            $inventoryMap[$inventory['id']] = $inventory;
        }

        $data = [
            'title' => 'Manajemen Transaksi',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'transactions' => $transactionModel->findAll(),
            'suppliers' => $suplierModel->findAll(), // form add Transaction for suplier
            'customers' => $customersModel->findAll(), // Form add transaction for customer
            'inventories' => $inventoryModel->findAll(), // Form add transaction for Inventory
            'inventoryMap' => $inventoryMap, // Form add transaction for Inventory where id from view pages
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
            'biaya' => $this->request->getPost('biaya'),
            'jumlah' => $this->request->getPost('jumlah'),
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

    public function update()
    {
        $id = $this->request->getPost('id');
        // Validasi input form sesuai kebutuhan Anda
        $data = [
            'keterangan' => $this->request->getPost('keterangan'),
            'supliers_id' => $this->request->getPost('supliers_id'),
            'customers_id' => $this->request->getPost('customers_id'),
            'inventory_id' => $this->request->getPost('inventory_id'),
            'biaya' => $this->request->getPost('biaya'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];

        $transactionModel = new TransactionsModel();
        // Simpan data transaksi menggunakan model
        if (!$transactionModel->updateId($id, $data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-inventory/transaction'))->with('success', 'Transaksi berhasil Diubah.');
        } else {
            // Jika penyimpanan gagal, arahkan kembali ke halaman tambah transaksi dengan pesan error
            return redirect()->to(base_url('im-inventory/transaction'))->with('error', 'Transaksi gagal diubah. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $model = new TransactionsModel();
        // Hapus data transaksi berdasarkan ID
        if ($model->deleteId($id)) {
            // Jika penghapusan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-inventory/transaction'))->with('success', 'Transaksi berhasil dihapus.');
        } else {
            // Jika penghapusan gagal, arahkan kembali ke halaman daftar transaksi dengan pesan error
            return redirect()->to(base_url('im-inventory/transaction'))->with('error', 'Transaksi gagal dihapus. Silakan coba lagi.');
        }
    }
}
