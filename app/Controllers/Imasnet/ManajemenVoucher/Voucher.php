<?php

namespace App\Controllers\Imasnet\ManajemenVoucher;

use App\Models\Imasnet\ManajemenServer\ServerModel;
use App\Models\Imasnet\ManajemenVoucher\VoucherModel;
use App\Models\Imasnet\ManajemenVoucher\PaketModel;

use App\Models\Imasnet\ManajemenVoucher\ResellerModel;
use App\Models\Imasnet\ManajemenVoucher\PengirimModel;

use App\Controllers\Imasnet\BaseController;

class Voucher extends BaseController
{
    public function index()
    {
        $serverModel = new ServerModel();

        $serverMap = [];
        foreach ($serverModel->findAll() as $server) {
            $serverMap[$server['id']] = $server;
        }

        $paketModel = new PaketModel();

        $paketMap = [];
        foreach ($paketModel->findAll() as $paket) {
            $paketMap[$paket['id']] = $paket;
        }

        $voucherModel = new VoucherModel();


        $resellerModel = new ResellerModel();
        $pengirimModel = new PengirimModel();

        $data = [
            'title' => 'Manajemen Voucher Data',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'serverData' => $serverModel->findAll(),
            'serverMap' => $serverMap,
            'paketMap' => $paketMap,
            'paketData' => $paketModel->findAll(),
            'voucherData' => $voucherModel->findAll(),
            'resellerData' => $resellerModel->findAll(),
            'pengirimData' => $pengirimModel->findAll(),
        ];
        return view('Imasnet/Pages/ManajemenVoucher/Voucher', $data);
    }

    public function create()
    {
        $jumlah_create = $this->request->getPost('jumlah');
        $prefix_komentar = 'im_code_' . bin2hex(random_bytes(4)); // Prefix komentar yang sama untuk setiap kode

        $voucherModel = new VoucherModel();

        for ($i = 0; $i < $jumlah_create; $i++) {
            $data = [
                'server_id' => $this->request->getPost('server_id'),
                'reseller_id' => $this->request->getPost('reseller_id'),
                'pengirim_id' => $this->request->getPost('pengirim_id'),
                'paket_id' => $this->request->getPost('paket_id'),
                'komentar' => $prefix_komentar,
                'code' => bin2hex(random_bytes(8)), // Menghasilkan kode acak sepanjang 16 karakter (dapat disesuaikan)
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $voucherModel->insertData($data);
        }

        return redirect()->to(base_url('im-manajemen-voucher/voucher'))->with('success', 'Data voucher berhasil disimpan');
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $voucherModel = new VoucherModel();

        $data = [
            'server_id' => $this->request->getPost('server_id'),
            'reseller_id' => $this->request->getPost('reseller_id'),
            'pengirim_id' => $this->request->getPost('pengirim_id'),
            'paket_id' => $this->request->getPost('paket_id'),
            'code' => $this->request->getPost('code'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (!$voucherModel->updateId($id, $data)) {
            return redirect()->to(base_url('im-manajemen-voucher/voucher'))->with('success', 'Data voucher berhasil diubah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah data voucher');
        }
    }

    public function delete($id)
    {
        $voucherModel = new VoucherModel();

        if ($voucherModel->deleteId($id)) {
            return redirect()->to(base_url('im-manajemen-voucher/voucher'))->with('success', 'voucher berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-manajemen-voucher/voucher'))->with('error', 'voucher gagal dihapus. Silakan coba lagi.');
        }
    }
}
