<?php

namespace App\Controllers\Imasnet\Inventory;

use App\Models\Imasnet\Inventory\LocationModel;

use App\Controllers\Imasnet\BaseController;

class Location extends BaseController
{
    public function index()
    {
        $locationModel = new LocationModel();

        $data = [
            'title' => 'Manajemen Lokasi',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'locations' => $locationModel->findAll()
        ];
        return view('Imasnet/Pages/Inventory/Location', $data);
    }

    public function create()
    {
        // Ambil data dari form
        $namaLokasi = $this->request->getPost('nama_lokasi');
        $penanggungJawab = $this->request->getPost('penanggung_jawab');
        $telpon = $this->request->getPost('telpon');
        $alamat = $this->request->getPost('alamat');

        // Simpan data ke dalam database
        $model = new LocationModel();
        $data = [
            'nama_lokasi' => $namaLokasi,
            'penanggung_jawab' => $penanggungJawab,
            'telpon' => $telpon,
            'alamat' => $alamat,
        ];

        if ($model->insertData($data)) {
            // Jika penyimpanan berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
            return redirect()->to(base_url('im-inventory/location'))->with('success', 'Data lokasi berhasil disimpan');
        } else {
            // Jika penyimpanan gagal, arahkan ke halaman sebelumnya atau tampilkan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data lokasi');
        }
    }

    //--------------------------------------------------------------------
}
