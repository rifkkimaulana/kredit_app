<?php

namespace App\Controllers\Imasnet\Inventory;

use App\Models\Imasnet\Inventory\InventoryModel;
use App\Models\Imasnet\Inventory\CategoriesModel;
use App\Models\Imasnet\Inventory\CustomersModel;
use App\Models\Imasnet\Inventory\HistoryModel;
use App\Models\Imasnet\Inventory\LocationModel;
use App\Models\Imasnet\Inventory\SuppliersModel;
use App\Models\Imasnet\Inventory\TransactionsModel;

use App\Controllers\Imasnet\BaseController;

class Inventory extends BaseController
{
    public function index()
    {
        $inventoryModel = new InventoryModel();

        $data = [
            'title' => 'Manajemen Inventory',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'inventories' => $inventoryModel->findAll()
        ];
        return view('Imasnet/Pages/Inventory/Inventory', $data);
    }

    public function create()
    {
        // Ambil data dari form
        $locationId = $this->request->getPost('location_id');
        $suppliersId = $this->request->getPost('suppliers_id');
        $customerId = $this->request->getPost('customer_id');
        $categoriesId = $this->request->getPost('categories_id');
        $namaBarang = $this->request->getPost('nama_barang');
        $stok = $this->request->getPost('stok');
        $satuan = $this->request->getPost('satuan');
        $hargaSatuan = $this->request->getPost('harga_satuan');
        $keterangan = $this->request->getPost('keterangan');
        // Simpan data ke dalam database
        $model = new InventoryModel();
        $data = [
            'location_id' => $locationId,
            'suppliers_id' => $suppliersId,
            'customer_id' => $customerId,
            'categories_id' => $categoriesId,
            'nama_barang' => $namaBarang,
            'stok' => $stok,
            'satuan' => $satuan,
            'harga_satuan' => $hargaSatuan,
            'keterangan' => $keterangan,
        ];

        if ($model->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/inventory'))->with('success', 'Data inventaris berhasil disimpan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data inventaris');
        }
    }

    //--------------------------------------------------------------------
}
