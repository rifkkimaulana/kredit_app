<?php

namespace App\Controllers;

use App\Models\AplikasiModel;

use App\Models\UsersModel;
use App\Models\GoogleApiModel;

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

	protected $usersModel;
	protected $googleModel;

	protected $aplikasi;
	protected $googleData;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();

		$aplikasiModel = new AplikasiModel();
		$googleModel = new GoogleApiModel();
		$this->usersModel = new UsersModel();
		$this->googleModel = new GoogleApiModel();

		$aplikasi = $aplikasiModel->where('id', session('ApplicationId'))->first();
		$this->aplikasi = $aplikasi;

		$this->googleData = $googleModel->where('id', 1)->first();
	}
}
