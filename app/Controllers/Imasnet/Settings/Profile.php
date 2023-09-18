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
        if ($this->request->getMethod() === 'post') {

            $user = $this->userModel->find(session('user_id'));

            // Form Update Photo
            if (isset($_POST['update_poto'])) {
                $foto = $this->request->getFile('user_foto');
                $foto_lama = $this->request->getPost('user_fotoLama');

                if ($foto->isValid() && !$foto->hasMoved()) {
                    $logoName = $foto->getRandomName();

                    if (!empty($foto_lama)) {
                        $logoPath = FCPATH . 'assets/image/Imasnet/Settings/Users/' . $foto_lama;
                        if (file_exists($logoPath)) {
                            unlink($logoPath);
                        }
                    }

                    $foto->move(FCPATH . 'assets/image/Imasnet/Settings/Users/', $logoName);
                    $data['user_foto'] = $logoName;

                    $this->userModel->updateUser($user['user_id'], $data);

                    return redirect()->to(base_url('im-settings/profile'))->with('success', 'Profile Picture ' . ' ' . $user['user_nama'] . ' ' . 'berhasil diperbarui.');
                } else {
                    $error = $foto->getErrorString();
                    return redirect()->to(base_url('im-settings/profile'))->with('error', 'Profile Picture gagal diperbarui. Error: </br>' . $error);
                }
            }

            // Form Update Password
            if (isset($_POST['update_password'])) {
                $newPassword = $this->request->getPost('new_password');
                $confirmPassword = $this->request->getPost('confirm_password');

                $currentPassword = $this->request->getPost('current_password');
                if (!empty($currentPassword) && password_verify($currentPassword, $user['user_password'])) {

                    if (!empty($newPassword) && $newPassword === $confirmPassword) {
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        $data['user_password'] = $hashedPassword;

                        $this->userModel->updateUser($user['user_id'], $data);

                        return redirect()->to(base_url('im-settings/profile'))->with('success', 'Password ' . ' ' . $user['user_nama'] . ' ' . 'berhasil diperbarui.');
                    } else {
                        return redirect()->to(base_url('im-settings/profile'))->with('error', 'Password Tidak Sama. Silahkan ulangi.');
                    }
                } else {
                    return redirect()->to(base_url('im-settings/profile'))->with('error', 'Password lama tidak tepat. Silahkan Ulangi.');
                }
            }

            // Form Update Detail
            if (isset($_POST['update_detail'])) {
                $data = [
                    'user_nama' => $this->request->getPost('user_nama'),
                    'user_username' => $this->request->getPost('user_username'),
                    'no_wa' => $this->request->getPost('no_wa'),
                    'email' => $this->request->getPost('email'),
                    'keterangan' => $this->request->getPost('keterangan')
                ];

                $this->userModel->updateUser($user['user_id'], $data);
                return redirect()->to(base_url('im-settings/profile'))->with('success', 'Detail' . ' ' . $user['user_nama'] . ' ' . 'berhasil diperbarui.');
            }
        }
    }
}
