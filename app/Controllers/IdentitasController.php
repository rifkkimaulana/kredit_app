<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\IdentitasModel;

class IdentitasController extends BaseController
{
    public function index()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }

        if (session('user_level') !== 'administrator'  && session('user_level') !== 'member') {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $data = [
            'user' => $user,
            'title' => 'Verifikasi Identitas'
        ];
        return view('admin/pages/FormIdentitas', $data);
    }

    public function simpanData()
    {
        if ($this->request->getMethod() === 'post') {

            $identitasModel = new IdentitasModel();

            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'nomor_identitas' => $this->request->getPost('nomor_identitas'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'alamat' => $this->request->getPost('alamat'),
                'agama' => $this->request->getPost('agama'),
                'status_pernikahan' => $this->request->getPost('status_pernikahan'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'email' => $this->request->getPost('email'),
                'nomor_alternatif_1' => $this->request->getPost('nomor_alternatif_1'),
                'nama_alternatif_1' => $this->request->getPost('nama_alternatif_1'),
                'nomor_alternatif_2' => $this->request->getPost('nomor_alternatif_2'),
                'nama_alternatif_2' => $this->request->getPost('nama_alternatif_2'),
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

            $identitasModel->insertIdentitas($data);

            session()->setFlashdata('success', 'Data identitas berhasil disimpan.');
            return redirect()->to(base_url('pengaturan/profile'));
        }
    }

    public function UpdateIdentitas_view()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }

        if (session('user_level') !== 'administrator'  && session('user_level') !== 'member') {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $identitasModel = new IdentitasModel();
        $identitas = $identitasModel->where('user_id', session('user_id'))->first();

        $data = [
            'user' => $user,
            'title' => 'Verifikasi Identitas',
            'identitas' => $identitas
        ];

        return view('admin/pages/FormIdentitasUpdate', $data);
    }

    public function UpdateIdentitas_post()
    {
        if ($this->request->getMethod() === 'post') {

            $identitasModel = new IdentitasModel();

            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'nomor_identitas' => $this->request->getPost('nomor_identitas'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'alamat' => $this->request->getPost('alamat'),
                'agama' => $this->request->getPost('agama'),
                'status_pernikahan' => $this->request->getPost('status_pernikahan'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'email' => $this->request->getPost('email'),
                'nomor_alternatif_1' => $this->request->getPost('nomor_alternatif_1'),
                'nama_alternatif_1' => $this->request->getPost('nama_alternatif_1'),
                'nomor_alternatif_2' => $this->request->getPost('nomor_alternatif_2'),
                'nama_alternatif_2' => $this->request->getPost('nama_alternatif_2'),
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
            $id = $this->request->getPost('identitas_id');
            $identitasModel->updateIdentitas($id, $data);

            session()->setFlashdata('success', 'Data identitas berhasil disimpan.');
            return redirect()->to(base_url('pengaturan/profile'));
        }
    }

    public function Peninjauan_view()
    {
        if (!session('user_id')) {
            return redirect()->to('login');
        }

        if (session('user_level') !== 'administrator') {
            return redirect()->to('login');
        }

        $userModel = new UsersModel();
        $user = $userModel->find(session('user_id'));

        if (!$user) {
            return redirect()->to('login');
        }

        $identitasModel = new IdentitasModel();
        $identitas = $identitasModel->findAll();

        $data = [
            'user' => $user,
            'title' => 'Daftar Peninjauan Identitas',
            'identitasList' => $identitas
        ];

        return view('admin/pages/PeninjauanIdentitas', $data);
    }
    //--------------------------------------------------------------------
}
