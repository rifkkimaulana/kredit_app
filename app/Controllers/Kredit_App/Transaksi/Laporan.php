<?php

namespace App\Controllers\Kredit_App\Transaksi;

use Dompdf\Dompdf;
use Dompdf\Options;


use App\Controllers\Kredit_App\BaseController;

class Laporan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Management Transaksi',
            'user' => $this->user,
            'penjualanFindAll' => $this->penjualanFindAll,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,
        ];
        return view('kredit_app/pages/Transaksi/LaporanKeuangan', $data);
    }

    public function filter()
    {
        $tanggalAwal = $this->request->getGet('tanggal_awal');
        $tanggalAkhir = $this->request->getGet('tanggal_akhir');

        $penjualanFiltered = $this->penjualanModel->where('tanggal_penjualan >=', $tanggalAwal)
            ->where('tanggal_penjualan <=', $tanggalAkhir)
            ->findAll();

        $data = [
            'title' => 'Management Transaksi - Filter Tanggal',
            'user' => $this->user,
            'penjualanFindAll' => $penjualanFiltered,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,
        ];

        return view('kredit_app/pages/Transaksi/LaporanKeuangan', $data);
    }

    public function cetak()
    {

        $tanggalAwal = $this->request->getGet('tanggal_awal');
        $tanggalAkhir = $this->request->getGet('tanggal_akhir');

        // Lakukan pengecekan apakah ada filter tanggal atau tidak
        if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
            // Cetak data berdasarkan filter tanggal
            $penjualanFiltered = $this->penjualanModel->where('tanggal_penjualan >=', $tanggalAwal)
                ->where('tanggal_penjualan <=', $tanggalAkhir)
                ->findAll();

            // Hitung total harga
            $totalHarga = array_sum(array_column($penjualanFiltered, 'total_harga'));

            // Buat nama file PDF berdasarkan tanggal awal dan akhir
            $pdfFileName = 'laporan_penjualan_' . date('Ymd', strtotime($tanggalAwal)) . '_' . date('Ymd', strtotime($tanggalAkhir)) . '.pdf';
        } else {
            // Cetak semua data yang ditampilkan dalam tabel
            $penjualanAll = $this->penjualanModel->findAll();

            // Hitung total harga
            $totalHarga = array_sum(array_column($penjualanAll, 'total_harga'));

            // Buat nama file PDF untuk seluruh data
            $pdfFileName = 'laporan_penjualan_semua.pdf';
        }

        // Buat instance Dompdf
        require_once APPPATH . 'Libraries/dompdf/autoload.inc.php';
        $dompdf = new \Dompdf\Dompdf();

        // Buat halaman PDF
        $html = view('kredit_app/laporan_pdf', ['penjualanFindAll' => $penjualanFiltered ?? $penjualanAll, 'totalHarga' => $totalHarga, 'tanggalAwal' => $tanggalAwal, 'tanggalAkhir' => $tanggalAkhir]);

        $dompdf->loadHtml($html);

        // Atur ukuran dan orientasi halaman
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser dengan nama file yang sesuai
        $dompdf->stream($pdfFileName);
    }
}
