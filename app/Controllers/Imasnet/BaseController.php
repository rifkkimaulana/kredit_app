<?php

namespace App\Controllers\Imasnet;

use App\Models\AplikasiModel;
use App\Models\UsersModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */

	// New Protected String

	// Base Admin
	protected $user;
	protected $aplikasi;
	protected $label;

	// Model Protected
	protected $userModel;
	protected $aplikasiModel;

	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

		// Akses UserModel
		$this->userModel = new UsersModel();
		$this->aplikasiModel = new AplikasiModel();

		// Mendapatkan Sesi Aktif Aplikasi
		$user = $this->userModel->where('user_id', session('user_id'))->first();
		$this->user = $user;

		if (!empty(session('AplicationId'))) {
			$this->aplikasi = $this->aplikasiModel->find(session('AplicationId'));
		} else {
			$this->aplikasi = $this->aplikasiModel->find($user['app_id']);
		}
	}
}
