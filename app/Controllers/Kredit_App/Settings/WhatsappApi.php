<?php

namespace App\Controllers\Kredit_App\Settings;

use App\Models\WablasModel;

use App\Controllers\Kredit_App\BaseController;

class WhatsappApi extends BaseController
{

    public function index()
    {
        $wablasModel = new WablasModel();

        $data = [
            'title' => 'Whatsapp API Settings',
            'user' => $this->user,
            'perusahaan' => $this->aplikasi,
            'label' => $this->label,
            'wa' => $wablasModel->find(1)
        ];
        return view('kredit_app/pages/Settings/ApiWhatsapp', $data);
    }

    public function WhatsappApiUpdate()
    {
        $model = new WablasModel();

        $data = [
            'domain' => $this->request->getPost('domain'),
            'token_api' => $this->request->getPost('token_api'),
        ];

        $model->updateWablas($data);

        return redirect()->to(base_url('ka-settings/whatsapp_api'))->with('success', 'Api Whatsapp anda berhasil diperbarui.');
    }
}
