<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenjualanModel;
use App\Models\UsersModel;
use DateTime;
use DateInterval;
use DatePeriod;

class StatistikPenjualan extends BaseController
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
            && session('user_level') !== 'manager'
            && session('user_level') !== 'member'
        ) {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $PenjualanModel = new PenjualanModel();

        // Mengambil data penjualan untuk bulan ini
        $firstDayOfMonth = date('Y-m-01'); // Tanggal awal bulan ini
        $lastDayOfMonth = date('Y-m-t');   // Tanggal akhir bulan ini

        $penjualanData = $PenjualanModel
            ->where('tanggal_penjualan >=', $firstDayOfMonth)
            ->where('tanggal_penjualan <=', $lastDayOfMonth)
            ->findAll();

        // Olah data untuk grafik
        $dateRange = [];
        $salesData = [];

        $start = new DateTime($firstDayOfMonth);
        $end = new DateTime($lastDayOfMonth);
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($start, $interval, $end);

        foreach ($period as $date) {
            $dateRange[] = $date->format('Y-m-d');

            $totalSales = 0;
            foreach ($penjualanData as $penjualan) {
                if ($penjualan['tanggal_penjualan'] === $date->format('Y-m-d')) {
                    $totalSales += $penjualan['jumlah']; // Menggunakan jumlah beli sebagai data penjualan
                }
            }
            $salesData[] = $totalSales;
        }

        $dataForView = [
            'title' => 'Statistik Penjualan',
            'user' => $user,
            'labels' => json_encode($dateRange), // Mengonversi array ke JSON
            'data' => json_encode($salesData),    // Mengonversi array ke JSON
        ];

        return view('admin/pages/Statistik', $dataForView);
    }
}
