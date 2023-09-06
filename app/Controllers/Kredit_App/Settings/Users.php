<?php

namespace App\Controllers\Kredit_App\Settings;

use App\Controllers\Kredit_App\BaseController;

class Users extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Users Management Settings',
            'user' => $this->user,
            'userFindAll' => $this->userFindAll,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label
        ];
        return view('kredit_app/pages/settings/Users', $data);
    }

    public function user_update()
    {
        $userId = $this->request->getPost('user_id');
        $user = $this->userModel->find($userId);

        $data = [
            'user_nama' => $this->request->getPost('user_nama'),
            'user_username' => $this->request->getPost('user_username'),
            'no_wa' => $this->request->getPost('no_wa'),
            'email' => $this->request->getPost('email'),
            'user_level' => $this->request->getPost('user_level')
        ];

        $foto = $this->request->getFile('user_foto');
        $fotoLama = $this->request->getPost('logoLama');

        if ($foto->isValid() && !$foto->hasMoved()) {
            $logoName = $foto->getRandomName();

            if (!empty($fotoLama)) {
                $logoPath = FCPATH . 'assets/image/user/' . $fotoLama;
                if (file_exists($logoPath)) {
                    unlink($logoPath);
                }
            }

            $foto->move(FCPATH . 'assets/image/user/', $logoName);
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

        return redirect()->to(base_url('ka-settings/users'))->with('success', 'User' . ' ' . $user['user_nama'] . ' ' . 'berhasil diperbarui.');
    }

    public function user_delete($userId)
    {
        $user = $this->userModel->find($userId);

        if ($user) {
            $this->userModel->deleteUser($userId);

            return redirect()->to(base_url('ka-settings/users'))->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->to(base_url('ka-settings/users'))->with('error', 'Pengguna tidak ditemukan.');
        }
    }
}
