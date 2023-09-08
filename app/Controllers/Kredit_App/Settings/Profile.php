<?php

namespace App\Controllers\Kredit_App\Settings;

use App\Controllers\Kredit_App\BaseController;

class Profile extends BaseController
{
    public function index()
    {
        $user = $this->user;
        $identitas = $this->identitasModel->where('user_id', session('user_id'))->first();

        $data = [
            'title' => 'Profile Settings',
            'user' => $user,
            'identitas' => $identitas,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label
        ];
        return view('kredit_app/pages/settings/profile', $data);
    }

    public function profile_update()
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
                        $logoPath = FCPATH . 'assets/image/user/' . $foto_lama;
                        if (file_exists($logoPath)) {
                            unlink($logoPath);
                        }
                    }

                    $foto->move(FCPATH . 'assets/image/user/', $logoName);
                    $data['user_foto'] = $logoName;

                    $this->userModel->updateUser($user['user_id'], $data);

                    return redirect()->to(base_url('ka-settings/profile'))->with('success', 'Profile Picture ' . ' ' . $user['user_nama'] . ' ' . 'berhasil diperbarui.');
                } else {
                    $error = $foto->getErrorString();
                    return redirect()->to(base_url('ka-settings/profile'))->with('error', 'Profile Picture gagal diperbarui. Error: </br>' . $error);
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

                        return redirect()->to(base_url('ka-settings/profile'))->with('success', 'Password ' . ' ' . $user['user_nama'] . ' ' . 'berhasil diperbarui.');
                    } else {
                        return redirect()->to(base_url('ka-settings/profile'))->with('error', 'Password Tidak Sama. Silahkan ulangi.');
                    }
                } else {
                    return redirect()->to(base_url('ka-settings/profile'))->with('error', 'Password lama tidak tepat. Silahkan Ulangi.');
                }
            }

            // Form Update Detail
            if (isset($_POST['update_detail'])) {

                $data = [
                    'user_nama' => $this->request->getPost('user_nama'),
                    'user_username' => $this->request->getPost('user_username'),
                    'no_wa' => $this->request->getPost('no_wa'),
                    'email' => $this->request->getPost('email'),
                    'country' => $this->request->getPost('country'),
                    'keterangan' => $this->request->getPost('keterangan'),
                    'facebook' => $this->request->getPost('facebook'),
                    'tweeter' => $this->request->getPost('tweeter'),
                    'instagram' => $this->request->getPost('instagram')
                ];

                $this->userModel->updateUser($user['user_id'], $data);

                return redirect()->to(base_url('ka-settings/profile'))->with('success', 'Detail' . ' ' . $user['user_nama'] . ' ' . 'berhasil diperbarui.');
            }

            // Form Insert Identitas
            if (isset($_POST['identitas_insert'])) {

                $data = [
                    'user_id' => session('user_id'),
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'nomor_identitas' => $this->request->getPost('nomor_identitas'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                    'alamat' => $this->request->getPost('alamat'),
                    'agama' => $this->request->getPost('agama'),
                    'status_pernikahan' => $this->request->getPost('status_pernikahan'),
                    'pekerjaan' => $this->request->getPost('pekerjaan'),
                    'nomor_alternatif_1' => $this->request->getPost('nomor_alternatif_1'),
                    'nama_alternatif_1' => $this->request->getPost('nama_alternatif_1'),
                    'status' => 'Sedang Ditinjau'
                ];

                // Update gambar jika ada yang diunggah
                $fotoKTP = $this->request->getFile('foto_identitas');
                $fotoSelvi = $this->request->getFile('foto_selvi_ktp');

                $namaUnikKTP = 'ktp_' . $fotoKTP->getRandomName();
                $namaUnikSelvi = 'selvi_' . $fotoKTP->getRandomName();

                if ($fotoKTP->isValid() && !$fotoKTP->hasMoved()) {

                    $fotoKTP->move(FCPATH . 'assets/image/identitas', $namaUnikKTP);
                    $data['foto_identitas'] = $namaUnikKTP;
                }

                if ($fotoSelvi->isValid() && !$fotoSelvi->hasMoved()) {

                    $fotoSelvi->move(FCPATH . 'assets/image/identitas', $namaUnikSelvi);
                    $data['foto_selvi_ktp'] = $namaUnikSelvi;
                }

                $this->identitasModel->insertIdentitas($data);

                return redirect()->to(base_url('ka-settings/profile'))->with('success', $user['user_nama'] . ' ' . 'Identitas Anda berhasil Dikirim, silahkan tunggu proses verifikasi selanjutnya.');
            }

            // Form Insert Identitas
            if (isset($_POST['identitas_update'])) {

                $data = [
                    'user_id' => session('user_id'),
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'nomor_identitas' => $this->request->getPost('nomor_identitas'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                    'alamat' => $this->request->getPost('alamat'),
                    'agama' => $this->request->getPost('agama'),
                    'status_pernikahan' => $this->request->getPost('status_pernikahan'),
                    'pekerjaan' => $this->request->getPost('pekerjaan'),
                    'nomor_alternatif_1' => $this->request->getPost('nomor_alternatif_1'),
                    'nama_alternatif_1' => $this->request->getPost('nama_alternatif_1'),
                    'status' => 'Sedang Ditinjau'
                ];

                // Update gambar jika ada yang diunggah
                $fotoKTP = $this->request->getFile('foto_identitas');
                $fotoKTPLama = $this->request->getPost('foto_identitas_lama');


                $fotoSelvi = $this->request->getFile('foto_selvi_ktp');
                $fotoSelviLama = $this->request->getPost('foto_selvi_ktp_lama');

                $namaUnikKTP = 'ktp_' . $fotoKTP->getRandomName();
                $namaUnikSelvi = 'selvi_' . $fotoKTP->getRandomName();

                if ($fotoKTP->isValid() && !$fotoKTP->hasMoved()) {

                    $fotoKTP->move(FCPATH . 'assets/image/identitas', $namaUnikKTP);

                    if (!empty($fotoKTPLama)) {
                        $gambarPath = FCPATH . 'assets/image/identitas/' . $fotoKTPLama;
                        if (file_exists($gambarPath)) {
                            unlink($gambarPath); // Hapus logo lama dari direktori
                        }
                    }

                    $data['foto_identitas'] = $namaUnikKTP;
                }

                if ($fotoSelvi->isValid() && !$fotoSelvi->hasMoved()) {

                    $fotoSelvi->move(FCPATH . 'assets/image/identitas', $namaUnikSelvi);

                    if (!empty($fotoSelviLama)) {
                        $gambarPath = FCPATH . 'assets/image/identitas/' . $fotoSelviLama;
                        if (file_exists($gambarPath)) {
                            unlink($gambarPath);
                        }
                    }

                    $data['foto_selvi_ktp'] = $namaUnikSelvi;
                }
                $identitas = $this->identitasModel->where('user_id', session('user_id'))->first();
                $this->identitasModel->updateIdentitas($identitas['id'], $data);

                return redirect()->to(base_url('ka-settings/profile'))->with('success', $user['user_nama'] . ' ' . 'Identitas Anda berhasil Dikirim Ulang, silahkan tunggu proses verifikasi selanjutnya.');
            }
        }
    }
}
