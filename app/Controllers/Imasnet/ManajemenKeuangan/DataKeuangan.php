<?php

namespace App\Controllers\Imasnet\ManajemenKeuangan;

use App\Models\Imasnet\ManajemenKeuangan\DataKeuanganModel;
use App\Models\Imasnet\ManajemenKeuangan\JenisKeuanganModel;
use App\Models\Imasnet\ManajemenKeuangan\KategoriKeuanganModel;
use App\Models\Imasnet\ManajemenKeuangan\PengelolaKeuanganModel;
use App\Models\Imasnet\ManajemenKeuangan\RiwayatTransaksiModel;
use App\Models\UsersModel;

use App\Controllers\Imasnet\BaseController;

class DataKeuangan extends BaseController
{
    public function index()
    {
        $dateKeuanganModel = new DataKeuanganModel();
        $jenisKeuanganModel = new JenisKeuanganModel();
        $kategoriKeuanganModel = new KategoriKeuanganModel();
        $pengelolaKeuanganModel = new PengelolaKeuanganModel();
        $riwayatTransaksiModel = new RiwayatTransaksiModel();

        $jenisMap = [];
        foreach ($jenisKeuanganModel->findAll() as $jenis) {
            $jenisMap[$jenis['id']] = $jenis;
        }

        $pengelolaMap = [];
        foreach ($pengelolaKeuanganModel->findAll() as $pengelola) {
            $pengelolaMap[$pengelola['id']] = $pengelola;
        }

        $usersModel = new UsersModel();

        $userMap = [];
        foreach ($usersModel->findAll() as $user) {
            $userMap[$user['user_id']] = $user;
        }

        $data = [
            'title' => 'Manajemen Server',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'keuanganData' => $dateKeuanganModel->findAll(),
            'jenisKeuanganData' => $jenisKeuanganModel->findAll(),
            'kategoriKeuanganData' => $kategoriKeuanganModel->findAll(),
            'pengelolaKeuanganData' => $pengelolaKeuanganModel->findAll(),
            'riwayatKeuanganData' => $riwayatTransaksiModel->findAll(),
            'jenisMap' => $jenisMap,
            'pengelolaMap' => $pengelolaMap,
            'userMap' => $userMap
        ];
        return view('Imasnet/Pages/ManajemenKeuangan/DataKeuangan', $data);
    }


    public function create()
    {
        $timestamp = time();
        $randomNumber = mt_rand(1000, 9999);
        $referenceNumber = "REF" . date("YmdHis", $timestamp) . $randomNumber;

        $data = [
            'jenis_id' => $this->request->getPost('jenis_id'),
            'pengelola_id' => $this->request->getPost('pengelola_id'),
            'pemasukan' => $this->request->getPost('pemasukan'),
            'pengeluaran' => $this->request->getPost('pengeluaran'),
            'keterangan' => $this->request->getPost('keterangan'),
            'no_referensi' => $referenceNumber
        ];

        $dateKeuanganModel = new DataKeuanganModel();

        $gambar = $this->request->getFile('foto');

        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaUnik = $gambar->getRandomName();
            $gambar->move(FCPATH . 'assets/image/Imasnet/ManajemenKeuangan/', $namaUnik);

            $data['foto'] = $namaUnik;
        }

        if ($dateKeuanganModel->insertData($data)) {
            return redirect()->to(base_url('im-manajemen-keuangan/data-keuangan'))->with('success', 'Data keuangan berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data keuangan');
        }
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'jenis_id' => $this->request->getPost('jenis_id'),
            'pengelola_id' => $this->request->getPost('pengelola_id'),
            'pemasukan' => $this->request->getPost('pemasukan'),
            'pengeluaran' => $this->request->getPost('pengeluaran'),
            'keterangan' => $this->request->getPost('keterangan'),
            'no_referensi' => $this->request->getPost('no_referensi')
        ];

        $dateKeuanganModel = new DataKeuanganModel();

        $gambar = $this->request->getFile('foto');

        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $namaUnik = $gambar->getRandomName();
            $gambar->move(FCPATH . 'assets/image/Imasnet/ManajemenKeuangan/', $namaUnik);

            $inventory = $dateKeuanganModel->where('id', $id)->first();
            $gambar = $inventory['foto'];

            if (!empty($gambar)) {
                $gambarPath = FCPATH . 'assets/image/Imasnet/ManajemenKeuangan/' . $gambar;
                if (file_exists($gambarPath)) {
                    unlink($gambarPath);
                }
            }

            $data['foto'] = $namaUnik;
        }

        if (!$dateKeuanganModel->updateId($id, $data)) {
            return redirect()->to(base_url('im-manajemen-keuangan/data-keuangan'))->with('success', 'Data keuangan berhasil diubah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data keuangan');
        }
    }

    public function delete($id)
    {
        $dateKeuanganModel = new DataKeuanganModel();

        if ($dateKeuanganModel->deleteId($id)) {
            return redirect()->to(base_url('im-manajemen-keuangan/data-keuangan'))->with('success', 'keuangan berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-manajemen-keuangan/data-keuangan'))->with('error', 'keuangan gagal dihapus. Silakan coba lagi.');
        }
    }
}
