<?php

namespace App\Controllers\Kredit_App;

use App\Models\UsersModel;

class Dashboard extends BaseController
{
	public function index()
	{
		if (!session('user_id')) {
			return redirect()->to('login');
		}

		if (
			session('user_level') !== 'administrator'
			&& session('user_level') !== 'manager'
			&& session('user_level') !== 'member'
		) {
			return redirect()->to('login');
		}

		$userModel = new UsersModel();
		$user = $userModel->find(session('user_id'));

		if (!$user) {
			return redirect()->to('login');
		}

		$data = [
			'title' => 'Dashboard',
			'user' => $user
		];
		return view('kredit_app/pages/dashboard', $data);
	}

	public function logout()
	{
		session()->destroy();
		$this->response->deleteCookie('remember_me');

		return redirect()->to('login');
	}
	//--------------------------------------------------------------------
}
