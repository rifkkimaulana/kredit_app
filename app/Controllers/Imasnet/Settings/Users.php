<?php

namespace App\Controllers\Imasnet\Settings;

use App\Models\UsersModel;

use App\Controllers\Imasnet\BaseController;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UsersModel();

        $data = [
            'title' => 'Manajemen Pengguna',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'userData' => $userModel->where('aplication_name', 'imasnet')->findAll(),
        ];
        return view('Imasnet/Pages/Settings/ManajemenUsers', $data);
    }

    public function create()
    {
        $userModel = new UsersModel();

        // Ambil data dari form
        $userNama = $this->request->getPost('user_nama');
        $userUsername = $this->request->getPost('user_username');
        $userPassword = password_hash($this->request->getPost('user_password'), PASSWORD_DEFAULT);
        $email = $this->request->getPost('email');
        $noWa = $this->request->getPost('no_wa');
        $aplicationName = $this->request->getPost('aplication_name');

        // Simpan data ke database
        $userModel = new UsersModel();
        $data = [
            'user_nama' => $userNama,
            'user_username' => $userUsername,
            'user_password' => $userPassword,
            'email' => $email,
            'no_wa' => $noWa,
            'aplication_name' => $aplicationName,
            'user_level' => 'im_member',
        ];

        $foto = $this->request->getFile('user_foto');

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $logoName = $foto->getRandomName();

            $foto->move(FCPATH . 'assets/image/Imasnet/Settings/Users/', $logoName);
            $data['user_foto'] = $logoName;
        }

        if ($userModel->insert($data)) {
            return redirect()->to(base_url('im-settings/users'))->with('success', 'Data Pengguna berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan Data Pengguna');
        }
    }

    public function update()
    {
        $userId = $this->request->getPost('user_id');
        $user = $this->userModel->find($userId);

        $data = [
            'user_nama' => $this->request->getPost('user_nama'),
            'user_username' => $this->request->getPost('user_username'),
            'no_wa' => $this->request->getPost('no_wa'),
            'email' => $this->request->getPost('email'),
        ];

        $foto = $this->request->getFile('user_foto');
        $fotoLama = $this->request->getPost('logoLama');

        if ($foto->isValid() && !$foto->hasMoved()) {
            $logoName = $foto->getRandomName();

            if (!empty($fotoLama)) {
                $logoPath = FCPATH . 'assets/image/Imasnet/Settings/Users/' . $fotoLama;
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }

            $foto->move(FCPATH . 'assets/image/Imasnet/Settings/Users/', $logoName);
            $data['user_foto'] = $logoName;
        }

        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $currentPassword = $this->request->getPost('current_password');
        if (!empty($currentPassword) && password_verify($currentPassword, $user['user_password'])) {
            if (!empty($newPassword) && $newPassword === $confirmPassword) {

                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $data['user_password'] = $hashedPassword;
            }
        }

        $this->userModel->updateUser($userId, $data);

        return redirect()->to(base_url('im-settings/users'))->with('success', 'User' . ' ' . $user['user_nama'] . ' ' . 'berhasil diperbarui.');
    }

    public function delete($userId)
    {
        $user = $this->userModel->find($userId);

        if ($user) {
            $this->userModel->deleteUser($userId);

            return redirect()->to(base_url('im-settings/users'))->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->to(base_url('im-settings/users'))->with('error', 'Pengguna tidak ditemukan.');
        }
    }
}
