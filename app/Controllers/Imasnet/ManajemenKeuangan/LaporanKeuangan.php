<?php

namespace App\Controllers\Imasnet\ManajemenKeuangan;

use App\Models\Imasnet\ManajemenKeuangan\DataKeuanganModel;
use App\Models\Imasnet\ManajemenKeuangan\JenisKeuanganModel;
use App\Models\Imasnet\ManajemenKeuangan\KategoriKeuanganModel;
use App\Models\Imasnet\ManajemenKeuangan\PengelolaKeuanganModel;
use App\Models\Imasnet\ManajemenKeuangan\RiwayatTransaksiModel;

use App\Controllers\Imasnet\BaseController;

class LaporanKeuangan extends BaseController
{
    public function index()
    {
        $dateKeuanganModel = new DataKeuanganModel();
        $jenisKeuanganModel = new JenisKeuanganModel();
        $kategoriKeuanganModel = new KategoriKeuanganModel();
        $pengelolaKeuanganModel = new PengelolaKeuanganModel();
        $riwayatTransaksiModel = new RiwayatTransaksiModel();

        $data = [
            'title' => 'Laporan Keuangan',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'keuanganData' => $dateKeuanganModel->findAll(),
            'jenisKeuanganData' => $jenisKeuanganModel->findAll(),
            'kategoriKeuanganData' => $kategoriKeuanganModel->findAll(),
            'pengelolaKeuanganData' => $pengelolaKeuanganModel->findAll(),
            'riwayatKeuanganData' => $riwayatTransaksiModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenKeuangan/LaporanKeuangan', $data);
    }


    public function create()
    {
        $data = [
            'kategori_id' => $this->request->getPost('kategori_id'),
            'jenis_id' => $this->request->getPost('jenis_id'),
            'pengelola_id' => $this->request->getPost('pengelola_id'),
            'pemasukan' => $this->request->getPost('pemasukan'),
            'pengeluaran' => $this->request->getPost('pengeluaran'),
            'keterangan' => $this->request->getPost('keterangan'),
            'no_referensi' => $this->request->getPost('no_referensi')
        ];


        $dateKeuanganModel = new DataKeuanganModel();

        if ($dateKeuanganModel->insertData($data)) {
            return redirect()->to(base_url('im-manajemen-keuangan/laporan-keuangan'))->with('success', 'Data keuangan berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data keuangan');
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'kategori_id' => $this->request->getPost('kategori_id'),
            'jenis_id' => $this->request->getPost('jenis_id'),
            'pengelola_id' => $this->request->getPost('pengelola_id'),
            'pemasukan' => $this->request->getPost('pemasukan'),
            'pengeluaran' => $this->request->getPost('pengeluaran'),
            'keterangan' => $this->request->getPost('keterangan'),
            'no_referensi' => $this->request->getPost('no_referensi')
        ];

        $dateKeuanganModel = new DataKeuanganModel();

        if (!$dateKeuanganModel->updateId($id, $data)) {
            return redirect()->to(base_url('im-manajemen-keuangan/laporan-keuangan'))->with('success', 'Data keuangan berhasil diubah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data keuangan');
        }
    }

    public function delete($id)
    {
        $dateKeuanganModel = new DataKeuanganModel();

        if ($dateKeuanganModel->deleteId($id)) {
            return redirect()->to(base_url('im-manajemen-keuangan/laporan-keuangan'))->with('success', 'keuangan berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-manajemen-keuangan/laporan-keuangan'))->with('error', 'keuangan gagal dihapus. Silakan coba lagi.');
        }
    }
}
