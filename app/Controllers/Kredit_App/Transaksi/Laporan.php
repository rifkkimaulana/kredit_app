<?php

namespace App\Controllers\Kredit_App\Transaksi;

use PHPExcel_Style_Alignment;
use PHPExcel;
use PHPExcel_IOFactory;



use App\Controllers\Kredit_App\BaseController;

class Laporan extends BaseController
{
    public function index()
    {
        $penjualan = $this->penjualanModel->findAll();

        $data = [
            'title' => 'Management Transaksi',
            'user' => $this->user,
            'penjualanFindAll' => $penjualan,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,
        ];
        return view('kredit_app/pages/Transaksi/LaporanKeuangan', $data);
    }

    public function filter()
    {
        if (!empty($tanggalAwal) && !empty($tanggalAkhir)) {
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
        } else {
            $penjualan = $this->penjualanModel->findAll();

            $data = [
                'title' => 'Management Transaksi - Filter Tanggal',
                'user' => $this->user,
                'penjualanFindAll' => $penjualan,
                'perusahaan' => $this->aplikasi,
                'label' => $this->label,
            ];
        }

        return view('kredit_app/pages/Transaksi/LaporanKeuangan', $data);
    }

    public function cetak($method)
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

        if ($method === 'pdf') {
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
        if ($method === 'cetak') {
            $data = [
                'penjualanFindAll' => $penjualanFiltered ?? $penjualanAll,
                'totalHarga' => $totalHarga,
                'tanggalAwal' => $tanggalAwal,
                'tanggalAkhir' => $tanggalAkhir
            ];
            return view('kredit_app/laporan_pdf', $data);
        }

        if ($method === 'excel') {
            // Load PHPExcel library
            require_once APPPATH . 'Libraries/PHPExcel/PHPExcel.php';

            // Create a PHPExcel object
            $objPHPExcel = new PHPExcel();

            // Create a new worksheet
            $objPHPExcel->setActiveSheetIndex(0);
            $sheet = $objPHPExcel->getActiveSheet();

            // Add a title
            $sheet->setCellValue('A1', 'Laporan Penjualan');

            // Merge title cells
            $sheet->mergeCells('A1:F1');

            // Style title cell
            $titleStyle = array(
                'font' => array('bold' => true, 'size' => 16),
                'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER),
            );
            $sheet->getStyle('A1:F1')->applyFromArray($titleStyle);

            // Set row height for title
            $sheet->getRowDimension(1)->setRowHeight(25); // Adjust the height as needed

            // Add data and format the Excel file as needed
            $sheet->setCellValue('A2', 'No');
            $sheet->setCellValue('B2', 'No. Transaksi');
            $sheet->setCellValue('C2', 'Tanggal');
            $sheet->setCellValue('D2', 'Jumlah Beli');
            $sheet->setCellValue('E2', 'Harga Satuan');
            $sheet->setCellValue('F2', 'Total Harga');

            $penjualanFind = $this->penjualanModel->findAll();

            // Data
            $row = 3;
            $no = 1;
            foreach ($penjualanFind as $penjualan) {
                $sheet->setCellValue('A' . $row, $no);
                $sheet->setCellValue('B' . $row, $penjualan['no_transaksi']);
                $sheet->setCellValue('C' . $row, $penjualan['tanggal_penjualan']);
                $sheet->setCellValue('D' . $row, $penjualan['jumlah']);
                $sheet->setCellValue('E' . $row, 'Rp ' . number_format($penjualan['harga_satuan'], 2));
                $sheet->setCellValue('F' . $row, 'Rp ' . number_format($penjualan['total_harga'], 2));
                $row++;
                $no++;
            }

            // Total Harga
            $sheet->setCellValue('E' . $row, 'Total Harga');
            $sheet->setCellValue('F' . $row, 'Rp ' . number_format($totalHarga, 2));

            // Set headers to force download the file
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="laporan_penjualan.xlsx"');
            header('Cache-Control: max-age=0');

            // Save the Excel file to output
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
        }
    }
}
