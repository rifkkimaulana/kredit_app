<?php

namespace App\Controllers\Imasnet;

class Dashboard extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'user' => $this->user,
			'perusahaan' => $this->aplikasi,
		];
		return view('Imasnet/Pages/Dashboard', $data);
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
		];
		return view('kredit_app/pages/AccessDenied', $data);
	}
	//--------------------------------------------------------------------
}
