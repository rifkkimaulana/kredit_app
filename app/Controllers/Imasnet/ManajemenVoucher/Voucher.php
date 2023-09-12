<?php

namespace App\Controllers\Imasnet\ManajemenVoucher;

use App\Models\Imasnet\ManajemenVoucher\VoucherModel;
use App\Models\Imasnet\ManajemenVoucher\PaketModel;

use App\Controllers\Imasnet\BaseController;

class Voucher extends BaseController
{
    public function index()
    {
        $paketModel = new PaketModel();

        $paketMap = [];
        foreach ($paketModel->findAll() as $paket) {
            $paketMap[$paket['id']] = $paket;
        }

        $voucherModel = new VoucherModel();

        $voucherData = $voucherModel->orderBy('created_at', 'desc')->findAll();

        $pilihanKomentar = [];
        $seenKomentar = [];

        foreach ($voucherData as $voucher) {
            $komentar = $voucher['komentar'];
            if (!in_array($komentar, $seenKomentar)) {
                $pilihanKomentar[] = [
                    'id' => $voucher['id'],
                    'komentar' => $komentar,
                ];
                $seenKomentar[] = $komentar;
            }
        }

        $data = [
            'title' => 'Manajemen Voucher Data',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'paketMap' => $paketMap,
            'paketData' => $paketModel->findAll(),
            'voucherData' => $voucherData,
            'pilihanKomentar' => $pilihanKomentar, // Menambahkan data pilihan komentar
        ];

        return view('Imasnet/Pages/ManajemenVoucher/Voucher', $data);
    }

    public function create()
    {
        $jumlah_create = $this->request->getPost('jumlah');

        if ($jumlah_create > 2000) {
            return redirect()->back()->withInput()->with('error', 'Jumlah generate maksimal adalah 2000.');
        }

        $prefix_komentar = 'im_code_' . bin2hex(random_bytes(4)); // Prefix komentar yang sama untuk setiap kode

        $voucherModel = new VoucherModel();

        for ($i = 0; $i < $jumlah_create; $i++) {
            $data = [
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

    public function deleteCheckbox()
    {
        $voucherIds = $this->request->getPost('voucher_ids');

        $voucherModel = new VoucherModel();

        if (!empty($voucherIds)) {
            foreach ($voucherIds as $voucherId) {
                $voucherModel->deleteId($voucherId);
            }

            return redirect()->to(base_url('im-manajemen-voucher/voucher'))->with('success', 'Voucher terpilih berhasil dihapus');
        } else {
            return redirect()->to(base_url('im-manajemen-voucher/voucher'))->with('error', 'Tidak ada voucher yang dipilih untuk dihapus');
        }
    }

    public function cetak()
    {
        $komentar = $this->request->getGet('komentar');

        if (!empty($komentar)) { // Periksa apakah komentar tidak kosong
            $voucherModel = new VoucherModel();

            $voucherData = $voucherModel->whereIn('komentar', [$komentar])->findAll(); // Ubah ke dalam bentuk array

            $paketModel = new PaketModel();

            $paketMap = [];
            foreach ($paketModel->findAll() as $paket) {
                $paketMap[$paket['id']] = $paket;
            }
            $data = [
                'voucherData' => $voucherData,
                'paketMap' => $paketMap
            ];

            return view('Imasnet/Pages/ManajemenVoucher/CetakLabelVoucher', $data);
        } else {
            return redirect()->back()->with('error', 'Pilih setidaknya satu komentar untuk mencetak.');
        }
    }
}
