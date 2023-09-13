<?php

namespace App\Controllers\Imasnet\ManajemenVoucher;

use App\Models\Imasnet\ManajemenServer\ServerModel;

use App\Models\Imasnet\ManajemenVoucher\VoucherModel;
use App\Models\Imasnet\ManajemenVoucher\PaketModel;
use App\Models\Imasnet\ManajemenVoucher\ResellerModel;
use App\Models\Imasnet\ManajemenVoucher\PengirimModel;
use App\Models\Imasnet\ManajemenVoucher\RiwayatModel;

use App\Controllers\Imasnet\BaseController;

class Riwayat extends BaseController
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

        $voucherMap = [];
        foreach ($voucherModel->findAll() as $voucher) {
            $voucherMap[$voucher['id']] = $voucher;
        }

        $resellerModel = new ResellerModel();

        $resellerMap = [];
        foreach ($resellerModel->findAll() as $reseller) {
            $resellerMap[$reseller['id']] = $reseller;
        }

        $pengirimModel = new PengirimModel();

        $pengirimMap = [];
        foreach ($pengirimModel->findAll() as $pengirim) {
            $pengirimMap[$pengirim['id']] = $pengirim;
        }

        $riwayatModel = new RiwayatModel();

        $data = [
            'title' => 'Riwayat Voucher Data',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'riwayatData' => $riwayatModel->findAll(),
            'voucherMap' => $voucherMap,
            'serverMap' => $serverMap,
            'serverData' => $serverModel->findAll(),
            'paketMap' => $paketMap,
            'resellerMap' => $resellerMap,
            'resellerData' => $resellerModel->findAll(),
            'pengirimMap' => $pengirimMap,
        ];
        return view('Imasnet/Pages/ManajemenVoucher/Riwayat', $data);
    }

    public function delete($id)
    {
        $riwayatModel = new RiwayatModel();

        if ($riwayatModel->deleteId($id)) {
            return redirect()->to(base_url('im-manajemen-voucher/server'))->with('success', 'server berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-manajemen-voucher/server'))->with('error', 'server gagal dihapus. Silakan coba lagi.');
        }
    }

    public function pengirimanPost()
    {
        $data = [
            'paket_id' => $this->request->getPost('paket_id'),
            'reseller_id' => $this->request->getPost('reseller_id'),
            'server_id' => $this->request->getPost('server_id'),
            'pengirim_id' => $this->request->getPost('pengirim_id'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $riwayatModel = new RiwayatModel();
        $voucherModel = new VoucherModel();

        if ($riwayatModel->insertData($data)) {
            $voucherModel->deleteId($this->request->getPost('voucher_id'));
            return redirect()->to(base_url('im-manajemen-voucher/riwayat'))->with('success', 'Data pengiriman voucher berhasil disimpan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data pengiriman voucher');
        }
    }
}
