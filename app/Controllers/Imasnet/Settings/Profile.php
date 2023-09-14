<?php

namespace App\Controllers\Imasnet\Settings;

use App\Models\UsersModel;

use App\Controllers\Imasnet\BaseController;

class Profile extends BaseController
{
    public function index()
    {
        $userModel = new UsersModel();

        $data = [
            'title' => 'Profile Pengguna',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'userDataId' => $userModel->find(session('user_id')),
        ];
        return view('Imasnet/Pages/Settings/Profile', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $userModel = new UsersModel();

        $data = [
            'nama_paket' => $this->request->getPost('nama_paket'),
            'harga_beli' => $this->request->getPost('harga_beli'),
            'harga_jual' => $this->request->getPost('harga_jual'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if (!$userModel->updateId($id, $data)) {
            return redirect()->to(base_url('im-settings/profile'))->with('success', 'Profil Pengguna berhasil diubah');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat ubah Profil Pengguna');
        }
    }
}
