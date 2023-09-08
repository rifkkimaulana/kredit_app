<?php

namespace App\Controllers\Kredit_App;


class Dashboard extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'user' => $this->user,
			'perusahaan' => $this->aplikasi,
			'label' => $this->label
		];
		return view('kredit_app/pages/dashboard', $data);
	}

	public function logout()
	{
		session()->destroy();
		$this->response->deleteCookie('remember_me');

		return redirect()->to(base_url('login'))->with('success', 'Anda sudah keluar dari sesi aplikasi.');
	}

	public function access_denied()
	{
		$data = [
			'title' => 'Access Denied',
			'user' => $this->user,
			'perusahaan' => $this->aplikasi,
			'label' => $this->label
		];
		return view('kredit_app/pages/AccessDenied', $data);
	}
	//--------------------------------------------------------------------
}
