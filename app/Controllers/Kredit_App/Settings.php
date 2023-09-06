<?php

namespace App\Controllers\Kredit_App;

use App\Models\AplikasiModel;
use App\Models\UsersModel;
use App\Models\IdentitasModel;
use App\Models\WablasModel;
use App\Models\GoogleApiModel;


class Settings extends BaseController
{



    // Users View
    public function users()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
            && session('user_level') !== 'manager'
        ) {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));
        $allUsers = $userModel->findAll();

        if (!$user) {
            return redirect()->to('login');
        }

        $data = [
            'title' => 'Pengaturan',
            'user' => $user,
            'allUsers' => $allUsers
        ];
        return view('admin/pages/users', $data);
    }

    public function user_postUpdate()
    {
        $userId = $this->request->getPost('user_id');
        $model = new UsersModel();
        $user = $model->find($userId);

        $data = [
            'user_nama' => $this->request->getPost('user_nama'),
            'user_username' => $this->request->getPost('user_username'),
            'no_wa' => $this->request->getPost('no_wa'),
            'email' => $this->request->getPost('email'),
            'user_level' => $this->request->getPost('user_level')
        ];

        $logo = $this->request->getFile('user_foto');
        $logoLama = $this->request->getPost('logoLama');

        if ($logo->isValid() && !$logo->hasMoved()) {
            $logoName = $logo->getRandomName();

            if (!empty($logoLama)) {
                $logoPath = FCPATH . 'assets/image/user/' . $logoLama;
                if (file_exists($logoPath)) {
                    unlink($logoPath); // Hapus logo lama dari direktori
                }
            }

            $logo->move(FCPATH . 'assets/image/user/', $logoName);
            // Update logo in data array
            $data['user_foto'] = $logoName;
        }

        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $currentPassword = $this->request->getPost('current_password');
        if (!empty($currentPassword) && password_verify($currentPassword, $user['user_password'])) {
            if (!empty($newPassword) && $newPassword === $confirmPassword) {
                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update password in data array
                $data['user_password'] = $hashedPassword;
            }
        }

        $model->updateUser($userId, $data);

        return redirect()->to(base_url('pengaturan/users'))->with('success', 'User' . ' ' . $user['user_nama'] . ' ' . 'berhasil diperbarui.');
    }

    public function deleteUsers($userId)
    {
        if (
            session('user_level') !== 'administrator'
        ) {
            return redirect()->to('login');
        }

        $model = new UsersModel();
        $user = $model->find($userId);

        if ($user) {
            $model->deleteUser($userId);
            return redirect()->to(base_url('pengaturan/users'))->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->to(base_url('pengaturan/users'))->with('error', 'Pengguna tidak ditemukan.');
        }
    }

    // Whatsapp Api Setting View
    public function whatsappApiSetting()
    {

        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
            && session('user_level') !== 'manager'
        ) {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }


        $WablasModel = new WablasModel();
        $data = [
            'title' => 'Api Whatsapp Setting',
            'user' => $user,
            'wa' => $WablasModel->find(1)
        ];
        return view('admin/pages/whatsappApiSetting', $data);
    }

    public function whatsappApiSetting_update()
    {
        $model = new WablasModel();

        $data = [
            'domain' => $this->request->getPost('domain'),
            'token_api' => $this->request->getPost('token_api'),
        ];

        $model->updateWablas($data);

        return redirect()->to(base_url('pengaturan/whatsapp_api'))->with('success', 'Konfigurasi berhasil diperbarui.');
    }

    // Logout All Session
    public function logout()
    {
        session()->destroy();
        $this->response->deleteCookie('remember_me');

        return redirect()->to('login');
    }

    public function settingApiGoogle()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }
        if (
            session('user_level') !== 'administrator'
            && session('user_level') !== 'manager'
        ) {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $googleApiModel = new GoogleApiModel();
        $data = [
            'title' => 'Google Api Login Setting',
            'user' => $user,
            'google' => $googleApiModel->find(1)
        ];
        return view('admin/pages/GoogleApiLogin', $data);
    }

    public function settingApiGoogle_post()
    {
        $googleApiModel = new GoogleApiModel();
        $data = [
            'client_id' => $this->request->getPost('client_id'),
            'client_secret' => $this->request->getPost('client_secret'),
        ];

        $googleApiModel->updateGoogle($data);

        return redirect()->to(base_url('pengaturan/google_api'))->with('success', 'Api Google Login anda berhasil diperbarui.');
    }

    //--------------------------------------------------------------------
}
