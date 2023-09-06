<?php

namespace App\Controllers\Kredit_App\Settings;

use App\Controllers\Kredit_App\BaseController;

class App extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Aplication Settings',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label
        ];
        return view('kredit_app/pages/Settings/SettingsApp', $data);
    }

    public function app_update()
    {
        if ($this->request->getMethod() === 'post') {
            $data = [
                'nama_aplikasi' => $this->request->getPost('nama_aplikasi'),
                'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                'alamat1' => $this->request->getPost('alamat1'),
                'alamat2' => $this->request->getPost('alamat2'),
                'kode_pos' => $this->request->getPost('kode_pos'),
                'email' => $this->request->getPost('email'),
                'telpon' => $this->request->getPost('telpon'),

                'bank1' => $this->request->getPost('bank1'),
                'bank2' => $this->request->getPost('bank2'),
                'bank3' => $this->request->getPost('bank3'),

                'atas_nama1' => $this->request->getPost('atas_nama1'),
                'atas_nama2' => $this->request->getPost('atas_nama2'),
                'atas_nama3' => $this->request->getPost('atas_nama3'),

                'no_rekening1' => $this->request->getPost('no_rekening1'),
                'no_rekening2' => $this->request->getPost('no_rekening2'),
                'no_rekening3' => $this->request->getPost('no_rekening3'),
            ];

            $logo = $this->request->getFile('logonew');
            $logoLama = $this->request->getPost('logoLama');

            if ($logo->isValid() && !$logo->hasMoved()) {
                $logoName = $logo->getRandomName();

                if (!empty($logoLama)) {
                    $logoPath = FCPATH . 'assets/image/perusahaan/' . $logoLama;
                    if (file_exists($logoPath)) {
                        unlink($logoPath);
                    }
                }

                $logo->move(FCPATH . 'assets/image/perusahaan/', $logoName);
                $data = ['logo' => $logoName];
            }

            $this->aplikasiModel->updatePengaturan(1, $data);

            return redirect()->to(base_url('ka-settings/app'))->with('success', 'Profile berhasil diperbaharui.');
        }
    }
}
