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
        $suplierModel = new SuppliersModel();
        $customersModel = new CustomersModel();
        $locationModel = new LocationModel();
        $categoriesModel = new CategoriesModel();

        $data = [
            'title' => 'Manajemen Inventory',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'inventories' => $inventoryModel->findAll(),
            'suppliers' => $suplierModel->findAll(), // form add Inventory for suplier
            'customers' => $customersModel->findAll(), // Form add Inventory for customer
            'locations' => $locationModel->findAll(), // Form add Inventory for location
            'categories' => $categoriesModel->findAll(),  // Form add Inventory for categories
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

        $gambar = $this->request->getFile('foto');

        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaUnik = $gambar->getRandomName();
            $gambar->move(FCPATH . 'assets/image/Imasnet/Inventory', $namaUnik);

            $data['foto'] = $namaUnik;
        }

        if ($model->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/inventory'))->with('success', 'Data inventaris berhasil disimpan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data inventaris');
        }
    }

    public function update()
    {
        // Ambil data dari form
        $id = $this->request->getPost('id');
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

        $gambar = $this->request->getFile('foto');

        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaUnik = $gambar->getRandomName();
            $gambar->move(FCPATH . 'assets/image/produk', $namaUnik);

            $inventory = $model->where('id', $id)->first();
            $gambar = $inventory['foto'];
            if (!empty($gambar)) {
                $gambarPath = FCPATH . 'assets/image/Imasnet/Inventory/' . $gambar;
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }

            $data['foto'] = $namaUnik;
        }

        if (!$model->updateId($id, $data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/inventory'))->with('success', 'Data inventaris berhasil diubah');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan ubah inventaris');
        }
    }

    public function delete($id)
    {
        $model = new InventoryModel();

        $inventory = $model->where('id', $id)->first();
        $gambar = $inventory['foto'];
        if (!empty($gambar)) {
            $gambarPath = FCPATH . 'assets/image/Imasnet/Inventory/' . $gambar;
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }

        // Hapus data transaksi berdasarkan ID
        if ($model->deleteId($id)) {
            // Jika penghapusan berhasil, arahkan ke halaman yang sesuai
            return redirect()->to(base_url('im-inventory/inventory'))->with('success', 'Transaksi berhasil dihapus.');
        } else {
            // Jika penghapusan gagal, arahkan kembali ke halaman daftar transaksi dengan pesan error
            return redirect()->to(base_url('im-inventory/inventory'))->with('error', 'Transaksi gagal dihapus. Silakan coba lagi.');
        }
    }

    //--------------------------------------------------------------------
}
