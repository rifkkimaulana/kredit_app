<?php

namespace App\Controllers\Kredit_App\Settings;

use App\Models\WablasModel;

use App\Controllers\Kredit_App\BaseController;

class WhatsappApi extends BaseController
{

    public function index()
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $wablasModel = new WablasModel();

        $data = [
            'title' => 'Whatsapp API Settings',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,
            'wa' => $wablasModel->find($this->aplikasi['wablasapi_id'])
        ];
        return view('kredit_app/pages/Settings/ApiWhatsapp', $data);
    }

    public function WhatsappApiUpdate()
    {
        // Cek apakah pengguna memiliki akses yang sesuai
        if ($this->user['user_level'] !== 'administrator') {
            return redirect()->to(base_url('access_denied'))->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        $model = new WablasModel();

        $data = [
            'domain' => $this->request->getPost('domain'),
            'token_api' => $this->request->getPost('token_api'),
        ];

        $model->updateWablas($data);

        return redirect()->to(base_url('ka-settings/whatsapp_api'))->with('success', 'Api Whatsapp anda berhasil diperbarui.');
    }
}
